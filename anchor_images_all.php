<?php
	/*
	images all anchor
	Description:This is a php script to retrive picture from post table.
	Author:Kshithij Iyer
	Date: 25/9/2017
	Email: ahole@disroot.org
	*/
	include_once("db_connection.php");
	
	function get_images_all($user_id){
		include_once("db_connection.php");
		global $host,$username,$password,$db_name,$table_prefix;
		global $images,$postids;
		$images=array();
		$postids=array();	
		#connectivity object
		$connection=mysqli_connect($host,$username,$password,$db_name);	
		#select query
		$query="SELECT * FROM ".$table_prefix."post WHERE uid=".$user_id." order by postid desc;";
		$result=mysqli_query($connection,$query);
		#setting values in variables
		if(mysqli_num_rows($result)>0){
			while($row=mysqli_fetch_assoc($result)){
				$images[]=$row["file_name"];
				$postids[]=$row["postid"];
			}
		}	
		#closing the connection 
		mysqli_close($connection);	
	}
?>
