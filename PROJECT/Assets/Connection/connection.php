<?php
$server="localhost";
$user="root";
$pw="";
$db="db_railway";
$con=mysqli_connect($server,$user,$pw,$db);
if(!$con)
{
	echo "not connected";
}
?>

