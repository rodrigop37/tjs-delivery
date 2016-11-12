<?php 
global $wpdb;
$_POST = stripslashes_deep($_POST);

$xyz_em_action = $_POST['action'];
$xyz_em_ids = $_POST['ids'];
$xyz_em_listId = 1;

$xyz_em_ids = substr($xyz_em_ids, 0,-1);
$xyz_em_emailIds = explode(",",$xyz_em_ids);

$deleteFlag = 0;
$unsubscribeFlag = 0;

if(count($xyz_em_emailIds) > 0){
	foreach ($xyz_em_emailIds as $emailId){


// 		echo '<pre>';
// 		print_r($emailId);

		if($xyz_em_action == 1){

			email_delete($emailId);
			$deleteFlag = 1;
			
		}
		if($xyz_em_action == 2){

			email_unsubscribe($emailId,$xyz_em_listId);
			$unsubscribeFlag = 1;
			
		}
		
	}
	if($deleteFlag == 1){
		header("Location:".admin_url('admin.php?page=newsletter-manager-manage-emails&emailmsg=3'));
		exit();
	}
	if($unsubscribeFlag == 1){
		header("Location:".admin_url('admin.php?page=newsletter-manager-manage-emails&emailmsg=2'));
		exit();
	}
	

}else{

	$this->set_notice('select_atleast_one_email');
}



function email_delete($xyz_em_emailId){
	global $wpdb;
	
	$wpdb->query( $wpdb->prepare( "DELETE FROM ".$wpdb->prefix."xyz_em_address_list_mapping WHERE ea_id= %d",$xyz_em_emailId) ) ;
	$wpdb->query( $wpdb->prepare( "DELETE FROM ".$wpdb->prefix."xyz_em_additional_field_value WHERE ea_id= %d",$xyz_em_emailId) ) ;
	$wpdb->query( $wpdb->prepare( "DELETE FROM ".$wpdb->prefix."xyz_em_email_address WHERE id= %d",$xyz_em_emailId) ) ;
	
	return true;
}


function email_unsubscribe($xyz_em_emailId,$xyz_em_listId){
	global $wpdb;
	$time = time();
	$xyz_em_status = 0;
	
	$wpdb->update($wpdb->prefix.'xyz_em_address_list_mapping', array('status'=>$xyz_em_status,'last_update_time'=>$time), array('ea_id'=>$xyz_em_emailId,'el_id'=>$xyz_em_listId));
	
	return true;

}


?>