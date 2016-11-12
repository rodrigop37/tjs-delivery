<script>
function xyz_em_verify_fields()
{
var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
var address = document.subscription.xyz_em_email.value;
if(reg.test(address) == false) {
	alert('<?php _e( 'Please check whether the email is correct.', 'newsletter-manager' ); ?>');
return false;
}else{
//document.subscription.submit();
return true;
}
}
</script>
<style>
#tdTop{
	border-top:none;
}
</style>
<form method="POST" name="subscription" action="<?php echo get_site_url()."/index.php?wp_nlm=subscription";?>">
<table border="0">
<tr>
<td id="tdTop"  colspan="2">
<span style="font-size:14px;"><b><?php echo esc_html(get_option('xyz_em_widgetName'))?></b></span>
</td>
</tr>
<tr >
<td id="tdTop" width="200px"><?php _e( 'Name', 'newsletter-manager' ); ?></td>
<td id="tdTop" >
<input  name="xyz_em_name" type="text" />
</td>
</tr>
<tr >
<td id="tdTop" ><?php _e( 'Email Address', 'newsletter-manager' ); ?></td>
<td id="tdTop">
<input  name="xyz_em_email" type="text" /><span style="color:#FF0000">*</span>
</td>
</tr>
<tr>
<td id="tdTop">&nbsp;</td>
<td id="tdTop">
<div style="height:20px;"><input name="htmlSubmit"  id="submit_em" class="button-primary" type="submit" value="<?php _e( 'Subscribe', 'newsletter-manager' ); ?>" onclick="javascript: if(!xyz_em_verify_fields()) return false; "  /></div>
</td>
</tr>
<tr>
<td id="tdTop" colspan="3" >&nbsp;</td>
</tr>
</table>
</form>