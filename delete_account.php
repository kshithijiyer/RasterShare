<!--
Delete script
Description: This script deletes single user from the table.
Author: Kshithij Iyer
Date: 24/8/2017
Email: ahole@disroot.org
-->
<?php
	session_start();
	include_once("db_connection.php");
	#connection object
	$connection=mysqli_connect($host,$username,$password,$db_name);
	#queries 	
	$query="DELETE FROM ".$table_prefix."user WHERE uid=".$_POST["uid"].";";
	#Executing the query 
	mysqli_multi_query($connection,$query);
	echo "Record deleted";
	#closing the connection 
	mysqli_close($connection);
	#redirect
	header("Location: homepage.php")
?>
