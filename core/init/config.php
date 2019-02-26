<?php
	return [
		'THEME'	=>	'default',
		'THEME_SUFFIX'	=>	'.html',
		'URL_MOD'	=>	0,
		'CACHE_MOD'	=>	0,	//0:file,1:redis
		'VIEW_PREFIX' => '<{',
		'VIEW_SUFFIX' => '}>',
		// 'HTML_COMMPRESS'	=> true,

        /*数据库配置*/
        'DB_HOST'          =>    'localhost',  //数据库地址
        'DB_PORT'          =>    '3306',       //数据库端口，默认3306
        'DB_NAME'          =>    'etalk',       //数据库名
        'DB_USER'          =>    'root',       //数据库用户名
        'DB_PASS'          =>    'zhangjz',       //数据库密码
        'DB_PREFIX'        =>    'e_',      //数据表的前缀
        'DB_CHARSET'       =>    'utf8',        //字符集

    ];
