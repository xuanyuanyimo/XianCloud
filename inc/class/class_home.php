<?php
    class index_op{
		
        public static function jump_home(){
    		$http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
    		if (strpos($_SERVER['REQUEST_URI'],'index.php')){
    			header('Location: '.$http_type.$_SERVER['HTTP_HOST'].str_replace('index.php', "", $_SERVER['REQUEST_URI']));
			}
        }
		public static function source_link($link,$switch){
			if($switch == true){
				if(isset($_SERVER['HTTP_REFERER'])) {
					if($_SERVER['HTTP_REFERER'] != $link){die('Access Denied');
					}
				}else{
					die('Access Denied');
				}
			}
		}
		public static function jump_link($link){
			if(isset($link)){
				header('Location: '.$link);
			}
        }
	}
?>