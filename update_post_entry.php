<!--
Update post script
Description: Php script to Update posts present in the db.
Author:Kshithij Iyer
Date: 23/9/2017
Email: ahole@disroot.org
-->
<?php
	session_start();
	include_once("db_connection.php");
	#connectivity object
	$connection=mysqli_connect($host,$username,$password,$db_name);	

	#getting the device, app and lens id.
	$query_device="SELECT * FROM ".$table_prefix."device WHERE dev_name like '".$_POST["dev_name"]."%';";
	echo $query_device;	
	$result_device=mysqli_query($connection,$query_device);
	$row=mysqli_fetch_assoc($result_device);

	#Update query execution according to the device type. 
	if($row["dev_type"]==0){
		$query_app="SELECT * FROM ".$table_prefix."app WHERE name='".$_POST["app"]."';";
		$result_app=mysqli_query($connection,$query_app);
		$row_app=mysqli_fetch_assoc($result_app);
		#checking if lat and long are null
		if(strcmp($_POST["lat"],"NULL")&&strcmp($_POST["longi"],"NULL")){
			echo "without lat long";
			$update_query="UPDATE ".$table_prefix."post SET caption='".$_POST["caption"]."', hashtags='".$_POST["hashtags"]."', device_model=".$row["deviceid"].", app=".$row_app["appid"]." WHERE uid=".$_SESSION["uid"]." AND postid=".$_POST["postid"].";";
			echo mysqli_query($connection,$update_query);
			echo $update_query;
		}
		else{
			echo "with lat long";
			$update_query="UPDATE ".$table_prefix."post SET caption='".$_POST["caption"]."', hashtags='".$_POST["hashtags"]."', device_model=".$row["deviceid"].", app=".$row_app["appid"].", latitude=".$_POST["lat"].", longitude=".$_POST["longi"]." WHERE uid=".$_SESSION["uid"]." AND postid=".$_POST["postid"].";";
			echo mysqli_query($connection,$update_query);
			echo $update_query;
		}
	}else if($row["dev_type"]==1){
		$query_lens="SELECT * FROM ".$table_prefix."lens WHERE name='".$_POST["lens"]."';";
		$result_lens=mysqli_query($connection,$query_lens);
		$row_lens=mysqli_fetch_assoc($result_lens);
		#checking if lat and long are null
		if(strcmp($_POST["lat"],"NULL")&&strcmp($_POST["longi"],"NULL")){
			$update_query="UPDATE ".$table_prefix."post SET caption='".$_POST["caption"]."', hashtags='".$_POST["hashtags"]."', device_model=".$row["deviceid"].", lenid=".$row_lens["lensid"].", shutter_speed=".$_POST["SS"].",iso=".$_POST["ISO"]." WHERE uid=".$_SESSION["uid"]." AND postid=".$_POST["postid"].";";
			echo mysqli_query($connection,$update_query);
			echo $update_query;
		}
		else{
			$update_query="UPDATE ".$table_prefix."post SET caption='".$_POST["caption"]."', hashtags='".$_POST["hashtags"]."', device_model=".$row["deviceid"].", lenid=".$row_lens["lensid"].", latitude=".$_POST["lat"].", longitude=".$_POST["longi"].", shutter_speed=".$_POST["SS"].",iso=".$_POST["ISO"]." WHERE uid=".$_SESSION["uid"]." AND postid=".$_POST["postid"].";";
			echo $update_query;
			echo mysqli_query($connection,$update_query);
		}
	}
	#closing the connection  and divert
	mysqli_close($connection);
	header("Location: account.php");
?>
