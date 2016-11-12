<?php
if(!isset($_GET['executeall'])){
	if(!isset($_GET['wp_nlm'])){
	
		$string = '?wp_nlm=cron';
		foreach ($_GET as $key => $value) {
			$string = $string.'&'.$key.'='.$value;
		}
	
		header("Location:". '../../../index.php'.$string);
		exit();
	}
}

require_once ABSPATH . WPINC . '/class-phpmailer.php';
require_once ABSPATH . WPINC . '/class-smtp.php';

if(get_option('xyz_em_active') == 1){
	global $wpdb;

	$currentDateTime = time();
	
	$xyz_em_campDetailsAll = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->prefix."xyz_em_email_campaign WHERE status= %d AND start_time<= '%s'",1,$currentDateTime) ) ;
	if(count($xyz_em_campDetailsAll)==0){
		?>
		
		<div style="float:left;background-color: #FFECB3;border-radius:5px;padding: 0px 5px;margin-top: 10px;border: 1px solid #E0AB1B; color: red; ">
			No active campaigns scheduled to execute now.
		</div>
		
		<?php 
	}
	else
	{
		update_option('xyz_em_cronStartTime',time());

		foreach( $xyz_em_campDetailsAll as $entry ) {
				
			$counter=1;
			$xyz_em_campId = $entry->id;
			
			$xyz_em_campDetails = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->prefix."xyz_em_email_campaign WHERE id= %d",$xyz_em_campId)) ;

			$xyz_em_campDetails = $xyz_em_campDetails[0];
			$xyz_em_fieldInfoDetails = $wpdb->get_results( 'SELECT default_value FROM '.$wpdb->prefix.'xyz_em_additional_field_info WHERE field_name="Name"' ) ;
			$xyz_em_fieldInfoDetails = $xyz_em_fieldInfoDetails[0];

				
			$time = time();
				
				
			$day 	= date('d', $time);
			$month 	= date('m', $time);
			$year 	= date('Y', $time);
			$hour 	= date('H', $time);
			$currentHour = gmmktime($hour,0,0,$month,$day,$year);
				
			if(($currentHour - get_option('xyz_em_hourly_reset_time'))>=3600){
					
				update_option('xyz_em_hourly_reset_time',$currentHour);
				update_option('xyz_em_hourly_email_sent_count',0);
					
			}
				
			if($xyz_em_campDetails->join_after_campaign_started == 1){				
				
				$xyz_em_mappingDetails = $wpdb->get_results( $wpdb->prepare( "SELECT ea_id,id FROM ".$wpdb->prefix."xyz_em_address_list_mapping WHERE el_id= %d AND status= %d AND id> %d ORDER BY id LIMIT %d,%d",$xyz_em_campDetails->list_id,1,$xyz_em_campDetails->last_send_mapping_id,0,$xyz_em_campDetails->batch_size) ) ;

			}elseif($xyz_em_campDetails->join_after_campaign_started == 2){
				
				$xyz_em_mappingDetails = $wpdb->get_results( $wpdb->prepare( "SELECT ea_id,id FROM ".$wpdb->prefix."xyz_em_address_list_mapping WHERE el_id= %d AND status= %d AND id> %d AND create_time< %d ORDER BY id LIMIT %d,%d",$xyz_em_campDetails->list_id,1,$xyz_em_campDetails->last_send_mapping_id,$xyz_em_campDetails->start_time,0,$xyz_em_campDetails->batch_size) ) ;
				
			}
			$xyz_em_sendMailFlag = 0;
				
				
			echo "<br/><br/><b>Campaign : ".esc_html($xyz_em_campDetails->name)."</b><br/><br/>";
				
				
			$noEmailFlag = 0;
			
			$endTimeFlag = 0;
			
			if($xyz_em_campDetails->end_time != 0){
				$xyz_em_end_time = $xyz_em_campDetails->end_time;
			}else{
				$xyz_em_end_time = $xyz_em_campDetails->end_time;
			}
			
			//echo $xyz_em_end_time."--".$currentHour;die;
			
			if(($xyz_em_end_time != 0) && ($xyz_em_end_time < $currentHour)){
			
				$endTimeFlag = 1;
			
				$wpdb->update($wpdb->prefix.'xyz_em_email_campaign',array('status'=>3), array('id'=>$xyz_em_campDetails->id));
			
			}
			
			if($endTimeFlag == 0){
				
			if(count($xyz_em_mappingDetails)>0){
					
				foreach ($xyz_em_mappingDetails as $mappingdetail){

					$phpmailer = new PHPMailer();
					$phpmailer->CharSet=get_option('blog_charset');
					
					$xyz_em_emailDetails = $wpdb->get_results( $wpdb->prepare( "SELECT email FROM ".$wpdb->prefix."xyz_em_email_address WHERE id= %d",$mappingdetail->ea_id)) ;
					$xyz_em_emailDetails = $xyz_em_emailDetails[0];

					
					$xyz_em_fieldValueDetails = $wpdb->get_results( $wpdb->prepare( "SELECT field1 FROM ".$wpdb->prefix."xyz_em_additional_field_value WHERE ea_id= %d",$mappingdetail->ea_id) ) ;
					

					$xyz_em_senderName = $xyz_em_campDetails->sender_name;
						
					if(get_option('xyz_em_sendViaSmtp') == 1){

						$fromEmail = '';
							
						if($xyz_em_campDetails->sender_email != ''){
							$fromEmail = $xyz_em_campDetails->sender_email;
						}
						
						if($xyz_em_campDetails->sender_email_id == 0){
							$xyz_em_SmtpDetails = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'xyz_em_sender_email_address WHERE 	set_default ="1"') ;
						}else{
							$xyz_em_SmtpDetails = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->prefix."xyz_em_sender_email_address WHERE id= %d",$xyz_em_campDetails->sender_email_id) ) ;
						}
						$xyz_em_SmtpDetails = $xyz_em_SmtpDetails[0];
						
						if($xyz_em_campDetails->sender_email == ''){
							$fromEmail = $xyz_em_SmtpDetails->user;
						}
						

						$phpmailer->IsSMTP();
						$phpmailer->Host = $xyz_em_SmtpDetails->host;
						$phpmailer->SMTPDebug = get_option('xyz_em_SmtpDebug');
						if($xyz_em_SmtpDetails->authentication=='true')
							$phpmailer->SMTPAuth = TRUE;

						$phpmailer->SMTPSecure = $xyz_em_SmtpDetails->security;
						$phpmailer->Port = $xyz_em_SmtpDetails->port;
						$phpmailer->Username = $xyz_em_SmtpDetails->user;
						$phpmailer->Password = $xyz_em_SmtpDetails->password;

						$phpmailer->From     = $fromEmail;
						$phpmailer->FromName = $xyz_em_senderName;
						//$phpmailer->SetFrom($xyz_em_senderEmail,$xyz_em_senderName); /* code changed */

						$phpmailer->AddReplyTo($xyz_em_SmtpDetails->user,$xyz_em_senderName);

					}else{

						$phpmailer->IsMail();

						$xyz_em_senderEmail = $xyz_em_campDetails->sender_email;
						
						if($xyz_em_senderEmail == 0 || $xyz_em_senderEmail == ''){
							$xyz_em_senderEmail = get_option('xyz_em_dse');
						}

						$phpmailer->From     = $xyz_em_senderEmail;
						$phpmailer->FromName = $xyz_em_senderName;
						//$phpmailer->SetFrom($xyz_em_senderEmail,$xyz_em_senderName); /* code changed */

						$phpmailer->AddReplyTo($xyz_em_senderEmail,$xyz_em_senderName);
					}
					$xyz_em_attachmentDetails = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->prefix."xyz_em_attachment WHERE campaigns_id= %d",$xyz_em_campId) ) ;
					if($xyz_em_attachmentDetails){
							
						$xyz_em_dir = "uploads/xyz_em/attachments/";
						$xyz_em_targetfolder = realpath(dirname(__FILE__) . '/../../')."/".$xyz_em_dir;

						foreach ($xyz_em_attachmentDetails as $xyz_em_attchDetail){
							$phpmailer->AddAttachment($xyz_em_targetfolder.$xyz_em_attchDetail->name);
						}
					}
					
					
					

					$xyz_em_altBody = $xyz_em_campDetails->alt_body;
						
					$xyz_em_body 	 = $xyz_em_campDetails->body;
					
					$xyz_em_subject = $xyz_em_campDetails->subject;
					
					if(count($xyz_em_fieldValueDetails)> 0){
						$xyz_em_fieldValueDetails = $xyz_em_fieldValueDetails[0];
								
						$xyz_em_body =  str_replace("{field1}",$xyz_em_fieldValueDetails->field1,$xyz_em_body);
						$xyz_em_altBody = str_replace("{field1}",$xyz_em_fieldValueDetails->field1,$xyz_em_altBody);
						$xyz_em_subject = str_replace("{field1}",$xyz_em_fieldValueDetails->field1,$xyz_em_subject);						
						
					}else{
						$xyz_em_body =  str_replace("{field1}",$xyz_em_fieldInfoDetails->default_value,$xyz_em_body);
						$xyz_em_altBody = str_replace("{field1}",$xyz_em_fieldInfoDetails->default_value,$xyz_em_altBody);
						$xyz_em_subject = str_replace("{field1}",$xyz_em_fieldInfoDetails->default_value,$xyz_em_subject);
					}

					$phpmailer->Subject = $xyz_em_subject;

					$type = $xyz_em_campDetails->type;

					$combineValues =  $mappingdetail->ea_id.$xyz_em_campDetails->list_id.strtolower($xyz_em_emailDetails->email);
					$both = md5($combineValues);

					$unsubscriptionLink = get_site_url()."/index.php?wp_nlm=unsubscription&eId=".$mappingdetail->ea_id."&lId=".$xyz_em_campDetails->list_id."&both=".$both."&campId=".$xyz_em_campDetails->id;

					$xyz_em_body = str_replace("{unsubscribe-url}",$unsubscriptionLink,$xyz_em_body);
					
					if($xyz_em_campDetails->type == 2){
						
						$phpmailer->AltBody    =  str_replace("{unsubscribe-url}",$unsubscriptionLink,$xyz_em_altBody);// optional, comment out and test
						
						$phpmailer->MsgHTML($xyz_em_body);
							
					}elseif($xyz_em_campDetails->type == 1){
							
						$phpmailer->Body = $xyz_em_body;
							
					}

					$phpmailer->AddAddress($xyz_em_emailDetails->email);

					$xyz_em_mappingId = $mappingdetail->id;

					if(get_option('xyz_em_hesl') > get_option('xyz_em_hourly_email_sent_count')){
							
						echo $counter++.". ".$xyz_em_emailDetails->email." : ";

						$sent = $phpmailer->Send();
						//$sent = TRUE; for testing

						if($sent == FALSE) {

							echo  "Mailer Error: " .$phpmailer->ErrorInfo;
							echo "<br/>";

						} elseif($sent == TRUE) {

							echo "Sent.";
							$xyz_em_sendMailFlag=1;

							
							$xyz_em_campSentCount = $wpdb->get_results( $wpdb->prepare( "SELECT send_count FROM ".$wpdb->prefix."xyz_em_email_campaign WHERE id= %d",$xyz_em_campId)) ;
							$xyz_em_campSentCount = $xyz_em_campSentCount[0];

							$time = time();
							$wpdb->update($wpdb->prefix.'xyz_em_email_campaign',
									array('send_count'=>$xyz_em_campSentCount->send_count+$xyz_em_sendMailFlag,'last_fired_time'=>$time,'last_send_mapping_id'=>$xyz_em_mappingId),
									array('id'=>$xyz_em_campId));

							$xyz_em_hourlySentEmailCount = get_option('xyz_em_hourly_email_sent_count');
							$xyz_em_currentSentCount = $xyz_em_hourlySentEmailCount + $xyz_em_sendMailFlag;
							update_option('xyz_em_hourly_email_sent_count',$xyz_em_currentSentCount);
								

						}
						echo "<br>";
							
					}else{
						?>
						<div style="float:left;background-color: #FFECB3;border-radius:5px;padding: 0px 5px;margin-top: 10px;border: 1px solid #E0AB1B; color: red; ">
							Hourly email sending limit reached.
						</div>
						<?php 
						break;
					}
				}
			}else{

				$noEmailFlag ++;
				?>
				<div style="float:left;background-color: #FFECB3;border-radius:5px;padding: 0px 5px;margin-top: 10px;border: 1px solid #E0AB1B; color: red; ">
					No more email to send.
				</div>
				<?php 
					
			}
			
		}else{
			?>
			<div style="float:left;background-color: #FFECB3;border-radius:5px;padding: 0px 5px;margin-top: 10px;border: 1px solid #E0AB1B; color: red; ">
				Email execution reached the end time.
			</div>
			<?php 
		}

		}
		update_option('xyz_em_CronEndTime',time());

	}
	if(!isset($_GET['executeall'])){
		if($_REQUEST['wp_nlm'] == 'cron'){
			die;
		}
	}

}else{
	exit();	
}
?>