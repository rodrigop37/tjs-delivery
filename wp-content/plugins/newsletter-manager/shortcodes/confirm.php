<div style="color: #757575;"><?php 
	
	if(isset($_REQUEST['result']) && $_REQUEST['result'] == 'failure')
	{
	
	_e( 'There was an error while confirming your subscription. Try after some time.', 'newsletter-manager' );
	
	}
	else
	{

		if(isset($_REQUEST['confirm']) && $_REQUEST['confirm'] == "true") // user need  to confirm
		{
				_e( 'Thank you for confirming your subscription.', 'newsletter-manager' );
		}
		else // user already confirmed.
		{
		_e( 'Your subscription is already active.', 'newsletter-manager' );
		}
		
	}
	
	?></div>