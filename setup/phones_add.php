<!--
Add phones script 
Description:This is the Add phones script of RasterShare.
Author:Kshithij Iyer
Date: 25/8/2017
Email: ahole@disroot.org
Note: This should only be executed ONCE. 
-->
<?php
	#Getting the setup information.
	include_once("../db_connection.php");
	$query="";
	#Creating a connection to RasterShare db.
	$connection=mysqli_connect($host,$username,$password,$db_name);
	if(mysqli_connect_errno()){
		die("Unable to connect to the database please check the settings in db_connection.php.");
	}
	#reading file and creating queries
	$file = fopen("phones.txt","r");
	while(! feof($file)){
		$query.="INSERT INTO ".$table_prefix."device(dev_name,dev_type) VALUES(\"".fgets($file)."\",0);";
	}
	#executing query
	mysqli_multi_query($connection,$query);
	echo "Phones added!<br>";
	#closing file and query
	fclose($file);
	mysqli_close($connection);
?>
