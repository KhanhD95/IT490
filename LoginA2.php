<?php

session_start();

include ("a2functions.php");
include ("account.php");


($dbh = mysql_connect ( $hostname, $username, $password ) ) or die ( "Unable to connect to MySQL database" ); 
mysql_select_db( $project );	
print "Successfully connected to MySQL<br><br><br>";

$name = $_GET["user"]; 
$pass = $_GET["pass"]; 
$amount = $_GET["amount"]; 
$type = $_GET["type"]; 



$_SESSION["logged"] = true;
$_SESSION["user"] = $name;
$_SESSION["type"] = $type;



get_case ( $name, $pass, $amount, $type); 
 
if( $type == 'A') admin ($name, $pass); 
 
if( $type != 'A') user ($name, $pass, $amount, $type); 

//if($type != 'A') update ($name, $amount, $type );

sql ( $type, $name, $s1, $s2 ); 

$result1 = get_A( $type, $s1 ); 
echo $result1; 

$result2 = get_T( $type, $s2 ); 
echo $result2; 


?>