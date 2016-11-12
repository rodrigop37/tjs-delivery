<div style="color: #757575;"><?php 
	if($_REQUEST['result'] == "success") //subscription ok
	{
		_e( 'Thank you for subscribing to our list.', 'newsletter-manager' );
		if(isset($_REQUEST['confirm'])) // double opt-in
		{
			if($_REQUEST['confirm'] == "true") // user need  to confirm
			{ 
				_e( 'Your subscription is pending now. Please follow the confirmation link in your mailbox.', 'newsletter-manager' );
			}
			else // user already confirmed.
			{ 
				_e( 'Your subscription is already active.', 'newsletter-manager' );
			}
		}
		else // single opt-in
		{ 
			_e( 'Your subscription is active now.', 'newsletter-manager' );
		}
	}
	
	if($_GET['result'] == "failure") //subscription error
	{ 
		_e( 'There was an error during subscription', 'newsletter-manager' );
	}

	?></div>