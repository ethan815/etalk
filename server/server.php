<?php
    define('ROOT_PATH', __DIR__ . '/');
    require ROOT_PATH . 'config/config.php';
    require ROOT_PATH . 'functions.php';

    class WebSocketServer {
        private $server;
        private $addr = '';
        private $port = '';
        private $users = array();  //保存连接的用户，fd=>nickname的形式保存
        private $lock;
		private $dbh;
		//private $users_all = array('1'=>'a','2'=>'b','3'=>'c');
		private $users_all = array('a','b','c');
        public function __construct($addr, $port)
        {
            $this->addr = $addr;
            $this->port = $port;
			$this->dbh = new PDO("mysql:host=localhost;dbname=etalk", "root", "zhangjz");
			$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        public function start()
        {
            $this->lock = new swoole_lock(SWOOLE_MUTEX);
            $this->server = new swoole_websocket_server($this->addr, $this->port);
            $this->server->set(array(
                'daemonize' => true,
                'worker_num' => 4,
                'task_worker_num' => 10,
                'max_request' => 1000,
                'log_file' => ROOT_PATH . 'storage\\logs\\swoole.log'
            ));

            $this->server->on('open', array($this, 'onOpen'));
            $this->server->on('message', array($this, 'onMessage'));
            $this->server->on('task', array($this, 'onTask'));
            $this->server->on('finish', array($this, 'onFinish'));
            $this->server->on('close', array($this, 'onClose'));

            $this->server->start();
        }

        public function onOpen($server, $request)
        {
            $message = array(
                'remote_addr' => $request->server['remote_addr'],
                'request_time' => date('Y-m-d H:i:s', $request->server['request_time'])
            );
            write_log($message);
        }

        public function onMessage($server, $frame)
        {
            $data = json_decode($frame->data);

            switch ($data->type) {
                case 'init':
                case 'INIT':
					//if(!in_array($data->message,$this->users_all)){
					//	$response = array(
                    //    'type' => 100,    // 1代表系统消息，2代表用户聊天
                    //    'message' => '无此用户'
					//	);
					//}else{						
						$fd = $frame->fd;
						$usr = $data->message;
						$sql = "insert into e_fd_users(fid,name) values('$fd','$usr');";
						$sql2 = "update e_fd_users set fid = '$fd' where name = '$usr';";
						$stmt=$this->dbh->query("select * from e_fd_users where name='$usr';");
						//执行查询语句
						$row=$stmt->fetch(PDO::FETCH_BOTH);
						if(empty($row[0]))
						{
							$this->dbh->exec($sql);
						}
						else{
							$this->dbh->exec($sql2);
						}

						//$this->users[$frame->fd] = $data->message;
						$message = '欢迎' . $data->message . '加入了聊天室';
						$response = array(
							'type' => 1,    // 1代表系统消息，2代表用户聊天
							'message' => $message
						);
					//}
                    break;
                case 'chat':
                case 'CHAT':
					$fd = $frame->fd;
                    $message = $data->message;
					$user = 'wrong';
					$stmt=$this->dbh->query("select * from e_fd_users where fid='$fd';");
					$row=$stmt->fetch(PDO::FETCH_BOTH);
					if(!empty($row[0]))
					{
						$user=$row['name'];
					}
					
                    $response = array(
                        'type' => 2,    // 1代表系统消息，2代表用户聊天
                        //'username' => $this->users[$frame->fd],
						'username' => $user,
                        'message' => $message
                    );
                    break;
                default:
                    return false;
            }

            $this->server->task($response);
        }

        public function onTask($server, $task_id, $from_id, $message)
        {
            foreach ($this->server->connections as $fd) {
                $this->server->push($fd, json_encode($message));
            }
            $server->finish( 'Task' . $task_id . 'Finished' . PHP_EOL);
        }

        public function onFinish($server, $task_id, $data)
        {
            write_log( $data );
        }

        public function onClose($server, $fd)
        {
            //$username = $this->users[$fd];
			$username = 'wrong';
			$stmt=$this->dbh->query("select * from e_fd_users where fid='$fd';");
			$row=$stmt->fetch(PDO::FETCH_BOTH);
			if(!empty($row[0]))
			{
				$username=$row['name'];
			}
            // 释放客户端，利用锁进行同步
            $this->lock->lock();
            //unset($this->users[$fd]);
            $this->lock->unlock();

            if( $username ) {
                $response = array(
                    'type' => 1,    // 1代表系统消息，2代表用户聊天
                    'message' => $username . '离开了聊天室'
                );
                $this->server->task($response);
            }


            write_log( $fd . ' disconnected');
        }

    }

    $ws = new WebSocketServer(SERVER_LISTEN_ADDR,SERVER_LISTEN_PORT);
    $ws->start();//自动后台运行

