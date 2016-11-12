<?php
if(!isset($_REQUEST['wp_nlm'])){

	$string = '?wp_nlm=subscription';
	foreach ($_REQUEST as $key => $value) {
		$string = $string.'&'.$key.'='.$value;
	}

	header("Location:". '../../../index.php'.$string);
	exit();
}
$_POST = stripslashes_deep($_POST);
$_POST = xyz_trim_deep($_POST);

require_once ABSPATH . WPINC . '/class-phpmailer.php';
$phpmailer = new PHPMailer();
$phpmailer->CharSet=get_option('blog_charset');

global $wpdb;


$_REQUEST = stripslashes_deep($_REQUEST);
$_REQUEST = xyz_trim_deep($_REQUEST);

$optinMode = get_option('xyz_em_dss');


if(isset($_REQUEST['postFrom']) && $_REQUEST['postFrom'] == 'cfm'){
	$xyz_em_email = rawurldecode($_REQUEST['xyz_em_email']);
	$customFieldsDetails = unserialize(rawurldecode($_REQUEST['customFieldsDetails']));
	$xyz_em_name = $customFieldsDetails[0];
	
	$optinMode = rawurldecode($_REQUEST['xyz_newsletter_optinmode']); //replace optin mode from cfm
	
}else{
	$xyz_em_email = $_REQUEST['xyz_em_email'];
	$xyz_em_name = $_REQUEST['xyz_em_name'];
}

$xyz_em_emailConfirmation = get_option('xyz_em_emailConfirmation');
$xyz_em_afterSubscription = get_option('xyz_em_afterSubscription');

if(!is_email($xyz_em_email)){

	if(strpos($xyz_em_afterSubscription,'?') > 0)
	{
		$xyz_em_afterSubscription = $xyz_em_afterSubscription."&result=failure";

	}else{
		$xyz_em_afterSubscription = $xyz_em_afterSubscription."?result=failure";
	}
	header("location:".$xyz_em_afterSubscription);
	exit();
}else{
		$xyz_em_senderName = get_option('xyz_em_dsn');
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



	$time = time();
	$xyz_em_statusFlag=0;
	$emailDetails = $wpdb->get_results( $wpdb->prepare( "SELECT id FROM ".$wpdb->prefix."xyz_em_email_address WHERE email= '%s'",$xyz_em_email)) ;
	if(count($emailDetails) == 1){
		$emailDetails = $emailDetails[0];
		$xyz_em_emailLastId=$emailDetails->id;
		$emailExist = $wpdb->get_results( $wpdb->prepare( "SELECT ea.id FROM ".$wpdb->prefix."xyz_em_email_address ea INNER JOIN ".$wpdb->prefix."xyz_em_address_list_mapping lm ON lm.ea_id=ea.id WHERE ea.email= '%s' AND lm.status= %d",$xyz_em_email,1)) ;
		
		if(count($emailExist)>0){
		//	echo "Activation link already sent to your email address.";
		}else{		
		
		//	$xyz_em_emailLastId = $emailDetails->id;
			if($optinMode == "Active")
				$wpdb->update($wpdb->prefix.'xyz_em_address_list_mapping', array('last_update_time' => $time,'status' => 1),array('ea_id'=>$xyz_em_emailLastId));
			
			$xyz_em_statusFlag = 1;
			
		}
	}else{
			
			
		$wpdb->insert($wpdb->prefix.'xyz_em_email_address', array('email' => $xyz_em_email,'create_time' => $time,'last_update_time' => $time ),array('%s','%d','%d'));
		$xyz_em_emailLastId = $wpdb->insert_id;

		if($xyz_em_name != ""){
			$wpdb->insert($wpdb->prefix.'xyz_em_additional_field_value', array('ea_id' => $xyz_em_emailLastId,'field1' => $xyz_em_name),array('%d','%s'));
		}

		if($optinMode == "Pending"){

				$xyz_em_status = -1;
				
		}elseif($optinMode == "Active"){
			$xyz_em_status = 1;
		}

		$wpdb->insert($wpdb->prefix.'xyz_em_address_list_mapping', array('ea_id' => $xyz_em_emailLastId,'el_id' => 1, 'create_time' => $time,'last_update_time' => $time,'status' => $xyz_em_status),array('%d','%d','%d','%d','%d'));
		$xyz_em_statusFlag = 1;
	}

	if($optinMode == "Pending"){

		$xyz_em_emailTempalteDetails = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'xyz_em_email_template WHERE id=3') ;
		$xyz_em_emailTempalteDetails = $xyz_em_emailTempalteDetails[0];
		$xyz_em_emailTempalteMessage = $xyz_em_emailTempalteDetails->message;

		$xyz_em_fieldInfoDetails = $wpdb->get_results( 'SELECT default_value FROM '.$wpdb->prefix.'xyz_em_additional_field_info WHERE field_name="Name"' ) ;
		$xyz_em_fieldInfoDetails = $xyz_em_fieldInfoDetails[0];
		
		$xyz_em_fieldValueDetails = $wpdb->get_results( $wpdb->prepare( "SELECT field1 FROM ".$wpdb->prefix."xyz_em_additional_field_value WHERE ea_id= %d",$xyz_em_emailLastId) ) ;
		$xyz_em_fieldValueDetails = $xyz_em_fieldValueDetails[0];

		if($xyz_em_fieldValueDetails->field1 != ""){

			$xyz_em_emailTempalteMessage =  str_replace("{field1}",$xyz_em_fieldValueDetails->field1,$xyz_em_emailTempalteMessage);
			$xyz_em_subject = str_replace("{field1}",$xyz_em_fieldValueDetails->field1,$xyz_em_emailTempalteDetails->subject);

		}else{
			$xyz_em_emailTempalteMessage =  str_replace("{field1}",$xyz_em_fieldInfoDetails->default_value,$xyz_em_emailTempalteMessage);
			$xyz_em_subject = str_replace("{field1}",$xyz_em_fieldValueDetails->default_value,$xyz_em_emailTempalteDetails->subject);
		}

		$xyz_em_conf_link = '{confirmation_link}';

		$xyz_em_activeDir = "";

		if(strpos($xyz_em_afterSubscription,'?') > 0)
		{
			$xyz_em_activeDir = $xyz_em_afterSubscription."&result=success";

		}else{
			$xyz_em_activeDir = $xyz_em_afterSubscription."?result=success";
		}
// 		if($xyz_em_statusFlag == 1){
// 		}
		$xyz_em_appendUrl = base64_encode($xyz_em_emailConfirmation);
		$listId = 1;
		
		$combine = $xyz_em_emailLastId.$listId.strtolower($xyz_em_email);
		$combineValue = md5($combine);
		
		$xyz_em_confLink = get_site_url()."/index.php?wp_nlm=confirmation&eId=".$xyz_em_emailLastId."&lId=".$listId."&both=".$combineValue."&appurl=".$xyz_em_appendUrl;

		$xyz_em_messageToSendPending = nl2br(str_replace($xyz_em_conf_link,$xyz_em_confLink,$xyz_em_emailTempalteMessage));
		
		if($xyz_em_statusFlag == 1){
			
			$xyz_em_activeDir = $xyz_em_activeDir."&confirm=true"; // need to confirm

			$phpmailer->Subject = $xyz_em_subject;
				
			$phpmailer->MsgHTML($xyz_em_messageToSendPending);

			$phpmailer->AddAddress($xyz_em_email);

			$sent = $phpmailer->Send();
			
			if($sent == FALSE) {
				//echo  "Mailer Error: " .$phpmailer->ErrorInfo;

			} 
// 			die;
// 			elseif($sent == TRUE) {

// 			}
		}else {
			
			$xyz_em_activeDir = $xyz_em_activeDir."&confirm=false"; // already confirmed.
		}
				header("location: ".$xyz_em_activeDir);
				exit();


	}else{

		$xyz_em_emailTempalteDetails = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'xyz_em_email_template WHERE id=1') ;
		$xyz_em_emailTempalteDetails = $xyz_em_emailTempalteDetails[0];

		$xyz_em_emailTempalteMessage = $xyz_em_emailTempalteDetails->message;

		$xyz_em_fieldInfoDetails = $wpdb->get_results( 'SELECT default_value FROM '.$wpdb->prefix.'xyz_em_additional_field_info WHERE field_name="Name"' ) ;
		$xyz_em_fieldInfoDetails = $xyz_em_fieldInfoDetails[0];

		$xyz_em_fieldValueDetails = $wpdb->get_results( $wpdb->prepare( "SELECT field1 FROM ".$wpdb->prefix."xyz_em_additional_field_value WHERE ea_id= %d",$xyz_em_emailLastId) ) ;
		$xyz_em_fieldValueDetails = $xyz_em_fieldValueDetails[0];

		if($xyz_em_fieldValueDetails->field1 != ""){

			$xyz_em_emailTempalteMessage =  str_replace("{field1}",$xyz_em_fieldValueDetails->field1,$xyz_em_emailTempalteMessage);
			$xyz_em_subject = str_replace("{field1}",$xyz_em_fieldValueDetails->field1,$xyz_em_emailTempalteDetails->subject);

		}else{
			$xyz_em_emailTempalteMessage =  str_replace("{field1}",$xyz_em_fieldInfoDetails->default_value,$xyz_em_emailTempalteMessage);
			$xyz_em_subject = str_replace("{field1}",$xyz_em_fieldValueDetails->default_value,$xyz_em_emailTempalteDetails->subject);
		}

		$xyz_em_messageToSend = nl2br($xyz_em_emailTempalteMessage);
		//die("456");

		if($xyz_em_statusFlag == 1 && get_option('xyz_em_enableWelcomeEmail') == "True"){


			$phpmailer->Subject = $xyz_em_subject;

			$phpmailer->MsgHTML($xyz_em_messageToSend);

			$phpmailer->AddAddress($xyz_em_email);

			$sent = $phpmailer->Send();

			if($sent == FALSE) {

// 				echo  "Mailer Error: " .$phpmailer->ErrorInfo;

			} elseif($sent == TRUE) {
			}

		}

		if(strpos($xyz_em_afterSubscription,'?') > 0){
			header("location:".$xyz_em_afterSubscription."&result=success");
			exit();
		}else{
			header("location:".$xyz_em_afterSubscription."?result=success");
			exit();
		}

	}

}
?>