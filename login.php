<?php
	//主程序引用
	include('inc/common.inc.php');

    if($_COOKIE['online'] != null){
        index_op::jump_link('index.php');
    }

    if(!defined('IN_XYC')) {
        exit('Access Denied');  
    }
	
    //该段代码请不要放在lang.inc.php中，将会产生错误！
    $str_replace_array['{title}'] = det_title().$footer_title;
    $str_replace_array['{website_name}'] = XYC;
	
	if($_GET['username'] != null){
		$str_replace_array['{返回用户名}'] = $_GET['username'];
	}else{
		$str_replace_array['{返回用户名}'] = '';
	}

    tpl::phptpl_file( "template/login.html" , $str_replace_array , null , null , $if_exist_array , $section_replace_array , true );
?>