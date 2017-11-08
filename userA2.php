<!DOCTYPE html5>
<?php

session_start();

include ("a2functions.php");
gateKeeper($_SESSION["logged"]);

?>

<style>

fieldset
{
	border-radius: 25px;
    border: 1px solid #1E90FF;
    padding: margin; 
    width: 25%;
    height: margin;
	background: purple;
}

</style>

<form action = "transactionA2.php" >

<?php

include ("account.php");

($dbh = mysql_connect ( $hostname, $username, $password ) ) or die ( "Unable to connect to MySQL database" ); 
mysql_select_db( $project );	

echo "Successfully connected to MySQL<br><br><br>";

sql ('C', '', $s1, $s2 ); 
$name = $_SESSION["user"];
$balance = $_SESSION["current_balance"];

echo "Balance is: $ $balance<br><br><br>";

?>


	<b>Amount<b>: &nbsp &nbsp &nbsp &nbsp &nbsp <input type = text   name ="amount"  id ="amount" 
		autocomplete = "off"	
		required
		autofocus = "on"
		
		placeholder = "Enter Amount"
		><br><br>
		
	<input type = radio name = "type" value = "W" > &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Withdraw<br><br>
	
	<input type = radio name = "type" value = "D" > &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Deposit<br><br>
	
	<input type = submit>


</form>