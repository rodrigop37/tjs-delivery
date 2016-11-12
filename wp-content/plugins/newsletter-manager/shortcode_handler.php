<?php 

add_shortcode('xyz_em_subscription_html_code','display_content');


function display_content(){
	if(is_numeric(ini_get('output_buffering'))){
		$tmp=ob_get_contents();
		ob_clean();
		ob_start();
		include(dirname( __FILE__ ).'/shortcodes/htmlcode.php');
		$xyz_em_content = ob_get_contents();
		ob_clean();
		echo $tmp;
         $xyz_em_content=str_replace(array("\r\n","\r","\t"),"\n",$xyz_em_content);
	do{		$xyz_em_content=str_replace("\n\n","\n",$xyz_em_content);
	}while(strpos($xyz_em_content,"\n\n") !== false);
		return $xyz_em_content;
	}else{
		include(dirname( __FILE__ ).'/shortcodes/htmlcode.php');
	}

}




add_shortcode('xyz_em_thanks','display_thanks');


function display_thanks(){
	if(is_numeric(ini_get('output_buffering'))){
		$tmp=ob_get_contents();
		ob_clean();
		ob_start();
		include(dirname( __FILE__ ).'/shortcodes/thanks.php');
		$xyz_em_thanks = ob_get_contents();
		ob_clean();
		echo $tmp;
         $xyz_em_thanks=str_replace(array("\r\n","\r","\t"),"\n",$xyz_em_thanks);
	do{		$xyz_em_thanks=str_replace("\n\n","\n",$xyz_em_thanks);
	}while(strpos($xyz_em_thanks,"\n\n") !== false);
		return $xyz_em_thanks;
	}else{
		include(dirname( __FILE__ ).'/shortcodes/thanks.php');
	}
}

add_shortcode('xyz_em_confirm','display_confirm');


function display_confirm(){
	if(is_numeric(ini_get('output_buffering'))){
		$tmp=ob_get_contents();
		ob_clean();
		ob_start();
		include(dirname( __FILE__ ).'/shortcodes/confirm.php');
		$xyz_em_confirm = ob_get_contents();
		ob_clean();
		echo $tmp;
        $xyz_em_confirm=str_replace(array("\r\n","\r","\t"),"\n",$xyz_em_confirm);
	do{		$xyz_em_confirm=str_replace("\n\n","\n",$xyz_em_confirm);
	}while(strpos($xyz_em_confirm,"\n\n") !== false);
		return $xyz_em_confirm;
	}else{
		include(dirname( __FILE__ ).'/shortcodes/confirm.php');
	}
}

add_shortcode('xyz_em_unsubscribe','display_unsubscribe');


function display_unsubscribe(){
	if(is_numeric(ini_get('output_buffering'))){
		$tmp=ob_get_contents();
		ob_clean();
		ob_start();
		include(dirname( __FILE__ ).'/shortcodes/unsubscribe.php');
		$xyz_em_unsubscribe = ob_get_contents();
		ob_clean();
		echo $tmp;
        $xyz_em_unsubscribe=str_replace(array("\r\n","\r","\t"),"\n",$xyz_em_unsubscribe);
	do{		$xyz_em_unsubscribe=str_replace("\n\n","\n",$xyz_em_unsubscribe);
	}while(strpos($xyz_em_unsubscribe,"\n\n") !== false);
		return $xyz_em_unsubscribe;
	}else{
		include(dirname( __FILE__ ).'/shortcodes/unsubscribe.php');
	}
}

?>