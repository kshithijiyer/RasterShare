<?php
	/*
	image anchor
	Description:This is a php script to retrive picture from post table.
	Author:Kshithij Iyer
	Date: 24/9/2017
	Email: ahole@disroot.org
	*/
	include_once("db_connection.php");
	
	function get_image($post_id){
		include_once("db_connection.php");
		global $host,$username,$password,$db_name,$table_prefix;
		global $image;
		#connectivity object
		$connection=mysqli_connect($host,$username,$password,$db_name);	
		#select query
		$query="SELECT * FROM ".$table_prefix."post WHERE postid=".$post_id.";";
		$result=mysqli_query($connection,$query);
		#setting values in variables
		if(mysqli_num_rows($result)>0){
			$row=mysqli_fetch_assoc($result);
			$image=$row["file_name"];
		}	
		#closing the connection 
		mysqli_close($connection);	
	}
?>
