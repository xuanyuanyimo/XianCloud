<?php
	define('IN_XYC', '仙云文章系统');
	define('XYC', '仙云文章系统');
	
	$footer_title = '&nbsp;|&nbsp;'.XYC;

    //模板引擎
    require 'inc/phptpl.inc.php';
    
	//类库引用
	require_once 'inc/class/class_home.php';
	
    //函数库引用
    require_once 'inc/lang.inc.php';
    require_once 'inc/function/func_title.php';
    require_once 'inc/function/func_login_config.php';
    require_once 'inc/function/func_article.php';//放在最后
?>