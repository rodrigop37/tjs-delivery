<?php

if(get_option('xyz_em_tinymce_filter')=="1"){
	require( dirname( __FILE__ ) . '/tinymce_filters.php' );
}
// Load the options
global $wpdb;
$_GET = stripslashes_deep($_GET);
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
if($_POST){
$_POST = stripslashes_deep($_POST);
$_POST = xyz_trim_deep($_POST);


$xyz_em_senderEmailFlag = 0;

	// 	echo '<pre>';
	// 	print_r($_POST);
	// 	die;
	$email_type = $_POST['email_type'];

	if($email_type == 1){
		$xyz_em_bodyPlain = $_POST['xyz_em_bodyPlain'];
		$xyz_em_body = $xyz_em_bodyPlain;
	}
	if($email_type == 2){
		$xyz_em_page = $_POST['xyz_em_body'];
		$xyz_em_body = preg_replace("/<script.+?>.+?<\/script>/im","",$xyz_em_page);

	}
	
			$xyz_em_senderEmailId = 0;
		$xyz_em_senderEmail = $_POST['xyz_em_senderEmail'];

	if(get_option('xyz_em_sendViaSmtp') == 1){
		$xyz_em_senderEmailId = $_POST['xyz_em_senderEmailId'];
		if($xyz_em_senderEmail != ''){
			if(!is_email($xyz_em_senderEmail)){
				$xyz_em_senderEmailFlag = 1;
			}
		}
	}else{
		if(!is_email($xyz_em_senderEmail)){
			$xyz_em_senderEmailFlag = 1;
		}
	}
	
	
	$xyz_em_altBody = $_POST['xyz_em_altBody'];
	
	
	

// 	echo $_POST['xyz_em_campName']."!= ''<br/>";
// 	echo $_POST['xyz_em_campSubject']." != ''<br/>";
// 	echo $xyz_em_body ."!= ''<br/>";
// 	echo $_POST['xyz_em_batchSize'] ."!= ''<br/>";
// 	echo $_POST['xyz_em_senderName'] ."!= ''<br/>";
// 	echo $xyz_em_senderEmailFlag ."== 0<br/>";
// 	echo $_POST['xyz_em_redirectAfterLink'] ."!= ''<br/>";
// 	die;
	
	
	

	if (($_POST['xyz_em_campName']!= "")
			&& ($_POST['xyz_em_campSubject'] != "")
			&& ($xyz_em_body != "")
			&& ($_POST['xyz_em_batchSize'] != "")
			&& ($_POST['xyz_em_senderName'] != "")
			&& ($xyz_em_senderEmailFlag == 0)){

		$xyz_em_campName = $_POST['xyz_em_campName'];

		$xyz_em_startTime = $_POST['xyz_em_startTime'];
		$xyz_em_hour = $_POST['xyz_em_hour'];
		$xyz_em_minute = $_POST['xyz_em_minute'];
		$xyz_em_second = 00;
		
		$endTimeCondition = $_POST['triggerEndTimeCondition'];
		
		$xyz_em_endTime = $_POST['xyz_em_endTime'];
		$xyz_em_hour_end = $_POST['xyz_em_hour_end'];
		$xyz_em_minute_end = $_POST['xyz_em_minute_end'];
		$xyz_em_second_end = 00;

		$xyz_em_campSubject = $_POST['xyz_em_campSubject'];
		
		$xyz_em_batchSize = abs(intval($_POST['xyz_em_batchSize']));
		$xyz_em_senderName = $_POST['xyz_em_senderName'];
		$xyz_em_redirectAfterLink = strip_tags($_POST['xyz_em_redirectAfterLink']);
		
		$xyz_em_join_after_campaign_started = $_POST['xyz_em_join_after_campaign_started'];

		if($xyz_em_startTime != ""){
			$startDateArray = explode('/',$xyz_em_startTime);
			$day = $startDateArray[0];
			$month = $startDateArray[1];
			$year = $startDateArray[2];

			if(($xyz_em_hour >= 0) && ($xyz_em_minute >=0)){

				$xyz_em_currentDateTime = xyz_local_date_time_create(gmmktime($xyz_em_hour,$xyz_em_minute,$xyz_em_second,$month,$day,$year));

			}else{
				$xyz_em_currentDateTime = xyz_local_date_time_create(gmmktime(0,0,0,$month,$day,$year));
			}

		}else{

			$xyz_em_currentDateTime = time();
		}
		
		$xyz_em_endDateTime = 0;
		
		if($endTimeCondition == 2){
		
			if($xyz_em_endTime != ""){
				$endDateArray = explode('/',$xyz_em_endTime);
				$day_end = $endDateArray[0];
				$month_end = $endDateArray[1];
				$year_end = $endDateArray[2];
			
				if(($xyz_em_hour_end >= 0) || ($xyz_em_minute_end >=0)){
			
					$xyz_em_endDateTime = xyz_local_date_time_create(gmmktime($xyz_em_hour_end,$xyz_em_minute_end,$xyz_em_second_end,$month_end,$day_end,$year_end));
			
				}else{
					$xyz_em_endDateTime = xyz_local_date_time_create(gmmktime(0,0,0,$month_end,$day_end,$year_end));
				}
		
			}
			
		}

		for($i = 1; $i <= 5; $i++){

			if($_FILES['xyz_em_uploadFile_'.$i]['name'] != ""){

				${
					$uploadFileName.$i} = $_FILES['xyz_em_uploadFile_'.$i]['name'];
					$extension = pathinfo(${
						$uploadFileName.$i});

			}

		}
		
		$endTimeConditionFlag = 0;
		if($endTimeCondition == 2){
			if($xyz_em_endDateTime < $xyz_em_currentDateTime){
				$endTimeConditionFlag = 1;
			}
		}
		
		if($endTimeConditionFlag == 0 ){
		
		if ( $xyz_em_batchSize > 0){

			$xyz_em_campFlag = 0;
			if($xyz_em_senderEmailFlag != 1){
				$xyz_em_campaign_count = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->prefix."xyz_em_email_campaign WHERE name= '%s'",$xyz_em_campName) ) ;

				if(count($xyz_em_campaign_count) == 0){


					$xyz_em_never = "Never";
					$wpdb->insert($wpdb->prefix.'xyz_em_email_campaign',
							array('name'=>$xyz_em_campName,
									'type'=>$email_type,
									'subject'=>$xyz_em_campSubject,
									'body'=>$xyz_em_body,
									'alt_body'=>$xyz_em_altBody,
									'list_id'=>1,
									'campaign_template_id'=>0,
									'status'=>-1,
									'batch_size'=>$xyz_em_batchSize,
									'sender_name'=>$xyz_em_senderName,
									'sender_email'=>$xyz_em_senderEmail,
									'sender_email_id'=>$xyz_em_senderEmailId,
									'last_send_mapping_id'=>0,
									'send_count'=>0,
									'last_fired_time'=>$xyz_em_never,
									'unsubscription_link'=>$xyz_em_redirectAfterLink,
									'start_time'=>$xyz_em_currentDateTime,
									'end_time'=>$xyz_em_endDateTime,
									'track_count'=>0,
									'join_after_campaign_started'=>$xyz_em_join_after_campaign_started),
							array('%s','%d','%s','%s','%s','%d','%d','%d','%d','%s','%s','%d','%d','%d','%s','%s','%s','%s','%d','%d'));
					
					
					$xyz_em_campLastid = $wpdb->insert_id;
					if($xyz_em_campLastid != 0){
						
						for($i = 1; $i <= 5; $i++){

							if($_FILES['xyz_em_uploadFile_'.$i]['name'] != ""){

								$targetfolder = realpath(dirname(__FILE__) . '/../../../')."/uploads";
								if (!is_file($targetfolder) && !is_dir($targetfolder)) {
								
									mkdir($targetfolder) or die("Could not create directory " . $targetfolder);
									chmod($targetfolder, 0777); //make it writable
								}
								$targetfolder = realpath(dirname(__FILE__) . '/../../../')."/uploads/xyz_em";
								if (!is_file($targetfolder) && !is_dir($targetfolder)) {
								
									mkdir($targetfolder) or die("Could not create directory " . $targetfolder);
									chmod($targetfolder, 0777); //make it writable
								}

								$dir = "uploads/xyz_em/attachments";
								$targetfolder = realpath(dirname(__FILE__) . '/../../../')."/".$dir;
								if (!is_file($targetfolder) && !is_dir($targetfolder)) {

									mkdir($targetfolder) or die("Could not create directory " . $targetfolder);

									chmod($targetfolder, 0777); //make it writable
								}
							
								
								/* new file name creation*/
								$extension = strtolower(pathinfo($_FILES['xyz_em_uploadFile_'.$i]['name'], PATHINFO_EXTENSION));
								$file_name =  basename($_FILES['xyz_em_uploadFile_'.$i]['name'],'.'.$extension);
								
								$finalFileName = xyz_insert_file($targetfolder, $file_name, 0, $extension);
								
								/* insert new file name to attachment table*/
								$wpdb->insert($wpdb->prefix.'xyz_em_attachment', array('campaigns_id' => $xyz_em_campLastid,'name' => $finalFileName),array('%d','%s'));
								
								/* move file(with new file name) to attachment folder*/
								move_uploaded_file($_FILES['xyz_em_uploadFile_'.$i]["tmp_name"],$targetfolder."/".$finalFileName);
							}

						}
							
					}
								$xyz_em_campFlag = 1;

					}
					if($xyz_em_campFlag == 1){
						header("Location:".admin_url('admin.php?page=newsletter-manager-manage-campaigns&campmsg=8'));
						exit();

				}else{
					?>
<div class="system_notice_area_style0" id="system_notice_area">
	Campaign name already exists.&nbsp;&nbsp;&nbsp;<span
		id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php
				}

			}else{
				?>
<div class="system_notice_area_style0" id="system_notice_area">
	Please enter a valid sender email.&nbsp;&nbsp;&nbsp;<span
		id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php
			}


		}else{
			?>
<div class="system_notice_area_style0" id="system_notice_area">
	Batch size must be a positive integer.&nbsp;&nbsp;&nbsp;<span
		id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php		
		}
		}else{
		?>
<div class="system_notice_area_style0" id="system_notice_area">
	End date must be greater than start time .&nbsp;&nbsp;&nbsp;<span
		id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php		
		}
	}else{
		?>
<div class="system_notice_area_style0" id="system_notice_area">
	Fill all fields.&nbsp;&nbsp;&nbsp;<span id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php
	}
}
?>
<!-- below for date picker -->


<script type="text/javascript">

var dp_cal_start;
var dp_cal_end;      



jQuery(document).ready(function(){

	jQuery("#startTime").datepicker({
		 dateFormat : "dd/mm/yy"
		 });
	 jQuery("#endTime").datepicker({
		 dateFormat : "dd/mm/yy"
		 });
	
	if (jQuery("#triggerEndTimeConditionEnds").is(':checked')) {
		jQuery("#triggerEndTimeConditionDate").show();
		jQuery("#dateTimeLabel").show();
		
	}else{
		jQuery("#triggerEndTimeConditionNeverEnds").attr("checked",true);
		jQuery("#triggerEndTimeConditionDate").hide();
		jQuery("#dateTimeLabel").hide();
	}
	
	jQuery("#triggerEndTimeConditionNeverEnds").click(function() {
		jQuery("#triggerEndTimeConditionDate").hide();
		jQuery("#dateTimeLabel").hide();
	});
	jQuery("#triggerEndTimeConditionEnds").click(function() {
		jQuery("#triggerEndTimeConditionDate").show();
		jQuery("#dateTimeLabel").show();
		
	});
	
});

</script>

<link rel="stylesheet" href="<?php echo plugins_url("newsletter-manager/css/datepicker.css");?>" type="text/css"	media="screen" />

<!-- above for date picker -->

<div>

	<h2>Create Campaign</h2>
	<form method="post" enctype="multipart/form-data">
		<table class="widefat" style="width:98%;">

			<tr valign="top">
				<td scope="row" class="td"><label for="xyz_em_campName">Campaign
						Name<span style="color:red;">*</span></label>
				</td>
				<td><input id="input" name="xyz_em_campName" type="text"
					id="xyz_em_campName"
					value="<?php if( isset($_POST['xyz_em_campName']) && $_POST['xyz_em_campName'] !="" ) echo esc_attr($_POST['xyz_em_campName']); ?>" />
				</td>
			</tr>
			<tr valign="top">
				<td scope="row"><label for="email_type">Email Type</label>
				</td>
				<td><select class="select" name="email_type"
					id="email_type">
						<option value="1"
						<?php if(isset($_POST['email_type']) && $_POST['email_type']==1) echo 'selected'; ?>>Plain Text</option>
						<option value="2"
						<?php if(isset($_POST['email_type']) && $_POST['email_type']==2) echo 'selected'; ?>>HTML</option>

				</select>
				</td>
			</tr>

			<tr>
				<td>&nbsp;</td>
				<td>
					Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Time
				</td>

			</tr>
			<tr>
				<td>Start Time</td>
				<td><input readonly="readonly" name="xyz_em_startTime"
					id="startTime" type="text"
					value="<?php if(isset($_POST['xyz_em_startTime']) && $_POST['xyz_em_startTime'] !="") echo $_POST['xyz_em_startTime']; ?>" />

					<select id="hour" name="xyz_em_hour" id="select">

						<?php 

						for($i = 0;$i<=23;$i++){

							?>
						<option value="<?php echo $i;?>"
						<?php if(isset($_POST['xyz_em_hour'])  && $_POST['xyz_em_hour']==$i) echo 'selected'; ?>>
							<?php echo $i;?>
						</option>
						<?php 

						}

						?>
				</select>H <select id="minute" name="xyz_em_minute" id="select">

						<?php 

						for($i = 0;$i<=59;$i++){

							?>
						<option value="<?php echo $i;?>"
						<?php if(isset($_POST['xyz_em_minute']) && $_POST['xyz_em_minute']==$i) echo 'selected'; ?>>
							<?php echo $i;?>
						</option>
						<?php 

						}

						?>
				</select>M</td>
			</tr>
			
			<tr id="dateTimeLabel">
				<td>&nbsp;</td>
				<td><span style="padding-left:210px;">&nbsp;</span>
					Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Time
				</td>

			</tr>
			
			<tr id="dateTriggerTr8">
				<td id="alignText">End Time</td>
				<td id="alignText">
					<div>
						<div style="float: left;padding-top: 3px; padding-bottom: 6px;">
							<input type="radio" name="triggerEndTimeCondition"
								id="triggerEndTimeConditionNeverEnds" value="1"	
								<?php if(isset($_POST['triggerEndTimeCondition']) && $_POST['triggerEndTimeCondition']==1){?>checked="checked"<?php }?>/>
							Never Ends
							<input type="radio" id="triggerEndTimeConditionEnds"
								name="triggerEndTimeCondition" id="specificdate" value="2" 
								<?php if(isset($_POST['triggerEndTimeCondition']) && $_POST['triggerEndTimeCondition']==2){?>checked="checked"<?php }?>/>
							Ends on a date
						</div>
						<div id="triggerEndTimeConditionDate"  >
							<div style="width: 100px; float:left;">
								&nbsp;&nbsp;&nbsp;<input readonly="readonly" name="xyz_em_endTime"
							id="endTime" type="text"
							value="<?php if(isset($_POST['xyz_em_endTime']) && $_POST['xyz_em_endTime'] !="") echo $_POST['xyz_em_endTime']; ?>" />
								
							</div>
							<div >
								<select id="hour_end" name="xyz_em_hour_end" id="select">
		
								<?php 
		
								for($i = 0;$i<=23;$i++){
		
									?>
								<option value="<?php echo $i;?>"
								<?php if(isset($_POST['xyz_em_hour_end'])  && $_POST['xyz_em_hour_end']==$i) echo 'selected'; ?>>
									<?php echo $i;?>
								</option>
								<?php 
		
								}
		
								?>
						</select>H <select id="minute_end" name="xyz_em_minute_end" id="select">
		
								<?php 
		
								for($i = 0;$i<=59;$i++){
		
									?>
								<option value="<?php echo $i;?>"
								<?php if(isset($_POST['xyz_em_minute_end']) && $_POST['xyz_em_minute_end']==$i) echo 'selected'; ?>>
									<?php echo $i;?>
								</option>
								<?php 
		
								}
		
								?>
						</select>M
							</div>
						</div>
					</div>
				</td>
			</tr>
			
			<tr valign="top">
				<td scope="row"><label for="xyz_em_campSubject">Mail Subject<span style="color:red;">*</span></label>
				</td>
				<td><input id="input" name="xyz_em_campSubject" type="text"
					id="xyz_em_campSubject"
					value="<?php if(isset($_POST['xyz_em_campSubject']) && $_POST['xyz_em_campSubject'] !="") echo esc_attr($_POST['xyz_em_campSubject']); ?>" />
				</td>
			</tr>

			<tr>
				<td scope="row"><label for="xyz_em_body">Body Content<span style="color:red;">*</span></label></td>
				<td>
					<div id="htmlcamp">
						<?php 

						if(get_option('xyz_em_defaultEditor') == "Text Editor"){


							?>
						<textarea  class="areaSize" name="xyz_em_body"><?php if(isset($_POST['xyz_em_body']) && $_POST['xyz_em_body'] !="") echo esc_textarea($_POST['xyz_em_body']); ?></textarea>
						<?php 
							
						}else if(get_option('xyz_em_defaultEditor') == "HTML Editor"){
							
							if(isset($_POST['xyz_em_body']) && $_POST['xyz_em_body'] !=""){
							
								the_editor($_POST['xyz_em_body'],'xyz_em_body');
							
							}else{
								$xyz_em_body = '';
								the_editor($xyz_em_body,'xyz_em_body');
							}

						}

						?>
						
					</div><br />
					<div id="plainText">

						<textarea class="areaSize" name="xyz_em_bodyPlain"><?php if(isset($_POST['xyz_em_bodyPlain']) && $_POST['xyz_em_bodyPlain'] !="") echo esc_textarea($_POST['xyz_em_bodyPlain']); ?></textarea>

					</div><br />
					<div class="campCreateDiv5">
						<b>{field1}</b>&nbsp;-&nbsp;Name.
					</div>
					<div class="campCreateDiv5">
					<b>{unsubscribe-url}</b> - Will be replaced with
					unsubscription link.
					</div>
				</td>
			</tr>
			

			<tr class="campCreatTr1" id="altHtml">
				<td scope="row"><label for="xyz_em_altBody">Alternate Body Content</label></td>
				<td ><textarea id="textarea"
						name="xyz_em_altBody">
										<?php if(isset($_POST['xyz_em_altBody']) && $_POST['xyz_em_altBody'] !="") echo esc_textarea($_POST['xyz_em_altBody']);  ?>
									</textarea> <br /> <br />
					<div class="campCreateDiv5">
						<b>{field1}</b>&nbsp;-&nbsp;Name.
					</div>
					<div class="campCreateDiv9">
						<b>{unsubscribe-url}</b> - Will be replaced with Unsubscription
						link.
					</div>
				</td>
			</tr>
			
			<tr valign="top">
				<td scope="row"><label for="xyz_em_join_after_campaign_started">Send email to subscribers who joined after the campaign is started</label>
				</td>
				<td>
				<select name="xyz_em_join_after_campaign_started">
					<option value="1" <?php if($_POST && $_POST['xyz_em_join_after_campaign_started'] == '1'){?>selected='selected'<?php } ?>>Yes</option>
					<option value="2" <?php if($_POST && $_POST['xyz_em_join_after_campaign_started'] == '2'){?>selected='selected'<?php } ?>>No</option>
				</select>
				</td>
			</tr>

			<tr valign="top">
				<td scope="row"><label for="xyz_em_batchSize">Batch Size<span style="color:red;">*</span></label>
				</td>
				<td><input id="input" name="xyz_em_batchSize" type="text"
					id="xyz_em_batchSize"
					value="<?php if(isset($_POST['xyz_em_batchSize']) && $_POST['xyz_em_batchSize'] !="") echo abs(intval($_POST['xyz_em_batchSize'])); ?>" />
				</td>
			</tr>
			<tr valign="top">
				<td scope="row"><label for="xyz_em_senderName">Sender Name<span style="color:red;">*</span></label>
				</td>
				<td><input id="input" name="xyz_em_senderName" type="text"
					id="xyz_em_senderName"
					value="<?php if(isset($_POST['xyz_em_senderName']) && $_POST['xyz_em_senderName'] !="") echo esc_attr($_POST['xyz_em_senderName']);else print(esc_attr(get_option('xyz_em_dsn'))); ?>" />
				</td>
			</tr>
			<tr valign="top">
				<td scope="row"><label for="xyz_em_redirectAfterLink">Redirection
						link after unsubscription</label>
				</td>
				<td><input id="input" name="xyz_em_redirectAfterLink" type="text"
					id="xyz_em_redirectAfterLink"
					value="<?php if(isset($_POST['xyz_em_redirectAfterLink']) && $_POST['xyz_em_redirectAfterLink'] !="") echo strip_tags($_POST['xyz_em_redirectAfterLink']); else echo get_option('xyz_em_redirectAfterLink');?>" />
				</td>
			</tr>
			<?php 
			if(get_option('xyz_em_sendViaSmtp') == 1){
			?>
			<tr valign="top">
				<td scope="row"><label for="xyz_em_senderEmail">SMTP Account
				
				<span style="color:red;">*</span>
				
				</label>
				</td>
				<td>
				<?php 
					$xyz_em_getSenderdetails = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."xyz_em_sender_email_address");
				?>	
				<select name="xyz_em_senderEmailId">
				<?php 
					foreach ($xyz_em_getSenderdetails as $xyz_em_getSender){
				?>
					<option value="<?php echo $xyz_em_getSender->id;?>"><?php echo $xyz_em_getSender->user;?></option>
				<?php 
					}
					?>
				</select>
				</td>
			</tr>
			<?php 
			}
			?>
			<tr valign="top">
				<td scope="row"><label for="xyz_em_senderEmail">Sender Email
				<?php 
				if(get_option('xyz_em_sendViaSmtp') != 1){
				?>
				<span style="color:red;">*</span>
				<?php 
				}
				?>
				</label>
				</td>
				<td>
				<input id="input" name="xyz_em_senderEmail" type="text"
					id="xyz_em_senderEmail"
					value="<?php if(isset($_POST['xyz_em_senderEmail']) && $_POST['xyz_em_senderEmail'] !="") echo esc_attr($_POST['xyz_em_senderEmail']);else print(esc_attr(get_option('xyz_em_dse'))); ?>" />
				</td>
			</tr>
			<?php 

			for($i = 1; $i <= 5; $i++){
					
				?>

			<tr valign="top">
				<td scope="row"><label >Attachment&nbsp;<?php echo $i;?>
				</label>
				</td>
				<td><input id="input" type="file"
					name="xyz_em_uploadFile_<?php echo $i;?>" />
				</td>
			</tr>


			<?php 

			}

			?>
			<tr>
				<td id="bottomBorderNone" scope="row"></td>
				<td id="bottomBorderNone">
				<div style="height:50px;"><input style="margin:10px 0 20px 0;" id="submit_em" class="button-primary bottonWidth" type="submit" value=" Create Campaign" /></div>
				
				</td>
			</tr>
		</table>
	</form>

</div>

<script type="text/javascript">


function editor_change()
{
    if (jQuery("#email_type").val() == 1) {
        jQuery("#plainText").show();
        jQuery("#htmlcamp").hide();
        jQuery("#altHtml").hide();  
   }
   if (jQuery("#email_type").val() == 2) {
        jQuery("#plainText").hide();
        jQuery("#htmlcamp").show();
        jQuery("#altHtml").show();
  }

}

						
jQuery(document).ready(function() {

	jQuery("#email_type").change(function(){
		editor_change()
	});
	
	editor_change()
		  
	});	

</script>

