
<?php

session_start();

include ("account.php");
  
function sql ($type, $name, &$s1, &$s2 ) 
{ 
	if ($type != 'A')
	{
		$s1 = "select * from prototype1 where user = '$name'"; 
		$s2 = "select * from prototype1TableT where user = '$name' group by date desc limit 1"; 
	}
  if ($type == 'A')
	{
		$s1 = "select * from prototype1 "; 
		$s2 = "select * from prototype1TableT "; 
	}
}

function get_case ($name, $pass, $amount, $type)

//stop if type doesnt make sense
{
	
	if ($type != "A" && $type != "C" )
	{
		$message = "Invalid Type";
   $url = "LoginA2.html";
   redirect($message,$url);
   
	}
	
	else
	{
		$name = mysql_real_escape_string($name);
		$pass = mysql_real_escape_string($pass);
		echo "user: $name, pass: $pass, type: $type<br>";
	}
	
}

function admin ($name, $pass) 
{ 

	//exit if bad admin credentials 
	$username="admin"; 
	$password="007"; 

	if($username != $name && $pass != $password) 

	{ 
		$message="<br>Bad Admin credentials";
		$url ="LoginA2.html";
    redirect($message, $url);
	} 

	else
	{
		$message = "<br>Good credentials";
		$url = "adminA2.php";
		redirect($message, $url);

	}
	
	return;	
	echo "<br>Inside admin."; 

}


function user ( $name, $pass, $amount, $type ) 
{ 
	
 
	$fetch = ("SELECT * FROM prototype1 WHERE user = '$name' AND pass = '$pass'"); 
	$t = mysql_query($fetch); $numrows = mysql_num_rows($t); 
	
	if($numrows !=0)
	{
		$message = "<br><br>Good credentials";
		$url = "userA2.php";
    redirect($message, $url);
	} 
	
	else
	{ 
		$message = "<br>Bad credentials";
		$url = "LoginA2.html";
		redirect($message, $url);
	} 
	//exit if attempted over-withdrawal 
	$sql= "SELECT * FROM prototype1 WHERE user = '$name' AND pass = '$pass'"; 
	$table = mysql_query($sql) or die( mysql_error () ); 
	$fetch = mysql_fetch_array($table); 
	$balance= $fetch["current_balance"]; 
	$_SESSION["balance"] = $fetch["current_balance"];
	
	if($balance>$amount)
	{ 
		echo"<br><br> Your current balance is: $balance";
	} 
		
	else
	{ 
		die ("<br>Unsucessful. You are overdrawing and your current balance is: $balance"); 
	} 
} 

function get_A ($type , $s1) 
{
	$result = ""; 
	$result .= "<br><br>\$s1 is: $s1"; 
	$result .= "<br>\$type is: $type"; 
	($t = mysql_query ($s1))	or die (mysql_error()); 
	
	while (	$r = mysql_fetch_array($t)) 
	{
		$user = $r ["user"]; 
		$email = $r ["email"]; 
		$current_balance = $r ["current_balance"]; 
		$result .= "<br>user is: $user"; 
		$result .= "<br>email is: $email"; 
		$result .= "<br>current balance is: $current_balance"; 
	}	
	
	return $result; 
	
} 

function get_T ( $type , $s2 ) 
{ 
	$result = ""; 
	$result .= "<br><br>\$s2 is: $s2"; 
	$result .= "<br>\$type is: $type"; 
	($t = mysql_query ($s2))	or die (mysql_error()); 
	
	while (	$r = mysql_fetch_array($t) ) 
	{
		$user = $r ["user"]; 
		$amount = $r ["amount"]; 
		$date = $r ["date"]; 
		$result .= "<br>user is: $user"; 
    $result .= "<br>\$type is: $type"; 
		$result .= "<br>amount is: $amount"; 
		$result .= "<br>date is: $date";
	}	
	
	return $result;
		
} 


function email ( $type, $name, $message, $pass )
{
	$to = get_mail_address( $type, $name, $pass );
	$subject = "knd7" . date("l jS \of F Y h:i:s A"); 
	$headers = "MIME-Version: 1.0" . "\r\n"; 
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
	mail ($to, $subject, $message, $headers); 
}

function get_mail_address ( $type, $name, $pass )
{
	$address = ""; 
	$sql = "select * from prototype1 where user = '$name' and pass = '$pass'";
	$t = mysql_query($sql) or die (mysql_error());
	$s = mysql_fetch_array($t);
	$email = $s["email"];
	
	if ( $type == "A" )
	{
		$address = "thespecialnamewhatever@mailinator.com"; 
	} 
	
	else 
	{
		$address = "$email"; 
	}
	
	return $address; 
}

function redirect($message, $url)
{
	echo $message;
	header("refresh:2; url = $url");
	exit();
}

function gateKeeper($type)
{
	if (!$_SESSION["logged"])
	{
		$message = "Invalid";
		$url = "LoginA2.html";
		redirect($message, $url);
	}
}
 
function update ($name, $amount, $type) 
{
  //Inside update
  //add a row to the transactions table
  $s = "insert into prototype1TableT values ('$name', '$type', '$amount', NOW())";
  echo "<br>The SQL statement used to update the Transactions Table: $s.<br>";
  mysql_query ($s) or die (mysql_error());
  
  echo "$type<br>";
  
  //add to current balance if deposit
  if ($type == 'D') {
    $update = "Update prototype1 set current_balance = current_balance + '$amount' where user = '$name' ";
    echo "<br>The SQL statement used to update the Current Balance: $update.<br>";
    mysql_query ($update) or die (mysql_error());
  }
  
  //subtract from current balance if withdrawl
  if ($type == 'W') {
    $update = "Update prototype1 set current_balance = current_balance - '$amount' where user = '$name' ";
    echo "<br>The SQL statement used to update the Current Balance: $update.<br>";
    mysql_query ($update) or die (mysql_error());
  }	
 
}
// attemp at salting password
function saltPassword($password)
{
  	return $this->db->real_escape_string(sha1($password.$this->salt));
}

?>