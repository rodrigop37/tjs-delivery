<?php 

function em_network_uninstall($networkwide) {
	global $wpdb;
	

	if (function_exists('is_multisite') && is_multisite()) {
		// check if it is a network activation - if so, run the activation function for each blog id
		if ($networkwide) {
			$old_blog = $wpdb->blogid;
			// Get all blog ids
			$blogids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
			foreach ($blogids as $blog_id) {
				switch_to_blog($blog_id);
				em_uninstall();
			}
			switch_to_blog($old_blog);
			return;
		}
	}
	em_uninstall();

}

function em_uninstall(){

global $wpdb;

$pluginName = 'xyz-wp-newsletter/xyz-wp-newsletter.php';
if (is_plugin_active($pluginName)) {
	return;
}
	/* file folder delete*/
$mydir =realpath(dirname(__FILE__) . '/../../../')."/uploads/xyz_em/attachments";
$d = dir($mydir);
if($d)
{
	while($entry = $d->read()) 
		if ($entry!= "." && $entry!= "..")
			unlink($mydir."/".$entry);
	$d->close();
	rmdir($mydir);
}


$mydir = realpath(dirname(__FILE__) . '/../../../')."/uploads/xyz_em/export";
$d = dir($mydir);
if($d)
{
	while($entry = $d->read()) 
		if ($entry!= "." && $entry!= "..")
			unlink($mydir."/".$entry);
	$d->close();
	rmdir($mydir);
}

$mydir = realpath(dirname(__FILE__) . '/../../../')."/uploads/xyz_em/import";
$d = dir($mydir);
if($d)
{
	while($entry = $d->read()) 
		if ($entry!= "." && $entry!= "..")
			unlink($mydir."/".$entry);
	$d->close();
	rmdir($mydir);
}

$mydir = realpath(dirname(__FILE__) . '/../../../')."/uploads/xyz_em";
$d = dir($mydir);
if($d)
{
	while($entry = $d->read()) 
		if ($entry!= "." && $entry!= "..")
			unlink($d."/".$entry);
	$d->close();
	rmdir($mydir);
}



/* table delete*/


$wpdb->query("DROP TABLE ".$wpdb->prefix."xyz_em_email_template");

$wpdb->query("DROP TABLE ".$wpdb->prefix."xyz_em_additional_field_value");

$wpdb->query("DROP TABLE ".$wpdb->prefix."xyz_em_additional_field_info");

$wpdb->query("DROP TABLE ".$wpdb->prefix."xyz_em_attachment");

$wpdb->query("DROP TABLE ".$wpdb->prefix."xyz_em_email_campaign");

$wpdb->query("DROP TABLE ".$wpdb->prefix."xyz_em_address_list_mapping");

$wpdb->query("DROP TABLE ".$wpdb->prefix."xyz_em_email_address");

$wpdb->query("DROP TABLE ".$wpdb->prefix."xyz_em_sender_email_address");

/* add_option values delete*/

delete_option("xyz_em_hesl");
delete_option("xyz_em_dss");
delete_option("xyz_em_defaultEditor");
delete_option("xyz_em_dse");
delete_option("xyz_em_dsn");
delete_option("xyz_em_enableWelcomeEmail");
delete_option("xyz_em_enableUnsubNotification");

delete_option("xyz_em_hidepmAds");

delete_option("xyz_em_hourly_email_sent_count");
delete_option("xyz_em_hourly_reset_time");
delete_option("xyz_em_cronStartTime");
delete_option("xyz_em_CronEndTime");
delete_option('xyz_em_afterSubscription');
delete_option('xyz_em_emailConfirmation');
delete_option('xyz_em_redirectAfterLink');
delete_option('xyz_em_limit');
delete_option('xyz_em_widgetName');

if(get_option('xyz_credit_link') == "em"){
	update_option('xyz_credit_link', 0);
}

delete_option('xyz_em_sendViaSmtp');
delete_option('xyz_em_SmtpDebug');



$the_page_unsubscribe = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."postmeta WHERE meta_key='xyz_em_unsubscribe_page' AND meta_value='1'");
$the_page_unsubscribe = $the_page_unsubscribe[0];
$pageIdUnsubscribe = $the_page_unsubscribe->post_id;

wp_delete_post($pageIdUnsubscribe,true);


$the_page_thanks = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."postmeta WHERE meta_key='xyz_em_thanks_page' AND meta_value='2'");
$the_page_thanks = $the_page_thanks[0];
$pageIdThanks = $the_page_thanks->post_id;

wp_delete_post($pageIdThanks,true);


$the_page_confirm = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."postmeta WHERE meta_key='xyz_em_confirm_page' AND meta_value='3'");
$the_page_confirm = $the_page_confirm[0];
$pageIdConfirm = $the_page_confirm->post_id;

wp_delete_post($pageIdConfirm,true);

}
	register_uninstall_hook( XYZ_EM_PLUGIN_FILE, 'em_network_uninstall' );

?>