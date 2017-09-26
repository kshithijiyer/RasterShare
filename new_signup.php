<!--
New user creation script
Description: A php script to add new users to the database.
Author: Kshithij Iyer
Date: 24/8/2017
Email: ahole@disroot.org
-->
<?php
	include_once("db_connection.php");
	#connection creation
	$connection=mysqli_connect($host,$username,$password,$db_name);
	#email validation
	if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
		header("Location: signup.php");
	}
	#password match
	if($_POST["password1"]==$_POST["password2"]){	
		$query="SELECT * FROM ".$table_prefix."user WHERE email='".$_POST["email"]."';";
		if(mysqli_connect_errno()){
			die("Unable to connect to the database please check the settings in db_connection.php.");
		}
		$result=mysqli_query($connection,$query);
		if(mysqli_num_rows($result)==0){
			#adding user
			$query="INSERT INTO ".$table_prefix."user(email,password,user_group) VALUES('".$_POST["email"]."','".sha1($_POST["password1"].$nacl)."',99);";
			mysqli_query($connection,$query);
			#divert and connection closed
			header("Location: login.php");
			mysqli_close($connection);
		}else{
			header("Location: login.php");
		}
	}
	else{
		#divert and connection closed
		header("Location: signup.php");
		mysqli_close($connection);
	}
?>

