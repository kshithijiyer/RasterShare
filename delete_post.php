<!--
Delete post script
Description: Php script to delete posts from the db.
Author:Kshithij Iyer
Date: 9/9/2017
Email: ahole@disroot.org
-->
<?php 	
	include_once("db_connection.php");
	#Creating a connection to db.
	$connection=mysqli_connect($host,$username,$password,$db_name);
	$query="";
	if(mysqli_connect_errno()){
		die("Unable to connect to the database please check the settings in db_connection.php.");
	}
	#Deleting the selected posts
	for($counter=0;$counter<sizeof($_POST["postid"]);$counter++){
		$query.="DELETE FROM ".$table_prefix."post WHERE postid=".$_POST["postid"][$counter].";";
	}
	#Executing the query 
	mysqli_multi_query($connection,$query);
	#connection closed
	mysqli_close($connection);
	echo "Post/posts deleted! <br> Please Refresh now to see the changes.";
?>
