<?php

if(!isset($_GET['wp_nlm'])){

	$string = '?wp_nlm=unsubscription';
	foreach ($_GET as $key => $value) {
		$string = $string.'&'.$key.'='.$value;
	}

	header("Location:". '../../../index.php'.$string);
	exit();
}

require_once ABSPATH . WPINC . '/class-phpmailer.php';
$phpmailer = new PHPMailer();
$phpmailer->CharSet=get_option('blog_charset');

global $wpdb;
$_POST = stripslashes_deep($_POST);
$_GET = stripslashes_deep($_GET);
$xyz_em_emailId = absint($_GET['eId']);
$xyz_em_listId = absint($_GET['lId']);
$xyz_em_both = $_GET['both'];
$xyz_em_campId = absint($_GET['campId']);

$xyz_em_emailDetails = $wpdb->get_results( $wpdb->prepare( "SELECT email FROM ".$wpdb->prefix."xyz_em_email_address WHERE id= %d",$xyz_em_emailId)) ;
$xyz_em_emailDetails = $xyz_em_emailDetails[0];

$combine = $xyz_em_emailId.$xyz_em_listId.strtolower($xyz_em_emailDetails->email);
$combineValue = md5($combine);
$time = time();



$xyz_em_campDetails = $wpdb->get_results( $wpdb->prepare( "SELECT unsubscription_link FROM ".$wpdb->prefix."xyz_em_email_campaign WHERE id= %d LIMIT %d,%d",$xyz_em_campId,0,1)) ;
$xyz_em_campDetails = $xyz_em_campDetails[0];

if($combineValue == $xyz_em_both){
	
	$xyz_em_unsubscriptionFlag = 0;
	
	$xyz_em_status = $wpdb->get_results($wpdb->prepare( "SELECT status FROM ".$wpdb->prefix."xyz_em_address_list_mapping WHERE ea_id= %d AND el_id= %d",$xyz_em_emailId,$xyz_em_listId));
	$xyz_em_status = $xyz_em_status[0];
	if($xyz_em_status->status == 1){
	
		$xyz_em_unsubscriptionFlag = 1;
	
	}
	
	$wpdb->update($wpdb->prefix.'xyz_em_address_list_mapping',array('status'=>0,'last_update_time'=>$time),array('ea_id'=>$xyz_em_emailId,'el_id'=>$xyz_em_listId));
	
	if(get_option('xyz_em_enableUnsubNotification') == "True"){
		
		
		$xyz_em_emailTempalteDetails = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'xyz_em_email_template WHERE id=2') ;
		$xyz_em_emailTempalteDetails = $xyz_em_emailTempalteDetails[0];
		
		$xyz_em_emailTempalteMessage = $xyz_em_emailTempalteDetails->message;
		
		
		$xyz_em_fieldInfoDetails = $wpdb->get_results( 'SELECT default_value FROM '.$wpdb->prefix.'xyz_em_additional_field_info WHERE field_name="Name"' ) ;
		$xyz_em_fieldInfoDetails = $xyz_em_fieldInfoDetails[0];
		
		$xyz_em_fieldValueDetails = $wpdb->get_results( $wpdb->prepare( "SELECT field1 FROM ".$wpdb->prefix."xyz_em_additional_field_value WHERE ea_id= %d",$xyz_em_emailId) ) ;
		$xyz_em_fieldValueDetails = $xyz_em_fieldValueDetails[0];
		
		if($xyz_em_fieldValueDetails->field1 != ""){
		
			$xyz_em_emailTempalteMessage =  str_replace("{field1}",$xyz_em_fieldValueDetails->field1,$xyz_em_emailTempalteMessage);
			
			$xyz_em_subject = str_replace("{field1}",$xyz_em_fieldValueDetails->field1,$xyz_em_emailTempalteDetails->subject);
		
		}else{
			$xyz_em_emailTempalteMessage =  str_replace("{field1}",$xyz_em_fieldInfoDetails->default_value,$xyz_em_emailTempalteMessage);
			
			$xyz_em_subject = str_replace("{field1}",$xyz_em_fieldValueDetails->default_value,$xyz_em_emailTempalteDetails->subject);
		}
		
			$xyz_em_senderName = get_option('xyz_em_dsn');
		
		if($xyz_em_unsubscriptionFlag == 1){
			
			if(get_option('xyz_em_sendViaSmtp') == 1){
			
			
			
				$xyz_em_SmtpDetails = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'xyz_em_sender_email_address WHERE 	set_default ="1"' ) ;
				$xyz_em_SmtpDetails = $xyz_em_SmtpDetails[0];
			
				$phpmailer->IsSMTP();
				$phpmailer->Host = $xyz_em_SmtpDetails->host;
				$phpmailer->SMTPDebug = get_option('xyz_em_SmtpDebug');
				if($xyz_em_SmtpDetails->authentication=='true')
					$phpmailer->SMTPAuth = TRUE;
				
				$phpmailer->SMTPSecure = $xyz_em_SmtpDetails->security;
				$phpmailer->Port = $xyz_em_SmtpDetails->port;
				
				$phpmailer->Username = $xyz_em_SmtpDetails->user;
				$phpmailer->Password = $xyz_em_SmtpDetails->password;
				
				if(is_email(get_option('xyz_em_dse'))){
					$phpmailer->From     = get_option('xyz_em_dse');
				}else{
					$phpmailer->From     = $xyz_em_SmtpDetails->user;
				}
				$phpmailer->FromName = $xyz_em_senderName;
			
				$phpmailer->AddReplyTo($xyz_em_SmtpDetails->user,$xyz_em_senderName);
			
			}else{
			
				$phpmailer->IsMail();
				$xyz_em_senderEmail = get_option('xyz_em_dse');
				
				$phpmailer->From     = $xyz_em_senderEmail;
				$phpmailer->FromName = $xyz_em_senderName;
				
				$phpmailer->AddReplyTo($xyz_em_senderEmail,$xyz_em_senderName);
				
			}
			
			$phpmailer->Subject = $xyz_em_subject;
			
			$phpmailer->MsgHTML(nl2br($xyz_em_emailTempalteMessage));
			
			$phpmailer->AddAddress($xyz_em_emailDetails->email);
			
			$sent = $phpmailer->Send();
			
			if($sent == FALSE) {
			
// 				echo  "Mailer Error: " .$phpmailer->ErrorInfo;
			
			} elseif($sent == TRUE) {}			
			
		}	
		
	}
	
	$unsub_url=$xyz_em_campDetails->unsubscription_link;
	if(strpos($unsub_url,'?') > 0)
		$unsub_url=$unsub_url."&result=success";
	else
		$unsub_url=$unsub_url."?result=success";
	
	if($xyz_em_unsubscriptionFlag == 1)
	{
		$unsub_url=$unsub_url."&confirm=true";
	}
	else
	{
		$unsub_url=$unsub_url."&confirm=false";
	}
		
	header("Location:".$unsub_url);
		exit();
	
	
}else{
	
	$unsub_url=$xyz_em_campDetails->unsubscription_link;
if($unsub_url=='')
	$unsub_url=get_option('xyz_em_redirectAfterLink');
	
	if(strpos($unsub_url,'?') > 0)
		header("Location:".$unsub_url."&result=failure");
	else
		header("Location:".$unsub_url."?result=failure");
	exit();
}

