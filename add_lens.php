<!--
Add lens script
Description: Php script to add new lens.
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
	#checking if lens exist
	$query="SELECT * FROM ".$table_prefix."lens WHERE name='".$_POST["name"]."';";
	$result=mysqli_query($connection,$query);
	if(mysqli_num_rows($result)>0){
		echo "lens already there in the system! <br> \n";
	}
	#adding new lens
	else{
		$query="INSERT INTO ".$table_prefix."lens(name,lens_type) VALUES('".$_POST["name"]."',".$_POST["type"].");";
		if(mysqli_query($connection,$query)==1){
			echo "lens added to system! <br> \n";
		}
		else{
			die("Unable to add lens!");
		}
	}
	#connection closed
	mysqli_close($connection);
?>
