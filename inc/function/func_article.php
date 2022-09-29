<?php
    function getLine($file, $line, $length = 4096){
        $returnTxt = null; // 初始化返回
        $i = 1; //行数
        $handle = @fopen($file, "r");
        if ($handle) {
            while (!feof($handle)) {
                $buffer = fgets($handle, $length);
                if($line == $i) $returnTxt = $buffer;
                $i++;
            }
            fclose($handle);
        }
        return $returnTxt;
    }

	function text_get_array($files){
		$fileUrl = $files;
		$isss = file_exists($fileUrl) or exit("There is no file");
		$file = fopen($fileUrl, "r") ;
		$user = array();
		$i = 0;
		//输出文本中所有的行，直到文件结束为止。
		while(! feof($file)){
			$user[$i]= fgets($file);//fgets()函数从文件指针中读取一行
			$i++;
		}
		fclose($file);
		$user = array_filter($user);
		
		return $user;
	}

    function article_print(){
        if(isset($_GET['p'])){
            if(file_exists('data/article/'.$_GET['p'].'.txt')){
                $article_title = getLine('data/article/'.$_GET['p'].'.txt',1);
                $article_time = getLine('data/article/'.$_GET['p'].'.txt',2);
                $article_author = getLine('data/article/'.$_GET['p'].'.txt',3);
                $article_all_data = text_get_array('data/article/'.$_GET['p'].'.txt');
                unset($article_all_data[0]);
                unset($article_all_data[1]);
                unset($article_all_data[2]);
                
                $article_title_print = '<h1 class="mb-4 text-primary">'.$article_title.'</h1>';
                $article_text_print = '<p class="lead">'.implode("<br>",$article_all_data).'</p>';
                $article_time_print = '<p class="mb-5">'.$article_time.'</p>';
                $article_author_print = '<p class="mb-5">'.$article_author.'</p>';

                return $article_title_print.$article_text_print.'<br><br><br>时间：'.$article_time_print.'作者：'.$article_author_print;
            }else{
                //若库内无本篇文章时
                $return_not_file = implode("<br>",text_get_array('data/not_file.txt'));
                //定义常量，方便title方法查询
                define('NOT_TITLE',$return_not_file);
                return $return_not_file;
            }
        }else{
            //首页默认显示文案
            $return_default = implode("<br>",text_get_array('data/default.txt'));
            return $return_default;
        }
    }

    function article_list($file) {
        $dirn = -1; //目录数
        $filen = 0; //文件数
        //用来统计一个目录下的文件和目录的个数

        global $dirn;
        global $filen;
        $dir = opendir($file);
        while($filename = readdir($dir)) {
            if($filename!="." && $filename !="..") {
                $filename = $file."/".$filename;
                if(is_dir($filename)) {
                    $dirn++;
                } else {
                    $filen++; 
                }
            }
        }
        closedir($dir);

        for($filen; $filen!=0; $filen--){
            echo '<a href="'.'http://'.$_SERVER["SERVER_NAME"].'/?p='.$filen.'" target="_blank">'.'http://'.$_SERVER["SERVER_NAME"].'/?p='.$filen.'</a><br>';
        }
    }

    function get_article_title($article_id){
        $article_title = getLine('data/article/'.$article_id.'.txt',1);
        return $article_title;
    }
?>