<?php
	/*
	Usermeta anchor
	Description:This is a php script to retrive Display name, bio and user display picture from usermeta table.
	Author:Kshithij Iyer
	Date: 24/9/2017
	Email: ahole@disroot.org
	*/
	include_once("db_connection.php");
	function get_usermeta($user_id){
		include_once("db_connection.php");
		global $host,$username,$password,$db_name,$table_prefix;
		global $display_name,$display_pic,$bio;
		#connectivity object
		$connection=mysqli_connect($host,$username,$password,$db_name);	
		#select query
		$query="SELECT * FROM ".$table_prefix."usermeta WHERE uid=".$user_id.";";
		$result=mysqli_query($connection,$query);
		#setting values in variables
		if(mysqli_num_rows($result)>0){
			$row=mysqli_fetch_assoc($result);
			$display_name=$row["display_name"];
			$display_pic=$row["file_name"];
			$bio=$row["bio"];
		}	
		#closing the connection 
		mysqli_close($connection);	
	}
?>
