<?php
include (  "account.php"     );

( $dbh = mysql_connect ( $hostname, $username, $password ) )
       or die ( "Unable to connect to MySQL database" );
	
print "Successfully Connected to MySQL<br>";

mysql_select_db( $project ); 

$user = $_GET ["user"];
print "<br> The submitted User name was: $user";
$s = "select * from prototype1";

$i_balance = $_GET ["initial_balance"];

print "<br>SQL statement is: $s<br>";

($t = mysql_query ( $s) ) or die (mysql_error());

$num = mysql_num_rows($t);
print "<br>Number of Rows: $num<br>";

print "<br>Some of the rows from A are:";

while($r = mysql_fetch_array($t))
{ 
  $x = $r ["User"];
  $y = $r ["initial_balance"];
  print "<br>User is: $x<br>";
  print "<br>Initial Balance is $: $y<br>";
  

};

echo "<br> Mail copy was requested but that service is not yet implemented.<br>";

echo "<br>This interaction is completed<br>";

?>





