<?php

    function dx_login_suc($dx_yn,$username){
        //设置cookie
        setcookie("online", base64_encode($dx_yn), time()+86400, "/", $_SERVER['HTTP_HOST']);
        setcookie("username", base64_encode($username), time()+86400, "/", $_SERVER['HTTP_HOST']);
    }

    function dx_login($username,$password){

        if ($_COOKIE["online"] == "yes"){
            die ('<p style="font: bold 15px Verdana; color: #f15a29;">您已登录，请不要重复登录！<script>setTimeout(function(){self.location=document.referrer;},2000);</script></p>');
        }

        //判断是否有该用户存在
        if (file_exists('users/'.$username)){
            //判断md5加密后用户输入的密码是否于内部数据匹配
            if(md5($password) == file_get_contents('users/'.$username.'/password.yb')){
                echo '<p style="font: bold 15px Verdana; color: #f15a29;">登录成功！将在二十四小时内免密登录！</p>';
                dx_login_suc('yes',$username);
                die ('<script>setTimeout(function(){self.location=document.referrer;},2000);</script>');
            }else{
                die ('<p style="font: bold 15px Verdana; color: #f15a29;">登录失败！错误的密码！<script>setTimeout(function(){self.location=document.referrer;},2000);</script></p>');
            }
        }else{
            if(preg_replace('/\s+/','',strip_tags($username)) != null and preg_replace('/\s+/','',$password) != null){
                    dx_regist(preg_replace('/([\x80-\xff]*)/i','',strip_tags($username)),$password);
                }else{
                    die('<p style="font: bold 15px Verdana; color: #f15a29;">请先输入用户名和密码！（不可使用中文或空格用户名！）<script>setTimeout(function(){self.location=document.referrer;},2000);</script></p>');
                }
        }
    }

    function dx_regist($n_username,$n_password){

        if ($_COOKIE["online"] == "yes"){
            die ('<p style="font: bold 15px Verdana; color: #f15a29;">您已登录，请退出登录后再注册新账号！<script>setTimeout(function(){self.location=document.referrer;},2000);</script></p>');
        }
        if (file_exists('users/'.$n_username)){
            //用户存在！
            die('<span style="font: bold 15px Verdana; color: #f15a29;">同名用户已注册！是否 <a href="/login.php?username='.$n_username.'">登录 </a>？</span>');
        }else{
            //用户不存在！
            echo '<p style="font: bold 15px Verdana; color: #f15a29;">正在创建用户...</p>';
            //创建
            mkdir('users/'.$n_username);
            fopen('users/'.$n_username.'/password.yb',"x");
            
            //写入内容
            file_put_contents('users/'.$n_username.'/password.yb',md5($n_password));

            if('users/'.$n_username){
                echo '<p style="font: bold 15px Verdana; color: #f15a29;">注册成功！请 <a href="login.php?username='.$n_username.'">登录</a> .</p>';
            }else{
                die('<b style="color:red;">Error->>未知错误！用户注册失败！请联系开发者...</b>');
            }
        }
    }

    if(strip_tags($_GET['username']) != null and $_GET['password'] != null){
        dx_login(strip_tags($_GET['username']),$_GET['password']);
    }else{
        die('<p style="font: bold 15px Verdana; color: #f15a29;">请先输入用户名和密码！（不可使用中文或空格用户名！）<script>setTimeout(function(){self.location=document.referrer;},2000);</script></p>');
    }
?>