<?php
//MAIL  FEATURE:

	//in HTML     name = "mailrequest"             //You need an html checkbox on the form. If checked the scriptshould send the mail.
	//in PHP 		isset ( $_GET ["mailrequest"] )


	if ( isset ( $_GET ["email"]  ) ) {
  
  $to 		= "j66@njit.edu";
	$Subject 	= "...";
	$message    = "Hello<br>How are you?";
  $headers = 'MIME-Version: 1.0';
  $headers = 'Content-type: text/html; charset=iso-8859-1';
	
	mail ( $to, $subject, $message , $headers );
	

//HTML: checkbox: <input type=checkbox name="mailresult">mail?;
//PHP: if (isset ($_GET["mailresult"])) {---,---,---};
  
  }; 
	

	
?>