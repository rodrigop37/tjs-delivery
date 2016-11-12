<?php

add_action('wp_ajax_ajax_campaign_preview', 'xyz_em_ajax_campaign_preview');

function xyz_em_ajax_campaign_preview(){

if ( !current_user_can('manage_options') )
	die;
global $wpdb;
$_POST = stripslashes_deep($_POST);
$_GET = stripslashes_deep($_GET);
$xyz_em_campId = absint($_POST['id']);

$campList = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->prefix."xyz_em_email_campaign WHERE id= %d",$xyz_em_campId)) ;


if($campList){
	$campList = $campList[0];

		$details = $campList;
		$body 	 = $details->body;
		$subject = $details->subject;
		$altBody = $details->alt_body;
		$sendersEmailId = $details->sender_email_id;
		$sendersEmail = $details->sender_email;
		$type = $details->type;
		$senderName = $details->sender_name;
		
		$body =  str_replace("{field1}","Name",$body);
		//$subject =  str_replace("{field1}","Name",$subject);
		if($details->alt_body != ""){
			$altBody =  str_replace("{field1}","Name",$altBody);
		}
		
		$unsubscriptionLink = plugins_url("newsletter-manager/demo_unsubscription.php");
			$body = str_replace("{unsubscribe-url}",$unsubscriptionLink,$body);
			$altBody    =  str_replace("{unsubscribe-url}",$unsubscriptionLink,$altBody);// optional, comment out and test
		
		
		$code = "";
		
		if($details->type==1){
			
			$code = $code.nl2br(htmlspecialchars($body));
		}
		if($details->type==2){
			
			$code = $code.$body;
		}
		echo $code;
		die;
	
	}
	
}

?>