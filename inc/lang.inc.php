<?php
    if(!defined('IN_XYC')) {
        exit('Access Denied');  
    }

    function rand_text(){
        include('lang.php');
        $return = $lang[rand(0,count($lang)-1)];
        return $return;
    }

    //语言库配置
    $str_replace_array['{copyright}'] = "Copyright © <script>document.write(new Date().getFullYear());</script> <a href='https://www.duxianmen.com/' target='_blank'>度仙门</a>.";
    $str_replace_array['{home}'] = "首页";
    $str_replace_array['{send}'] = "发表";
    $str_replace_array['{login}'] = "登录";
    $str_replace_array['{login_title}'] = "登录&注册";

    $str_replace_array['{send_article}'] = "发表文章";
    $str_replace_array['{send_article_alt}'] = "总有些想说的吧...";
    $str_replace_array['{article_title}'] = "文章标题";
    $str_replace_array['{article_text}'] = "文章内容";
    
    //语言库变量配置
    $str_replace_array['{today_date}'] = date('Ymd',time());
    $str_replace_array['{script_name}'] = htmlspecialchars($_SERVER["PHP_SELF"]);
    $str_replace_array['{rand_text}'] = rand_text();
    
?>