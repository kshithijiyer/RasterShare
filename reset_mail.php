<!--
Reset mail
Description: Php script to reset the mail.
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
	#checking if email is ligit
	$query="SELECT * FROM ".$table_prefix."user WHERE email='".$_POST["current_mail"]."' AND uid=".$_SESSION["uid"].";";
	$result=mysqli_query($connection,$query);
	if(mysqli_num_rows($result)>0){
		while($row=mysqli_fetch_assoc($result)){
			#changing email
			$query="UPDATE ".$table_prefix."user SET email='".$_POST["new_mail"]."' WHERE uid=".$row['uid'].";";
			if(mysqli_query($connection,$query)==1){
				echo "Mail ID changed!";
			}
		}
	}	
	#connection closed
	mysqli_close($connection);
?>
