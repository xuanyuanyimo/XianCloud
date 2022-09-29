<?php
    if(!defined('IN_XYC')) {
        exit('Access Denied');  
    }

    function det_title(){
        require 'config/config_core.php';
        $tes = array
        (
            "/"=>$_XYC['main']['common']['file_name'],
            
			"login"=>"login.php",

            "send"=>"send.php"
        );
        
        switch (basename($_SERVER['REQUEST_URI']))
        {
        case $tes['/']:
            $title = '首页';
            break;
        case $tes['send']:
                $title = '发表';
                break;
		case $tes['login']:
		    $title = '登录';
		    break;
        default:
            $title = false;
        }
        return $title;
    }
?>