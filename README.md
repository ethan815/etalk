# etalk
简易网页聊天室

使用了
swoole框架和Z-PHP框架以及websocket技术


服务端：
目录为server：
配置好web环境后
安装PHPswoole拓展：pecl install swoole
修改config.php中，IP和端口为对应的配置。
cd pathtoyourapplication
php server.php
停止服务 kill -9 $(ps aux|grep 'server.php')

前端：
Z-PHP框架，具体参照框架解读
修改IP和端口为对应的配置。默认为登录页面