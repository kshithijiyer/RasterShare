<!--
Logout script
Description: A script to destory the Session.
Author: Kshithij Iyer
Date: 29/8/2017
Email: ahole@disroot.org
-->
<?php
	include_once("db_connection.php");
	#connectivity object
	$connection=mysqli_connect($host,$username,$password,$db_name);	
	#select query
	$query="SELECT * FROM ".$table_prefix."device WHERE deviceid=".$_POST["devid"].";";
	$result=mysqli_query($connection,$query);
	#returning lens or app dropdown based on user selection
	if(mysqli_num_rows($result)>0){
		while($row=mysqli_fetch_assoc($result)){
			if($row["dev_type"]==0){
				echo "<select id='app' name='app' class='btn'>";
				$query="SELECT * FROM ".$table_prefix."app ;";
				$result=mysqli_query($connection,$query);
				if(mysqli_num_rows($result)>0){
					while($row=mysqli_fetch_assoc($result)){
					echo "<option value=".$row["appid"].">".$row["name"]."</option>";
					}
				}
				echo "</select>";
				echo "<input type='hidden' id='dev_type' name='dev_type' value='0'>";
			}
			else{
				echo "<select id='lens' name='lens' class='btn'>";
				$query="SELECT * FROM ".$table_prefix."lens ;";
				$result=mysqli_query($connection,$query);
				if(mysqli_num_rows($result)>0){
					while($row=mysqli_fetch_assoc($result)){
					echo "<option value=".$row["lensid"].">".$row["name"]."</option>";
					}
					echo "<input type='text' class='textbox' placeholder='Shutter Speed' id='ss' name='ss'><input type='text' class='textbox' placeholder='ISO' name='iso' id='iso'>";
				}
				echo "</select>";
				echo "<input type='hidden' id='dev_type' name='dev_type' value='1'>";
			}
		}
	}	
	#closing the query 
	mysqli_close($connection);	
?>
