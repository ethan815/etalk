<?php
    namespace c;           //命名空间是 c
    use \z\controller;     //导入controller类
    class index extends controller{             //定义index控制器继承controller类
        static function index(){                //index操作

            session_start();
            if(!isset($_SESSION['username'])) {
                parent::redirect('/index.php?c=index&a=login');
            }
            $peizhi =  [
                'CLIENT_CONNECT_ADDR'	=>	'139.196.122.42',
                'CLIENT_CONNECT_PORT'	=>	'8080',
                'SERVER_LISTEN_ADDR'	=>	'0.0.0.0',
                'SERVER_LISTEN_PORT'	=>	'8080'
            ];
            parent::assign('CLIENT_CONNECT_ADDR',$peizhi['CLIENT_CONNECT_ADDR']);
            parent::assign('CLIENT_CONNECT_PORT',$peizhi['CLIENT_CONNECT_PORT']);
            parent::assign('SERVER_LISTEN_ADDR',$peizhi['SERVER_LISTEN_ADDR']);
            parent::assign('SERVER_LISTEN_PORT',$peizhi['SERVER_LISTEN_PORT']);

            parent::assign('username',$_SESSION['username']);

            $where  =  array();
            $m = M('users');
            $result = $m->getusers($where);
            parent::assign('users', $result);
			parent::display(); 
        }


        static function loginin(){
            $where = array();
            $where['name'] = I('name');
            $password= I('password');
            if(empty($where['name'])){
                parent::error('请输入用户名');
            }
            if(empty($password)){
                parent::error('请输入密码');
            }

            $m = M('users');
            $result= $m->getuser($where);
            if($result){
                if($result['password'] != md5($password))
                {
                    parent::error('密码错误');
                }else{
                    session_start();
                    $_SESSION['username'] = $result['name'];
                    parent::redirect('/index.php');
                }
            }else{
                parent::error('没有该账户');
            }

        }

        static function login(){
            parent::display();
        }
        static function loginout(){
            session_start();
            unset($_SESSION['username']);
            header('Location:/');

        }
        static function resin(){
            $name= I('name');
            $password= I('password');
            $repassword= I('repassword');
            if(empty($name)){
                parent::error('请输入用户名');
            }
            if(empty($password)){
                parent::error('请输入密码');
            }
            if(empty($repassword)){
                parent::error('请输入确认密码');
            }
            if($password != $repassword){
                parent::error('两次密码不一样');
            }
            $m = M('users');
            $where = array();
            $where['name'] = $name;
            $result= $m->getuser($where);
            if($result){
                parent::error('此用户名已经被注册');
            }else{
                $userinfo = array();
                $userinfo['name'] = $name;
                $userinfo['password'] = md5($password);
                $result= $m->addusers($userinfo);
                parent::success('注册成功，请登录','/',3);
            }
        }

        static function res(){
            parent::display();
        }
        /*
         * etalk
即时聊天室demo websocket+swoole

本应用是一个在线聊天室。利用了swoole高并发并且异步非阻塞的特点提高了程序的性能。 该应用需要swoole拓展的支持。

安装 安装PHPswoole拓展：pecl install swoole

或到swoole官网获取安装帮助

运行 开启服务： 将目录配置到NginxApache的虚拟主机目录中，使用浏览器访问index.php可访问。 修改config.php中，IP和端口为对应的配置。

cd pathtoyourapplication

php server.php

停止服务 kill -9 $(ps aux|grep 'server.php')
         */
    }