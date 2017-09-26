<!--
Update usermeta script
Description: A Script to update usermeta data .
Author: Kshithij Iyer
Date: 24/10/2017
Email: ahole@disroot.org
-->
<?php
	session_start();
	
	include_once("db_connection.php");
	
	#Getting the file and saving it on the server.
	$file=$_FILES["myfile"]["tmp_name"];
	$filename=$_SESSION["uid"];
	if($_FILES["myfile"]["error"] == 4){
		echo "Avatar not updated";
	}
	else{
	unlink(getcwd()."/userdp/".$filename);
	copy($file,getcwd()."/userdp/".$filename);
	chmod(getcwd()."/userdp/".$filename,0777);
	}
	#Establishing a connection between the database and the script 	
	$connection=mysqli_connect($host,$username,$password,$db_name);
	$query="";
	if(mysqli_connect_errno()){
		die("Unable to connect to the database please check the settings in db_connection.php.");
	}
	#checking if meta data avaliable
	$query="SELECT * FROM ".$table_prefix."usermeta WHERE uid=".$_SESSION["uid"].";";
	$result=mysqli_query($connection,$query);
	if(mysqli_num_rows($result)>0){
		echo "update";
		$query="UPDATE ".$table_prefix."usermeta SET file_name=\"".$filename."\",display_name=\"".$_POST["display_name"]."\",bio=\"".$_POST["display_bio"]."\" WHERE uid=".$_SESSION["uid"].";";
		mysqli_query($connection,$query);
	}
	#adding new record
	else{
		echo "insert";
		$query="INSERT INTO ".$table_prefix."usermeta(uid,file_name,display_name,bio) VALUES(".$_SESSION["uid"].",\"".$filename."\",\"".$_POST["display_name"]."\",\"".$_POST["display_bio"]."\");";
		mysqli_query($connection,$query);
	}
	mysqli_query($connection,$query);
	#closing connection and diverting to account page
	header("Location: account.php");
	mysqli_close($connection);
?>
