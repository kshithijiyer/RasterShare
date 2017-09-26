<?php
	/*
	Post data anchor
	Description:This is a php script to all the information from post table.
	Author:Kshithij Iyer
	Date: 25/9/2017
	Email: ahole@disroot.org
	*/
	include_once("db_connection.php");
	function get_postdata($post_id){
		include_once("db_connection.php");
		global $host,$username,$password,$db_name,$table_prefix;
		global $app,$lens,$shutter_speed,$iso,$caption,$lens_type,$hashtags,$latitude,$longitude,$date,$device;
		#connectivity object
		$connection=mysqli_connect($host,$username,$password,$db_name);	
		#select query
		$query="SELECT * FROM ".$table_prefix."post WHERE postid=".$post_id.";";
		$result=mysqli_query($connection,$query);		
		#fetching and setting values in variables
		if(mysqli_num_rows($result)>0){
			while($row=mysqli_fetch_assoc($result)){	
				$caption=$row["caption"];
				$hashtags=$row["hashtags"];
				$query2="SELECT * FROM ".$table_prefix."device WHERE deviceid=".$row["device_model"].";";
				$result2=mysqli_query($connection,$query2);
				if(mysqli_num_rows($result2)>0){
					while($row2=mysqli_fetch_assoc($result2)){
						$device=$row2["dev_name"];
						if($row2["dev_type"]==0){
							$lens="----";
							$lens_type="----";
							$shutter_speed="----";
							$iso="----";
							$query3="SELECT * FROM ".$table_prefix."app WHERE appid=".$row["app"].";";
							$result3=mysqli_query($connection,$query3);
							if(mysqli_num_rows($result3)>0){
								while($row3=mysqli_fetch_assoc($result3)){
									$app=$row3["name"];
								}
							}
						}
						else{
							$query3="SELECT * FROM ".$table_prefix."lens WHERE lensid=".$row["lenid"].";";
							$result3=mysqli_query($connection,$query3);
							if(mysqli_num_rows($result3)>0){
								while($row3=mysqli_fetch_assoc($result3)){
									$lens=$row3["name"];
									$query4="SELECT * FROM ".$table_prefix."lens_type WHERE lens_type_id=".$row3["lens_type"].";";
									$result4=mysqli_query($connection,$query4);
									if(mysqli_num_rows($result4)>0){
										while($row4=mysqli_fetch_assoc($result4)){
											$lens_type=$row4["lens_name"];
										}
									}
								}		
							}
							$shutter_speed=$row["shutter_speed"];
							$iso=$row["iso"];
							$app="----";
						}
						$latitude=$row["latitude"];
						$longitude=$row["longitude"];
						$date=$row["date"];
					}
				}
			}
		}
	#closing the connection 
	mysqli_close($connection);	
	}
?>

