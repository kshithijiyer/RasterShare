<!--
post script
Description: A Script to post new images on the blog.
Author: Kshithij Iyer
Date: 7/9/2017
Email: ahole@disroot.org
-->
<?php
	session_start();
	include_once("db_connection.php");
	
	#Getting the file and saving it on the server.
	$file=$_FILES["myfile"]["tmp_name"];
	$filename=date("Y_m_d_h_i_s_",time()).$_SESSION["uid"]."_".$_FILES["myfile"]["name"];
	copy($file,getcwd()."/images/".$filename);
	chmod(getcwd()."/images/".$filename,0777);
	
	#Establishing a connection between the database and the script 	
	$connection=mysqli_connect($host,$username,$password,$db_name);
	$query="";
	if(mysqli_connect_errno()){
		die("Unable to connect to the database please check the settings in db_connection.php.");
	}
	
	#Query to insert data for mobile devices.
	if($_POST["dev_type"]==0){
		if(strcmp($_POST["lat"],"NULL")&&strcmp($_POST["longi"],"NULL")){
			$query="INSERT INTO ".$table_prefix."post(uid, date, file_name, caption, hashtags, device_model, app) values(".$_SESSION["uid"].", now(),'".$filename."','".$_POST["caption"]."','".$_POST["hashtag"]."',".$_POST["device"].",".$_POST["app"].");";
		} 
		else{
			$query="INSERT INTO ".$table_prefix."post(uid, date, file_name, caption, hashtags, device_model, app, latitude, longitude) values(".$_SESSION["uid"].", now(),'".$filename."','".$_POST["caption"]."','".$_POST["hashtag"]."',".$_POST["device"].",".$_POST["app"].",".$_POST["lat"].",".$_POST["longi"].");";
		}
		if(mysqli_query($connection,$query)==1){
			echo "Post submitted! <br> \n";
		}
	}
	#Query to insert data for camera.
	else if($_POST["dev_type"]==1){
		if(strcmp($_POST["lat"],"NULL")&&strcmp($_POST["longi"],"NULL")){
			$query="INSERT INTO ".$table_prefix."post(uid, date, file_name, caption, hashtags, device_model, lenid, iso,  shutter_speed) values(".$_SESSION["uid"].", now(),'".$filename."','".$_POST["caption"]."','".$_POST["hashtag"]."',".$_POST["device"].",".$_POST["lens"].",".$_POST["iso"].",".$_POST["ss"].");";
		}
		else{
			$query="INSERT INTO ".$table_prefix."post(uid, date, file_name, caption, hashtags, device_model, lenid, iso,  shutter_speed, latitude, longitude) values(".$_SESSION["uid"].", now(),'".$filename."','".$_POST["caption"]."','".$_POST["hashtag"]."',".$_POST["device"].",".$_POST["lens"].",".$_POST["iso"].",".$_POST["ss"].",".$_POST["lat"].",".$_POST["longi"].");";
		}
		if(mysqli_query($connection,$query)==1){
			echo "Post submitted! <br> \n";
		}	
	}
	#divert and close connection
	header("Location: account.php");
	mysqli_close($connection);
?>
