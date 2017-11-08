<?php

session_start();

include ("a2functions.php");

gateKeeper($type);

($dbh = mysql_connect ( $hostname, $username, $password ) ) or die ( "Unable to connect to MySQL database" ); 
mysql_select_db( $project );	
print "Successfully connected to MySQL<br><br><br>";

sql ('A', '', $s1, $s2 ); 

$A = get_A ($type , $s1);
echo $A;

$T = get_T ( $type , $s2 );
echo $T;

redirect($message, $url);

?>


