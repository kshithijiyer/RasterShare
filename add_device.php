<!--
Add device script
Description: Php script to add new devices.
Author:Kshithij Iyer
Date: 25/8/2017
Email: ahole@disroot.org
-->
<?php
	include_once("db_connection.php");
	#Creating a connection to RasterShare db.
	$connection=mysqli_connect($host,$username,$password,$db_name);
	$query="";
	if(mysqli_connect_errno()){
		die("Unable to connect to the database please check the settings in db_connection.php.");
	}
	#checking if device exist
	$query="SELECT * FROM ".$table_prefix."device WHERE dev_name='".$_POST["device_name"]."';";
	$result=mysqli_query($connection,$query);
	if(mysqli_num_rows($result)>0){
		echo "Device already there in the system! <br> \n";
	}
	#adding new device 
	else{
		$query="INSERT INTO ".$table_prefix."device(dev_name,dev_type) VALUES('".$_POST["device_name"]."',".$_POST["type"].");";
		if(mysqli_query($connection,$query)==1){
			echo "Device added to system! <br> \n";
		}
		else{
			die("Unable to add device!");
		}
	}
	#connection closed
	mysqli_close($connection);
?>

