<!--
Add app script
Description: Php script to add new apps.
Author:Kshithij Iyer
Date: 25/8/2017
Email: ahole@disroot.org
-->
<?php
	include_once("db_connection.php");
	#Creating a connection to db.
	$connection=mysqli_connect($host,$username,$password,$db_name);
	$query="";
	if(mysqli_connect_errno()){
		die("Unable to connect to the database please check the settings in db_connection.php.");
	}
	#checking if application already exist in the system
	$query="SELECT * FROM ".$table_prefix."app WHERE name='".$_POST["app_name"]."';";
	$result=mysqli_query($connection,$query);
	if(mysqli_num_rows($result)>0){
		echo "Application already there in the system! <br> \n";
	}
	#adding app to db.
	else{
		$query="INSERT INTO ".$table_prefix."app(name) VALUES('".$_POST["app_name"]."');";
		if(mysqli_query($connection,$query)==1){
			echo "App added to system! <br> \n";
		}
		else{
			die("Unable to add app!");
		}
	}
	#closing connection
	mysqli_close($connection);
?>

