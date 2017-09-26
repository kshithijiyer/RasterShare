<!--
New admin/user creation script
Description: Php script to create a new user/admin.
Author:Kshithij Iyer
Date: 23/8/2017
Email: ahole@disroot.org
-->
<?php
	include_once("db_connection.php");
	include_once("password_generator.php");
	#Creating a connection to RasterShare db.
	$connection=mysqli_connect($host,$username,$password,$db_name);
	$query="";
	if(mysqli_connect_errno()){
		die("Unable to connect to the database please check the settings in db_connection.php.");
	}
	#checking if user exist or else inserting
	$query="SELECT * FROM ".$table_prefix."user WHERE email='".$_POST["username"]."';";
	$result=mysqli_query($connection,$query);
	if(mysqli_num_rows($result)>0){
		echo "User already exists!";
	}
	else{
	$query="INSERT INTO ".$table_prefix."user(email,password,user_group) VALUES('".$_POST["username"]."','".sha1($default_password.$nacl)."',".$_POST["role"].");";
		if(mysqli_query($connection,$query)==1){
			echo "Admin/user Created! <br> \n";
			echo "The password for Admin/user is <u>".$default_password."</u> .<br> \n Please change the deault password after the first login! <br> \n";
	}else{
			die("Unable to add the admin/user!");
	}
	}
	#closing connection
	mysqli_close($connection);
?>
