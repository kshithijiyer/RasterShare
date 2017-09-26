<!--
Login script
Description: This script checks if the user is a valid user or not and creates a session for the user.
Author: Kshithij Iyer
Date: 24/8/2017
Email: ahole@disroot.org
-->
<?php
	include_once("db_connection.php");
	#creating connection
	$connection=mysqli_connect($host,$username,$password,$db_name);
	if(mysqli_connect_errno()){
			die("Unable to connect to the database please check the settings in db_connection.php.");
	}
	#checking email and password
	$query="SELECT * FROM ".$table_prefix."user WHERE email='".$_POST["email"]."' and password='".sha1($_POST["password"].$nacl)."';";
	$result=mysqli_query($connection,$query);
	if(mysqli_num_rows($result)>0){
		session_start();
		$row=mysqli_fetch_assoc($result);
		#setting session variable
		$_SESSION["username"]=$row["email"];
		$_SESSION["uid"]=$row["uid"];
		$_SESSION["user_group"]=$row["user_group"];
		
		#foward to proper page
		if($row["user_group"]==90){
			header("Location: adminaccount.php");
		}
		else if($row["user_group"]==99){
			header("Location: account.php");
		}
	}
	else{
		header("Location: login.php");
	}
	
?>
