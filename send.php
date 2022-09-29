<?php
    if(base64_decode($_COOKIE['online']) != 'yes'){
        die('<p style="font: bold 15px Verdana; color: #f15a29;">请先 <a href="login.php">登录</a> .</p>');
    }
?>
<?php
	//主程序引用
	include('inc/common.inc.php');
    include('inc/article_send.inc.php');
	
    if(!defined('IN_XYC')) {
        exit('Access Denied');  
    }
	
    if($_POST['article_title'] != null
    && $_POST['article_text'] != null
    ){
        $article_return = article_send(htmlspecialchars($_POST['article_title']),htmlspecialchars($_POST['article_text']));
        if($article_return != false){
            echo $article_return;
        }else{
            die('Error->>未知错误，无法发表文章！');
        }
    }

    //该段代码请不要放在lang.inc.php中，将会产生错误！
    $str_replace_array['{title}'] = det_title().$footer_title;
    $str_replace_array['{website_name}'] = XYC;
    
    if(det_title() != false){
        $str_replace_array['{title}'] = det_title().$footer_title;
    }else{
        if($_GET['p'] != null){
            $str_replace_array['{title}'] = get_article_title($_GET['p']).$footer_title;
        }else{
            $str_replace_array['{title}'] = 'Error->>未知的访问参数！'.$footer_title;
        }
    }
	
    tpl::phptpl_file( "template/header_common.html" , $str_replace_array , null , null , $if_exist_array , $section_replace_array , true );
    tpl::phptpl_file( "template/header.html" , $str_replace_array , null , null , $if_exist_array , $section_replace_array , true );
	tpl::phptpl_file( "template/body_send.html" , $str_replace_array , null , null , $if_exist_array , $section_replace_array , true );
    tpl::phptpl_file( "template/footer.html" , $str_replace_array , null , null , $if_exist_array , $section_replace_array , true );
?>