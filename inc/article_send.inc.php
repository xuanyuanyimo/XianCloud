<?php
    function article_num(){
        $num = intval(file_get_contents('inc/num/index.txt'));
        $nnum = $num+1;
        file_put_contents('inc/num/index.txt',$nnum);
        return $num;
    }

    function article_send($article_title,$article_text){
        $article_num = article_num();
        
        //创建文章数据文件
        fopen('data/article/'.$article_num.'.txt',"x");
        //写入文章数据
        file_put_contents('data/article/'.$article_num.'.txt',$article_title.PHP_EOL.date('Y年m月d日 H点i分s秒').PHP_EOL.base64_decode($_COOKIE['username']).PHP_EOL.$article_text);

        if(file_exists('data/article/'.$article_num.'.txt')){
            $last_return = <<<EOF
                <script type="text/javascript">setTimeout("window.location.href ='index.php?p=$article_num';", 100);</script>
            EOF;
            return $last_return;
        }else{
            return false;
        }
    }
?>