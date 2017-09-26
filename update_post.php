<!--
Update post form genertor
Description: Php script to produce the form to Update posts present in the db.
Author:Kshithij Iyer
Date: 11/9/2017
Email: ahole@disroot.org
-->
<?php
	include_once("db_connection.php");
	#connection object
	$connection=mysqli_connect($host,$username,$password,$db_name);	
	#select query
	$query="SELECT * FROM ".$table_prefix."post WHERE postid=".$_POST["postid"][0].";";
	$result=mysqli_query($connection,$query);
	if(mysqli_num_rows($result)>0){
		while($row=mysqli_fetch_assoc($result)){
			#generating a form
			echo "<form method='post' action='update_post_entry.php'>";
				echo "<input type='hidden' name='postid' id='postid' value=\"".$_POST["postid"][0]."\">";
				echo "<table>";
					echo "<tr><td><img src='./images/".$row["file_name"]."' style='width:300px;height:300px;'></td></tr>";
					echo "<tr><td>caption</td><td><input type='text' class='textbox' id='caption' name='caption' value=\"".$row["caption"]."\"></td></tr>";
					echo "<tr><td>hashtags</td><td><input type='text' class='textbox' id='hashtags' name='hashtags' value=\"".$row["hashtags"]."\"></td></tr>";
					echo "<tr><td>Shutter Speed</td><td><input type='text' class='textbox' id='SS' name='SS' value=".$row["shutter_speed"]."></td></tr>";
					echo "<tr><td>ISO</td><td><input type='text' class='textbox' id='ISO' name='ISO' value=".$row["iso"]."></td></tr>";
					echo "<tr><td>Lattitude</td><td><input type='text' class='textbox' id='lat' name='lat' value=".$row["latitude"]."></td></tr>";
					echo "<tr><td>Longitude</td><td><input type='text' class='textbox' id='longi' name='longi' value=".$row["longitude"]."></td></tr>";
					$query2="SELECT * FROM ".$table_prefix."device WHERE deviceid=".$row["device_model"].";";
					$result2=mysqli_query($connection,$query2);
					$row2=mysqli_fetch_assoc($result2);
					echo "<tr><td>Device model</td><td><input type='text' class='textbox' id='dev_name' name='dev_name' value=\"".$row2["dev_name"]."\"></td></tr>";
					$row3["name"]="";
					if($row["lenid"]!=Null){
						$query3="SELECT * FROM ".$table_prefix."lens WHERE lensid=".$row["lenid"].";";
						$result3=mysqli_query($connection,$query3);
						$row3=mysqli_fetch_assoc($result3);
					}
					echo "<tr><td>Lens</td><td><input type='text' class='textbox' id='lens' name='lens' value=\"".$row3["name"]."\"></td></tr>";
					$row3["name"]="";
					if($row["app"]!=Null){
						$query3="SELECT * FROM ".$table_prefix."app WHERE appid=".$row["app"].";";
						$result3=mysqli_query($connection,$query3);
						$row3=mysqli_fetch_assoc($result3);										
					}
					echo "<tr><td>Application</td><td><input type='text' class='textbox' id='app' name='app' value=\"".$row3["name"]."\"></td></tr>";
					echo "<tr><td><button name='submit' id='submit' type='submit' class='btn'>Update</button></td></tr>"; 
				echo "</table>";
			echo "</form>";
		}
	}	
	#closing the connection 
	mysqli_close($connection);
?>
