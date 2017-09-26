<!DOCTYPE html>
<!--
Account page
Description: This is the account page for Rastershare WCMS.
Author: Kshithij Iyer
Date: 19/7/2017
Email: ahole@disroot.org
-->
<?php
	#checking session
	session_start();
	if(!is_numeric($_SESSION["uid"])){
		header("Location: login.php");
	}
	else if($_SESSION["user_group"]==90){
		header("Location: login.php");
	}
?>
<html>
<head>
	<title>RasterShare</title>
	<link rel="stylesheet" type="text/css" href="./resources/css/account.css">
	<script type="text/javascript" src="./resources/lib/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript">
		window.history.forward();
		//code for the nav bar
		$(document).ready(function(){
			$("#post").click(function(){
				$("#post-div").show();
				$("#update-div").hide();
				$("#profile-div").hide();
				$("#settings-div").hide();
				$("#remove-div").hide();
			});
			$("#update").click(function(){
				$("#post-div").hide();
				$("#update-div").show();
				$("#profile-div").hide();
				$("#settings-div").hide();
				$("#remove-div").hide();
			});
			$("#profile").click(function(){
				$("#post-div").hide();
				$("#update-div").hide();
				$("#profile-div").show();
				$("#settings-div").hide();
				$("#remove-div").hide();
			});
			$("#settings").click(function(){
				$("#post-div").hide();
				$("#update-div").hide();
				$("#profile-div").hide();
				$("#settings-div").show();
				$("#remove-div").hide();
			});
			$("#remove").click(function(){
				$("#post-div").hide();
				$("#update-div").hide();
				$("#profile-div").hide();
				$("#settings-div").hide();
				$("#remove-div").show();
			});
			//Calling other php files and processing their output
			$("#reset_password").click(function(){
				var current_password=$("#current_password").val();
				var new_password=$("#new_password").val();
				$.post("reset_password.php",{ current_password:current_password,new_password:new_password },function(result){
					$("#reset_password_output").html(result);
				});
			});
			$("#reset_mail").click(function(){
				var current_mail=$("#current_mail").val();
				var new_mail=$("#new_mail").val();
				$.post("reset_mail.php",{ current_mail:current_mail,new_mail:new_mail },function(result){
					$("#reset_mail_output").html(result);
				});
			});
			$("#device").change(function(){
				var device=$("#device").val();
				$.post("lens_or_app.php",{ devid:device},function(result){
					$("#lens-or-app").html(result);
				});
			});
			$("#apply_action").click(function(){
				var postid=$("#postid").val();
				var data = { 'postid[]' : []};
				$("#postid:checked").each(function() {
					data['postid[]'].push($(this).val());
				});
				var operation=$("#operation").val();
				if(operation=="update"){
					$.post("update_post.php",data,function(result){
						$("#post-div").hide();
						$("#update-div").show();
						$("#profile-div").hide();
						$("#settings-div").hide();
						$("#remove-div").hide();
						$("#update-div").html(result);
					});
				}
				else{
					$.post("delete_post.php",data,function(result){
						$("#post-div").hide();
						$("#update-div").show();
						$("#profile-div").hide();
						$("#settings-div").hide();
						$("#remove-div").hide();
						$("#update-div").html(result);
					});
				}
			});
		});
	</script>
</head>
<body bgcolor="#BFBFBF">
	<header>
		<nav>
			<ul class="ul-horizontal">
				<li class="li-horizontal"><img src="./resources/images/logo.png" class="logo"></li>
				<li class="li-horizontal"><div class="logout"><form method="post" action="logout.php"><button class="btn" type="submit">Logout</button></form></div></li>
			</ul>
		</nav>
	</header>
	<ul class="ul-vertical">
  		<li class="li-vertical"><a id="post">Post</a></li>
  		<li class="li-vertical"><a id="remove">Remove/Update</a></li>
  		<li class="li-vertical"><a id="settings">Settings</a></li>
  		<li class="li-vertical"><a id="profile">Profile</a></li>
	</ul>
	<article>
		<div style="margin-left:25%;padding:1px 16px;height:1000px; display: none;" id="post-div">
			<form action="post.php" method="post" enctype="multipart/form-data" >
			<div class="upload-btn-wrapper">
				<button class="btn">Upload a file</button>
				<input type="file" name="myfile" id="myfile" accept="image/*" required />
			</div><br>
			<input type="text" class="textbox" placeholder="caption" id="caption" name="caption" required>
			<input type="text" class="textbox" placeholder="hashtags (words seperated by ',')" id="hashtag" name="hashtag">
			<input type="text" class="textbox" placeholder="lattitude" id="lat" name="lat">
			<input type="text" class="textbox" placeholder="longitude" id="longi" name="longi">
			<select id="device" name="device" class="btn"> 
			<?php
				include_once("db_connection.php");
				#connectivity object
				$connection=mysqli_connect($host,$username,$password,$db_name);	
				#select query
				$query="SELECT * FROM ".$table_prefix."device;";
				$result=mysqli_query($connection,$query);
				#fetching devices
				if(mysqli_num_rows($result)>0){
					while($row=mysqli_fetch_assoc($result)){
						echo "<option value=".$row[deviceid].">".$row[dev_name]."</option>";
					}
				}	
				#closing the connection
				mysqli_close($connection);
			?>	
			</select>
			<div id="lens-or-app"></div>
			<button class="btn" type="submit" id="post" name="post">Post</button>
			</form>
		</div>
		<div style="margin-left:25%;padding:1px 16px;height:1000px; display: none;" id="profile-div">
		<?php
			#calling the usermeta anchor to get the existing data
			include_once("anchor_usermeta.php");
			get_usermeta($_SESSION["uid"]);
			echo "<img src='./userdp/".$_SESSION["uid"]."' style='width:128px;height:128px;'>";
		?>
		<form action="update_usermeta.php" method="post" enctype="multipart/form-data" >
			
			<div class="upload-btn-wrapper">
				<button class="btn">Upload a file</button>
				<input type="file" name="myfile" id="myfile" accept="image/*"/>
			</div><br>
			<strong>uid:</strong><div><?php echo $_SESSION["uid"];?></div><br>
			<strong>Display Name:</strong><br>
			<input type="text" value="<? echo $display_name;?>" id="display_name" name="display_name" class="textbox" maxlength="30"/>
			<strong>Bio:</strong><br>
			<input type="text" value="<? echo $bio;?>" id="display_bio" name="display_bio" class="textbox" maxlength="200"/>
			<button type="Submit" id="update_info" name="update_info" class="button">Update</button>
		</form>
		<form method="post" action="delete_account.php">
			<input type="hidden" value="<? echo $_SESSION["uid"];?>" name="uid" id="uid">
			<button type="Submit" id="delete_account" name="delete_account" class="button">Delete account</button>
		</form>
		</div>
		<div style="margin-left:25%;padding:1px 16px;height:1000px; display: none;" id="settings-div">
			<h1>Change password:</h1>
			<input type="password" placeholder="Current Password" id="current_password" name="current_password" class="textbox" />
			<input type="password" placeholder="New Password" id="new_password" name="new_password" class="textbox" />
			<button type="submit" id="reset_password" name="reset_password" class="button">Reset</button>
			<div id="reset_password_output"></div>
			<h1>Change Mail ID:</h1>
			<input type="text" placeholder="Current Mail ID" id="current_mail" name="current_mail" class="textbox" />
			<input type="text" placeholder="New Mail ID" id="new_mail" name="new_mail" class="textbox" />
			<button type="submit" id="reset_mail" name="reset_mail" class="button">Reset</button>
			<div id="reset_mail_output"></div>
		</div>
		<div style="margin-left:25%;padding:1px 16px; height:630px; display: none; overflow-y: scroll;" id="update-div">
		</div>
		<div style="margin-left:25%;padding:1px 16px; height:630px; display: none; overflow-y: scroll;" id="remove-div">
			<select id="operation" name="operation" class="btn">
				<option value="delete">Delete</option>
				<option value="update">Update</option>
			</select>
			<button type="submit" id="apply_action" name="apply_action" class="button">Apply</button>
			<table>
				<tr bgcolor="#E8E8E8"><td>Image</td><td>caption</td><td>Hashtag</td><td>Device model</td><td>Lens</td><td>Lens Type</td><td>Shutter speed</td><td>ISO</td><td>App</td><td>Latitude</td><td>Longitude</td><td>Date</td><td></td></tr>
				<?php
					include_once("db_connection.php");
					#connectivity object
					$connection=mysqli_connect($host,$username,$password,$db_name);	
					#select query
					$query="SELECT * FROM ".$table_prefix."post WHERE uid=".$_SESSION["uid"].";";
					$result=mysqli_query($connection,$query);
					#fetching data from multiple tables and displaying it.
					if(mysqli_num_rows($result)>0){
						while($row=mysqli_fetch_assoc($result)){	
							echo "<tr align='center' bgcolor='#CCCCCC'><td><img src='./images/".$row["file_name"]."' style='width:128px;height:128px;'></td><td>".$row["caption"]."</td><td>".$row["hashtags"]."</td>";
							$query2="SELECT * FROM ".$table_prefix."device WHERE deviceid=".$row["device_model"].";";
							$result2=mysqli_query($connection,$query2);
							if(mysqli_num_rows($result2)>0){
								while($row2=mysqli_fetch_assoc($result2)){
									echo "<td>".$row2["dev_name"]."</td>";
									if($row2["dev_type"]==0){
										echo "<td>-</td><td>-</td><td>-</td><td>-</td>";
										$query3="SELECT * FROM ".$table_prefix."app WHERE appid=".$row["app"].";";
										$result3=mysqli_query($connection,$query3);
										if(mysqli_num_rows($result3)>0){
											while($row3=mysqli_fetch_assoc($result3)){
												echo "<td>".$row3["name"]."</td>";
											}
										}
									}
									else{
										$query3="SELECT * FROM ".$table_prefix."lens WHERE lensid=".$row["lenid"].";";
										$result3=mysqli_query($connection,$query3);
										if(mysqli_num_rows($result3)>0){
											while($row3=mysqli_fetch_assoc($result3)){
												echo "<td>".$row3["name"]."</td>";
												$query4="SELECT * FROM ".$table_prefix."lens_type WHERE lens_type_id=".$row3["lens_type"].";";
												$result4=mysqli_query($connection,$query4);
												if(mysqli_num_rows($result4)>0){
													while($row4=mysqli_fetch_assoc($result4)){
														echo "<td>".$row4["lens_name"]."</td>";
													}
												}
											}		
									}
									echo "<td>".$row["shutter_speed"]."</td><td>".$row["iso"]."</td><td>-</td>";
								}
									echo "<td>".$row["latitude"]."</td><td>".$row["longitude"]."</td>";
									echo "<td>".$row["date"]."</td>";
									echo "<td><input type='checkbox' id='postid' name='postid[]' value=".$row["postid"]."></td>";
									echo "</tr>";
								}
							}
						}
					}
					#closing the connection 
					mysqli_close($connection);	
					?>
			</table>
	</div>
	</article>
</body>
</html>
