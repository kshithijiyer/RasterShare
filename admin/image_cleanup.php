<?php
	/*
	Image directory cleanup script
	Description:This is a php script to delete the images of the posts that are deleted.
	Author:Kshithij Iyer
	Date: 25/9/2017
	Email: ahole@disroot.org 
	*/
	include_once("../db_connection.php");
	#connectivity object
	$connection=mysqli_connect($host,$username,$password,$db_name);	
	$director=opendir("../images/");
	$file_array=array();
	while($file=readdir($director)){
		$file_array[]=$file;
	}
	chdir("../images/");
	for($index=0;$index<sizeof($file_array);$index++){
		$query="SELECT * FROM ".$table_prefix."post WHERE file_name='".$file_array[$index]."';";
		if(mysqli_connect_errno()){
			die("Unable to connect to the database please check the settings in db_connection.php.");
		}
		$result=mysqli_query($connection,$query);
		if(mysqli_num_rows($result)==0){
			unlink($file_array[$index]);
		}	
	}
	echo "Image dir cleaned!";
?>
