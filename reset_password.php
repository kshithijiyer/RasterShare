<!--
Reset password
Description: Php script to reset the password.
Author:Kshithij Iyer
Date: 25/8/2017
Email: ahole@disroot.org
-->
<?php
	session_start();
	include_once("db_connection.php");
	#Creating a connection to db.
	$connection=mysqli_connect($host,$username,$password,$db_name);
	$query="";
	if(mysqli_connect_errno()){
		die("Unable to connect to the database please check the settings in db_connection.php.");
	}	
	#checking if user is legit
	$query="SELECT * FROM ".$table_prefix."user WHERE password='".sha1($_POST["current_password"].$nacl)."' AND uid=".$_SESSION["uid"].";";
	$result=mysqli_query($connection,$query);
	if(mysqli_num_rows($result)>0){
		while($row=mysqli_fetch_assoc($result)){
			#changing password
			$query="UPDATE ".$table_prefix."user SET password='".sha1($_POST["new_password"].$nacl)."' WHERE uid=".$row['uid'].";";
			if(mysqli_query($connection,$query)==1){
				echo "Password changed!";
			}
		}
	}
	#closing connnection	
	mysqli_close($connection);
?>
