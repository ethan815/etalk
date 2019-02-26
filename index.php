<?php
    //Z-PHP框架
    define('RES_PATH','public');                     //定义资源文件的目录
    define('APP_PATH','home');                            //定义应用目录名称
    define('DEBUG',0);                                    //开启debug
    require('./core/core.php');                           //加载框架（注意这里的路径）
    \z\z::start();