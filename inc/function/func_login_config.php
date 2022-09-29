<?php
    function det_login_config(){
        require 'config/config_core.php';
        if($_COOKIE['online'] != 'yes'
        && $_XYC['main']['common']['login_jump']
        ){
        return $_XYC['main']['common']['login_jump'];
        }else{
            return false;
        }
    }
?>