<!--
Install script 
Description:This is the installation script of RasterShare.
Author:Kshithij Iyer
Date: 15/8/2017
Email: ahole@disroot.org
Note: This should only be executed ONCE. 
-->
<?php
	#Getting the setup information.
	include_once("../db_connection.php");

	#Creating a connection to RasterShare db.
	$connection=mysqli_connect($host,$username,$password,$db_name);
	$query="";
	if(mysqli_connect_errno()){
		die("Unable to connect to the database please check the settings in db_connection.php.");
	}
	
	#Creating user table
	$query="CREATE TABLE ".$table_prefix."user(uid INT NOT NULL AUTO_INCREMENT PRIMARY KEY, email  VARCHAR(100) NOT NULL, password VARCHAR(40) NOT NULL, user_group INT(2));";
	if(mysqli_query($connection,$query)==1){
		echo "User table created! <br> \n";
	
		#Generating a default Password.
		include_once("../password_generator.php");
	
		#Adding admin to user table
		$query="INSERT INTO ".$table_prefix."user(email,password,user_group) values('".$default_admin."','".sha1($default_password.$nacl)."',90);";
		if(mysqli_query($connection,$query)==1){
			echo "Admin Created! <br> \n";
			echo "The password for Admin is <u>".$default_password."</u> .<br> \n Please change the deault password after the first login! <br> \n";
		}else{
			die("Unable to add the admin user!");
		}
		
	}
	else{
	 die("Unable to create User table!");
	}
	
	#Creating App table
	$query="CREATE TABLE ".$table_prefix."app(appid INT NOT NULL AUTO_INCREMENT PRIMARY KEY, name VARCHAR(10) NOT NULL);";
	if(mysqli_query($connection,$query)==1){
		echo "App table created! <br> \n";
	}
	else{
		die("Unable to create App table!");
	}
		
	#Creating lens_type table
	$query="CREATE TABLE ".$table_prefix."lens_type(lens_type_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, lens_name VARCHAR(10) NOT NULL);";
	if(mysqli_query($connection,$query)==1){
		
		#Adding different types of lens to lens_type table
		echo "Lens_type table created! <br> \n";
		$query="INSERT INTO ".$table_prefix."lens_type(lens_name) VALUES('macro');"."INSERT INTO ".$table_prefix."lens_type(lens_name) VALUES('Wide Angle Zoom');"."INSERT INTO ".$table_prefix."lens_type(lens_name) VALUES('Standard Zoom');";
		$query.="INSERT INTO ".$table_prefix."lens_type(lens_name) VALUES('Fisheye lens');"."INSERT INTO ".$table_prefix."lens_type(lens_name) VALUES('Fisheye lens');"."INSERT INTO ".$table_prefix."lens_type(lens_name) VALUES('Wide Angle');";
		$query.="INSERT INTO ".$table_prefix."lens_type(lens_name) VALUES('Normal');"."INSERT INTO ".$table_prefix."lens_type(lens_name) VALUES('Telephoto');"."INSERT INTO ".$table_prefix."lens_type(lens_name) VALUES('Tilt-Shift');";
		if(mysqli_multi_query($connection,$query)==1){
			echo "Data added to lens_type table! <br> \n";
		}
		else{
			die("Unable to add data to lens_type table!");
		}
	}
	else{
		die("Unable to create lens_type table!");
	}
	#Creating a connection to RasterShare db.(This is a fallback mechanism).
	$connection=mysqli_connect($host,$username,$password,$db_name);
	
	#Creating lens table
	$query="CREATE TABLE ".$table_prefix."lens(lensid INT NOT NULL AUTO_INCREMENT PRIMARY KEY, name VARCHAR(50) NOT NULL, lens_type INT(2));";
	if(mysqli_query($connection,$query)==1){
		echo "Lens table created! <br> \n";
	}
	else{
		die("Unable to create lens table!");
	}
	
	#Creating device table
	$query="CREATE TABLE ".$table_prefix."device(deviceid INT NOT NULL AUTO_INCREMENT PRIMARY KEY, dev_name VARCHAR(60) NOT NULL, dev_type INT(2));";
	if(mysqli_query($connection,$query)==1){
		echo "Device table created! <br> \n";
	}
	else{
		die("Unable to create device table!");
	}
	
	#Creating post table
	$query="CREATE TABLE ".$table_prefix."post(postid INT NOT NULL AUTO_INCREMENT PRIMARY KEY, uid INT, date DATETIME, file_name VARCHAR(50) NOT NULL, caption VARCHAR(150),hashtags VARCHAR(100),device_model INT, lenid INT, shutter_speed INT, iso INT, app INT, latitude double, longitude double);";
	if(mysqli_query($connection,$query)==1){
		echo "Post table created! <br> \n";
	}
	else{
		die("Unable to create Post table!");
	}
	
	
	#Creating usermeta table
	$query="CREATE TABLE ".$table_prefix."usermeta(uid INT NOT NULL AUTO_INCREMENT PRIMARY KEY, file_name VARCHAR(50) NOT NULL, display_name VARCHAR(30), bio VARCHAR(150));";
	if(mysqli_query($connection,$query)==1){
		echo "UserMeta table created! <br> \n";
	}
	else{
		die("Unable to create UserMeta table!");
	}
?>
