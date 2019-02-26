# etalk
即时聊天室demo
websocket+swoole

本应用是一个在线聊天室。利用了swoole高并发并且异步非阻塞的特点提高了程序的性能。 该应用需要swoole拓展的支持。

安装
安装PHPswoole拓展：pecl install swoole

或到swoole官网获取安装帮助

运行
开启服务： 将目录配置到NginxApache的虚拟主机目录中，使用浏览器访问index.php可访问。 修改config.php中，IP和端口为对应的配置。

cd pathtoyourapplication
php server.php