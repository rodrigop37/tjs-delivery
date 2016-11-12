<?php 
$_POST = stripslashes_deep($_POST);
$_GET = stripslashes_deep($_GET);

$msgcode=0;
if(isset($_GET['campmsg']))
	$msgcode=$_GET['campmsg'];
if($msgcode == 1){
?>
<div class="system_notice_area_style1" id="system_notice_area">
	Campaign successfully restarted.&nbsp;&nbsp;&nbsp;<span
		id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php 

}


if($msgcode == 2){
?>
<div class="system_notice_area_style1" id="system_notice_area">
	Email campaign successfully updated.&nbsp;&nbsp;&nbsp;<span
		id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php 

}

if($msgcode == 3){
?>
<div class="system_notice_area_style1" id="system_notice_area">
	Campaign successfully deleted.&nbsp;&nbsp;&nbsp;<span
		id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php

}

if($msgcode == 4){
?>
<div class="system_notice_area_style1" id="system_notice_area">
	Test mail successfully sent.&nbsp;&nbsp;&nbsp;<span
		id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php

}

if($msgcode == 5){
?>
<div class="system_notice_area_style1" id="system_notice_area">
	Campaign successfully executed.&nbsp;&nbsp;&nbsp;<span
		id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php

}

if($msgcode == 6){
?>
<div class="system_notice_area_style0" id="system_notice_area">
	No more mail to send.&nbsp;&nbsp;&nbsp;<span
		id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php

}

if($msgcode == 7){
?>
<div class="system_notice_area_style0" id="system_notice_area">
	Campaign is inactive or Start time is not reached.&nbsp;&nbsp;&nbsp;<span
		id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php

}

if($msgcode == 8){
?>
<div class="system_notice_area_style1" id="system_notice_area">
	Email campaign successfully added.&nbsp;&nbsp;&nbsp;<span
		id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php

}

if($msgcode == 9){
?>
<div class="system_notice_area_style0" id="system_notice_area">
	Hourly email sending limit reached.&nbsp;&nbsp;&nbsp;<span
		id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php

}

if($msgcode == 10){
?>
<div class="system_notice_area_style0" id="system_notice_area">
	Email execution reached the end time.&nbsp;&nbsp;&nbsp;<span
		id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php

}
?>
<div class="black_overlay" id="black_overlay" title="Click to Close">
	<a class="mantemplateAtag noneDecoration"
		href="javascript: self.close()">[X]</a>
</div>
<div class="white_content" id="white_content"></div>
<style>
.div {
	color: #000000;
	text-align: center;
}

.black_overlay {
	background-color: black;
	display: block;
	height: 100%;
	left: 0px;
	opacity: 0.6;
	position: fixed;
	top: 0px;
	width: 100%;
	z-index: 1001;
	cursor: pointer;
	display: none;
}

.white_content {
	left: 20%;
	top: 20%;
	background-color: white;
	border: 3px solid #CCCCCC;
	display: block;;
	height: 60%;
	overflow: auto;
	padding: 5px;
	position: fixed;
	width: 60%;
	z-index: 1002;
	color: black;
	display: none;
}
</style>

<script type="text/javascript">
jQuery(document).ready(function() {
	
	jQuery("#black_overlay").hide(); 
	jQuery("#white_content").hide();

	jQuery('a[id|="preview"]').click(function (){

            //alert(this.id);

            var idStr = this.id;
            var split = idStr.split('-');           
            var id= split[1];
            //alert(id); 

          jQuery("#black_overlay").show(); 
          jQuery("#white_content").show();  
       
          

          //jQuery('#white_content').html(jQuery('<iframe  width="100%" height="99%" frameborder="0" src="<?php //echo admin_url("admin.php?page=newsletter-manager-manage-campaigns&action=campaign_preview&id="); ?>'+id+'"></iframe>'));

          var dataString = { 
  				action: 'ajax_campaign_preview', 
  				id: id
  		  };

          jQuery.post(ajaxurl, dataString, function(response) {
          	  jQuery('#white_content').html(response);
    	  });
          
                	
         });
        
       

	jQuery("div.black_overlay").click(
        		function()
        		{
        			jQuery("#black_overlay").hide(); 
        			jQuery("#white_content").hide();
        		});


	jQuery("#black_overlay").mouseover(function () {
            alert(this.readAttribute("title"));
         });      
         
});	

		
</script>

<div style="width: 99%">


	<h2>Email Campaigns</h2>
	<?php 
	global $wpdb;
	$pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;
	$limit = get_option('xyz_em_limit');
	$offset = ( $pagenum - 1 ) * $limit;

	$entries = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."xyz_em_email_campaign ORDER BY id DESC LIMIT $offset, $limit" );
		
	echo '<div class="wrap">';
	?>
<input class="button-primary cfm_bottonWidth" id="submit_em"
				style="cursor: pointer; margin-bottom:10px;" type="button"
				name="textFieldButton2" value="Create Campaign"
				 onClick='document.location.href="<?php echo admin_url('admin.php?page=newsletter-manager-manage-campaigns&action=create_campaign');?>"'>	
	<table class="widefat" >
		<thead>
			<tr>
				<td colspan="18">
					<div style="float: right;">
						Execute all campaigns&nbsp; :&nbsp;<a
							href='<?php echo admin_url('admin.php?page=newsletter-manager-manage-campaigns&action=cron&executeall=1'); ?>'><input
							type="button" class="button-primary bottonWidth" id="submit_em"
							value="Execute All" /> </a>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="col" class="manage-column column-name" style="">Name Of
					Campaign</th>
				<th scope="col" class="manage-column column-name" style="">Attachments</th>
				<th scope="col" class="manage-column column-name" style="">Sent</th>
				<th scope="col" class="manage-column column-name" style="">Remaining</th>
				<th scope="col" class="manage-column column-name" style="">Start
					Time</th>
				<th scope="col" class="manage-column column-name" style="">Last Mail
					fired Time</th>
				<th scope="col" class="manage-column column-name" style="">Status</th>
				<th scope="col" colspan="10" class="manage-column column-name"
					style="text-align: center;">Actions</th>
			</tr>
		</thead>
		<!-- 
<tfoot>
<tr>
<th scope="col" class="manage-column column-name" style="">Name Of Campaign</th>
<th scope="col" class="manage-column column-name" style="">Attachments</th>
<th scope="col" class="manage-column column-name" style="">Sent</th>
<th scope="col" class="manage-column column-name" style="">Remaining</th>
<th scope="col" class="manage-column column-name" style="">Start Time</th>
<th scope="col" class="manage-column column-name" style="">Last Mail fired Time</th>
<th scope="col" class="manage-column column-name" style="">Status</th>
<th scope="col" colspan="10" class="manage-column column-name" style="text-align:center;">Actions</th>
</tr>
</tfoot>
 -->
		<tbody>
			<?php if( $entries ) { 
					
					
					$pageno = 1;
				if(isset($_GET['pagenum'])){
				$pageno = $_GET['pagenum'];
				}
					
				$count = 1;
				$class = '';
				foreach( $entries as $entry ) {
					$class = ( $count % 2 == 0 ) ? ' class="alternate"' : '';
					?>

			<tr <?php echo $class; ?>>
				<td><?php echo esc_html($entry->name); ?></td>
				<td><?php echo get_attachment($entry->id); ?></td>
				<td><?php echo $entry->send_count;?></td>
				<td><?php echo get_remaining_count($entry->list_id,$entry->last_send_mapping_id,$entry->join_after_campaign_started,$entry->start_time); ?>
				</td>
				<td><?php 
				$starttime = $entry->start_time;
					
					
				if($starttime != "Never"){
					echo xyz_local_date_time("F j, Y, g:i a", $starttime);
				}else{echo $starttime;
				}
				?></td>
				<td><?php 
				$time = $entry->last_fired_time;
					
				
				if($time == "Never"){
					echo $time;
				}elseif($time == 0){
					echo 'Restarted';
				}
				else	
				{
					echo xyz_local_date_time("F j, Y, g:i a", $time);
				}
				?></td>

				<td><?php 

				if($entry->status == 1){
					echo "Active";
				}
				if($entry->status == 0){
					echo "Paused";
				}
				if($entry->status == -1){
					echo "Pending";
				}
				if($entry->status == 2){
					echo "Draft";
				}
				if($entry->status == 3){
					echo "Completed";
				}

				?>
				</td>
				<td>
				<?php 

				if($entry->status == 1){

					?>
				<a
					href="<?php echo admin_url('admin.php?page=newsletter-manager-manage-campaigns&action=campaign_status&id='.$entry->id.'&status=0&pageno='.$pageno); ?>"><img
						id="img" title="Pause campaign"
						src="<?php echo plugins_url('newsletter-manager/images/pause.png')?>">
				</a>
				

				<?php 

				}elseif ($entry->status == 0){

					?>
				<a
					href='<?php echo admin_url('admin.php?page=newsletter-manager-manage-campaigns&action=campaign_status&id='.$entry->id.'&status=1&pageno='.$pageno); ?>'><img
						id="img" title="Activate Campaign"
						src="<?php echo plugins_url('newsletter-manager/images/active.png')?>">
				</a>
				

				<?php 

				}elseif ($entry->status == -1){

					?>
				<a
					href='<?php echo admin_url('admin.php?page=newsletter-manager-manage-campaigns&action=campaign_status&id='.$entry->id.'&status=1&pageno='.$pageno); ?>'><img
						id="img" title="Activate Campaign"
						src="<?php echo plugins_url('newsletter-manager/images/active.png')?>">
				</a>
				

				<?php 

				}

				?>
				</td>
				<td id="tdCenter"><a
					href='<?php echo admin_url('admin.php?page=newsletter-manager-manage-campaigns&action=restart&id='.$entry->id.'&pageno='.$pageno); ?>'><img
						id="img" title="Restart Campaign"
						src="<?php echo plugins_url('newsletter-manager/images/restart.png')?>" />
				</a>
				</td>
				<td id="tdCenter"><a id="preview-<?php echo $entry->id;?>" href="#"><img
						id="img" title="Preview Campaign"
						src="<?php echo plugins_url('newsletter-manager/images/preview.png')?>">
				</a>
				</td>
				<td id="tdCenter"><a
					href='<?php echo admin_url('admin.php?page=newsletter-manager-manage-campaigns&action=edit_campaign&id='.$entry->id.'&pageno='.$pageno); ?>'><img
						id="img" title="Edit Campaign"
						src="<?php echo plugins_url('newsletter-manager/images/edit.png')?>" />
				</a></td>
				<td id="tdCenter"><a
					href='<?php echo admin_url('admin.php?page=newsletter-manager-manage-campaigns&action=campaign_delete&id='.$entry->id.'&pageno='.$pageno); ?>'
					onclick="javascript: return confirm('Please click \'OK\' to confirm ');"><img
						id="img" title="Delete Campaign"
						src="<?php echo plugins_url('newsletter-manager/images/delete.png')?>" />
				</a></td>
				<td id="tdCenter">
				<?php 
				if(($entry->status != 3) && ($entry->status != 2)){
				?>
				<a
					href='<?php echo admin_url('admin.php?page=newsletter-manager-manage-campaigns&action=test_mail&id='.$entry->id.'&pageno='.$pageno); ?>'><img
						id="img" title="Sent Test mail"
						src="<?php echo plugins_url('newsletter-manager/images/sendtestmail.png')?>" />
				</a>
				<?php 
				}
				?>
				</td>
				<td id="tdCenter">
				
				<?php 
				if(($entry->status != 3) && ($entry->status != 2) && ($entry->status != -1)){
				?>
				<a
					href='<?php echo admin_url('admin.php?page=newsletter-manager-manage-campaigns&action=send_mail&id='.$entry->id.'&pageno='.$pageno); ?>'><img
						id="img" title="Execute Campaign"
						src="<?php echo plugins_url('newsletter-manager/images/mailsend.png')?>" />
				</a>
				<?php 
				}
				?>
				</td>


			</tr>

			<?php
			$count++;
				}
			 
			} else { ?>
			<tr>
				<td colspan="20">Campaign not found</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<input class="button-primary cfm_bottonWidth" id="submit_em"
				style="cursor: pointer; margin-top:10px; margin-bottom:10px;" type="button"
				name="textFieldButton2" value="Create Campaign"
				 onClick='document.location.href="<?php echo admin_url('admin.php?page=newsletter-manager-manage-campaigns&action=create_campaign');?>"'>
	<?php

	$total = $wpdb->get_var( "SELECT COUNT(`id`) FROM ".$wpdb->prefix."xyz_em_email_campaign" );
	$num_of_pages = ceil( $total / $limit );

	function remove_querystring($url) {
		$xyz_em_messageReplacedUrl = preg_replace('/&campmsg(=[^&]*)?|^campmsg(=[^&]*)?&?/','',$url);
		return $xyz_em_messageReplacedUrl;
	}



	$page_links = paginate_links( array(
			'base' => remove_querystring(add_query_arg( 'pagenum','%#%')),
			'format' => '',
			'prev_text' => '&laquo;',
			'next_text' => '&raquo;',
			'total' => $num_of_pages,
			'current' => $pagenum
	) );

	if ( $page_links ) {
		echo '<div class="tablenav"><div class="tablenav-pages" style="margin: 1em 0">' . $page_links . '</div></div>';
	}

	echo '</div>';
	?>


</div>
<?php 

function get_attachment($campId){
	global $wpdb;
	
	echo $wpdb->query( $wpdb->prepare( "SELECT * FROM ".$wpdb->prefix."xyz_em_attachment WHERE campaigns_id= %d",$campId) ) ;
}


function get_remaining_count($listId,$lastSentMappingId,$joinAfterCampaignStarted,$campStartTime){
	global $wpdb;
	
	if($joinAfterCampaignStarted == 1){
		$remainingCount = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->prefix."xyz_em_address_list_mapping WHERE el_id= %d AND status= %d AND id> %d",$listId,1,$lastSentMappingId) ) ;
	}elseif($joinAfterCampaignStarted == 2){
		$remainingCount = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->prefix."xyz_em_address_list_mapping WHERE el_id= %d AND status= %d AND id> %d AND create_time< %d",$listId,1,$lastSentMappingId,$campStartTime)) ;
	}
		
	echo count($remainingCount);
	
	
}

?>

