<?php
	//主程序引用
	include('inc/common.inc.php');
	
    if(det_login_config()){index_op::jump_link('login.php');}

    if(!defined('IN_XYC')) {
        exit('Access Denied');  
    }
	
    //该段代码请不要放在lang.inc.php中，将会产生错误！
    $str_replace_array['{website_name}'] = XYC;
    $str_replace_array['{article}'] = article_print();

    /* 仅供首页使用 */
    if(det_title() != false){
        $str_replace_array['{title}'] = det_title().$footer_title;
    }else{
        if($_GET['p'] != null){
            if(defined('NOT_TITLE')){
                $str_replace_array['{title}'] = NOT_TITLE.$footer_title;
            }else{
                $str_replace_array['{title}'] = get_article_title($_GET['p']).$footer_title;
            }
        }else{
            $str_replace_array['{title}'] = 'Error->>未知的访问参数！'.$footer_title;
        }
    }
    /* 仅供首页使用 */
	
    index_op::jump_home();
    tpl::phptpl_file( "template/header_common.html" , $str_replace_array , null , null , $if_exist_array , $section_replace_array , true );
    tpl::phptpl_file( "template/header.html" , $str_replace_array , null , null , $if_exist_array , $section_replace_array , true );
	tpl::phptpl_file( "template/body_index.html" , $str_replace_array , null , null , $if_exist_array , $section_replace_array , true );
    tpl::phptpl_file( "template/footer.html" , $str_replace_array , null , null , $if_exist_array , $section_replace_array , true );
?>