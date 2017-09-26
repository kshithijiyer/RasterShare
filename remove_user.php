<!--
admin/user removal script
Description: Php script to remove user/admin.
Author:Kshithij Iyer
Date: 23/8/2017
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
	#Deleting user
	$query="DELETE FROM ".$table_prefix."user where email='".$_POST["username"]."';";
		if(mysqli_query($connection,$query)==1){
			echo "User/admin with username ".$_POST["username"]." removed! <br> \n";
	}else{
			die("Unable to remove users!");
	}
	#closing connection
	mysqli_close($connection);
?>
