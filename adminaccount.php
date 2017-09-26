<!DOCTYPE html>
<!--
Admin Account page
Description: This is the admin account page for Rastershare WCMS.
Author: Kshithij Iyer
Date: 23/8/2017
Email: ahole@disroot.org
-->
<?php
	session_start();
	if(!is_numeric($_SESSION["uid"])){
		header("Location: login.php");
	}
	else if($_SESSION["user_group"]==99){
		header("Location: account.php");
	}
?>
<html>
<head>
	<title>RasterShare</title>
	<link rel="stylesheet" type="text/css" href="./resources/css/adminaccount.css">
	<script type="text/javascript" src="./resources/lib/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript">
		window.history.forward();
		$(document).ready(function(){
			$.post("get_lens_type.php",{},function(result){
				$("#lens_type").html(result);
			});
			//code for nav bar
			$("#view").click(function(){
				$("#view-div").show();
				$("#manage-div").hide();
				$("#reset-div").hide();
				$("#tables-div").hide();
				$("#status-div").hide();
				$("#topten-div").hide();
			});
			$("#manage").click(function(){
				$("#view-div").hide();
				$("#manage-div").show();
				$("#reset-div").hide();
				$("#tables-div").hide();
				$("#status-div").hide();
				$("#topten-div").hide();
			});
			$("#reset").click(function(){
				$("#view-div").hide();
				$("#manage-div").hide();
				$("#reset-div").show();
				$("#tables-div").hide();
				$("#status-div").hide();
				$("#topten-div").hide();
			});
			$("#tables").click(function(){
				$("#view-div").hide();
				$("#manage-div").hide();
				$("#reset-div").hide();
				$("#tables-div").show();
				$("#status-div").hide();
				$("#topten-div").hide();
			});
			$("#status").click(function(){
				$("#view-div").hide();
				$("#manage-div").hide();
				$("#reset-div").hide();
				$("#tables-div").hide();
				$("#status-div").show();
				$("#topten-div").hide();
			});
			$("#topten").click(function(){
				$("#view-div").hide();
				$("#manage-div").hide();
				$("#reset-div").hide();
				$("#tables-div").hide();
				$("#status-div").hide();
				$("#topten-div").show();
			});
			//code to call other php files
			$("#create").click(function(){
				var user_name=$("#username").val();
				var role=$("#role").val();
				$.post("new_user_created.php",{ username:user_name,role:role },function(result){
					$("#create_output").html(result);
				});
			});
			$("#remove").click(function(){
				var user_name=$("#usernamer").val();
				$.post("remove_user.php",{ username:user_name},function(result){
					$("#remove_output").html(result);
				});
			});
			$("#add_dev").click(function(){
				var device_name=$("#device_name").val();
				var type=$("#type").val();
				$.post("add_device.php",{ device_name:device_name, type:type },function(result){
					$("#add_dev_output").html(result);
				});
			});
			$("#add_lens").click(function(){
				var lens_name=$("#lens_name").val();
				var lens_type=$("#lens_type").val();
				$.post("add_lens.php",{ name:lens_name, type:lens_type },function(result){
					$("#add_lens_output").html(result);
				});
			});
			$("#add_app").click(function(){
				var app_name=$("#app_name").val();
				$.post("add_app.php",{ app_name:app_name},function(result){
					$("#add_app_output").html(result);
				});
			});
			$("#reset_password").click(function(){
				var current_password=$("#current_password").val();
				var new_password=$("#new_password").val();
				$.post("reset_password.php",{ current_password:current_password,new_password:new_password },function(result){
					$("#reset_password_output").html(result);
				});
			});			
		});
	</script>
</head>
<body bgcolor="#BFBFBF">
	<header>
		<nav>
			<ul class="ul-horizontal">
				<li class="li-horizontal"><img src="./resources/images/logo.png" class="logo"></li>
				<li class="li-horizontal"><div class="logout"><form method="post" action="logout.php"><button class="button" type="submit">Logout</button></form></div></li>
			</ul>
		</nav>
	</header>
	<ul class="ul-vertical">
  		<li class="li-vertical"><a id="view">View Users</a></li>
  		<li class="li-vertical"><a id="manage">Manage Users/Admins</a></li>
  		<li class="li-vertical"><a id="status">Status of tables</a></li>
  		<li class="li-vertical"><a id="tables">Add Applications/devices/lens</a></li>
  		<li class="li-vertical"><a id="reset">Reset Admin password</a></li>
  		<li class="li-vertical"><a id="topten">Select Top 10 images</a></li>	
	</ul>
	<article>
		<div style="margin-left:25%;padding:1px 16px; height:630px; display: none; overflow-y: scroll;" id="topten-div">
			<form action="topten_update.php" method="post">
			<button type="submit" id="topten_update" name="topten_update" class="button">Update</button>
			<table>
				<tr bgcolor="#E8E8E8"><td>Image</td><td></td></tr>
				<?php
					include_once("db_connection.php");
					#connectivity object
					$connection=mysqli_connect($host,$username,$password,$db_name);	
					#select query
					$query="SELECT * FROM ".$table_prefix."post;";
					$result=mysqli_query($connection,$query);
					if(mysqli_num_rows($result)>0){
						while($row=mysqli_fetch_assoc($result)){	
							echo "<tr align='center' bgcolor='#CCCCCC'><td><img src='./images/".$row["file_name"]."' style='width:300px;height:300px;'></td>";
							echo "<td><input type='checkbox' id='filename' name='filename[]' value=".$row["file_name"]."></td>";
							echo "</tr>";
						}
					}
					#closing connection
					mysqli_close($connection);	
					?>
			</table>
			</form>
		</div>
		<div style="margin-left:25%;padding:1px 16px;height:1000px; display: none; overflow-y: scroll;" id="view-div">
			<form action="delete_users.php" method="post">
			<table>
				<tr bgcolor="#E8E8E8"><td>UID</td><td>Email</td><td>Password Hash</td><td>User group</td><td></td></tr>	
			<?php
				include_once("db_connection.php");
				#connectivity object
				$connection=mysqli_connect($host,$username,$password,$db_name);	
				#select query
				$query="SELECT * FROM ".$table_prefix."user ;";
				$result=mysqli_query($connection,$query);
				if(mysqli_num_rows($result)>0){
					while($row=mysqli_fetch_assoc($result)){
						echo "<tr align='center' bgcolor='#CCCCCC'><td>".$row["uid"]."</td><td>".$row["email"]."</td><td>".$row["password"]."</td><td>".$row["user_group"]."</td>";
						echo "<td><input type='checkbox' name='uid[]' value=".$row["uid"]."></td>";
						echo "</tr>";
					}
				}	
				#closing the query 
				mysqli_close($connection);
			?>
			</table>
			<button type="submit" id="operation_view" name="operation_view" class="button">Delete</button>
			</form>
		</div>
		<div style="margin-left:25%;padding:1px 16px;height:1000px; display: none;" id="reset-div">
			<h1>You are currently logged in as <?php echo $_SESSION["username"];?></h1>
			<h1>Change password:</h1>
			<input type="password" placeholder="Current Password" id="current_password" name="current_password" class="textbox" />
			<input type="password" placeholder="New Password" id="new_password" name="new_password" class="textbox" />
			<button type="submit" id="reset_password" name="reset_password" class="button">Reset</button>
			<div id="reset_password_output"></div>
		</div>
		<div style="margin-left:25%;padding:1px 16px;height:1000px; display: none;" id="tables-div">
			<h1>Add devices:</h1>
			<input type="text" class="textbox" placeholder="Device Name" id="device_name" name="device_name">
			<select id="type" name="type" class="button"> 
				<option value="1">camera</option>
				<option value="0">Phone</option>
			</select>
			<button type="submit" id="add_dev" name="add_dev" class="button">Add</button>
			<div id="add_dev_output"></div>
			<h1>Add Applications:</h1>
			<input type="text" class="textbox" placeholder="App Name" id="app_name" name="app_name">
			<button type="submit" id="add_app" name="add_app" class="button">Add</button>
			<div id="add_app_output"></div>
			<h1>Add Lens:</h1>
			<input type="text" class="textbox" placeholder="Lens Name" id="lens_name" name="lens_name">
			<select id="lens_type" name="lens_type" class="button">
				<option></option>
			</select> 
			<button type="submit" id="add_lens" name="add_lens" class="button">Add</button>
			<div id="add_lens_output"></div>
		</div>
		<div style="margin-left:25%;padding:1px 16px;height:1000px; display: none;" id="manage-div">
			<h1>Add users/admins:</h1>
			<input type="text" class="textbox" placeholder="Username" id="username" name="username">
			<select id="role" name="role" class="button"> 
				<option value="99">User</option>
				<option value="90">Admin</option>
			</select>
			<button type="submit" id="create" name="create" class="button">Create</button>
			<div id="create_output"></div>
			<h1>Remove users/admins:</h1>
			<input type="text" class="textbox" placeholder="Username" id="usernamer" name="usernamer">
			<button type="submit" id="remove" name="remove" class="button">Remove</button>
			<div id="remove_output"></div>
		</div>
		<div style="margin-left:25%;padding:1px 16px;height:1000px; display: none; overflow-y: scroll; overflow-x: scroll" id="status-div">
			<table>
				<tr>
					<td>
						<h1>Application table:</h1>
						<table>
							<tr bgcolor="#E8E8E8"><td>APPID</td><td>Name</td></tr>	
							<?php
								include_once("db_connection.php");
								#connectivity object
								$connection=mysqli_connect($host,$username,$password,$db_name);	
								#select query
								$query="SELECT * FROM ".$table_prefix."app ;";
								$result=mysqli_query($connection,$query);
								if(mysqli_num_rows($result)>0){
									while($row=mysqli_fetch_assoc($result)){
										echo "<tr align='center' bgcolor='#CCCCCC'><td>".$row["appid"]."</td><td>".$row["name"]."</td></tr>";
									}
								}	
								#closing the query 
								mysqli_close($connection);
							?>
						</table>
						<h1>Lens type table</h1>
						<table>
							<tr bgcolor="#E8E8E8"><td>ID</td><td>Type</td></tr>	
							<?php
								include_once("db_connection.php");
								#connectivity object
								$connection=mysqli_connect($host,$username,$password,$db_name);	
								#select query
								$query="SELECT * FROM ".$table_prefix."lens_type ;";
								$result=mysqli_query($connection,$query);
								if(mysqli_num_rows($result)>0){
									while($row=mysqli_fetch_assoc($result)){
										echo "<tr align='center' bgcolor='#CCCCCC'><td>".$row["lens_type_id"]."</td><td>".$row["lens_name"]."</td></tr>";
									}
								}	
								#closing the query 
								mysqli_close($connection);
							?>
						</table>
						<h1>Lens table</h1>
						<table>
							<tr bgcolor="#E8E8E8"><td>ID</td><td>Name</td><td>Type</td></tr>	
							<?php
								include_once("db_connection.php");
								#connectivity object
								$connection=mysqli_connect($host,$username,$password,$db_name);	
								#select query
								$query="SELECT * FROM ".$table_prefix."lens;";
								$result=mysqli_query($connection,$query);
								if(mysqli_num_rows($result)>0){
									while($row=mysqli_fetch_assoc($result)){
										echo "<tr align='center' bgcolor='#CCCCCC'><td>".$row["lensid"]."</td><td>".$row["name"]."</td><td>".$row["lens_type"]."</td></tr>";
									}
								}	
								#closing the query 
								mysqli_close($connection);
							?>
						</table>
					</td>
					<td>
						<h1>Device table:</h1>
						<table>
							<tr bgcolor="#E8E8E8"><td>ID</td><td>Name</td><td>Type</td></tr>	
							<?php
								include_once("db_connection.php");
								#connectivity object
								$connection=mysqli_connect($host,$username,$password,$db_name);	
								#select query
								$query="SELECT * FROM ".$table_prefix."device ;";
								$result=mysqli_query($connection,$query);
								if(mysqli_num_rows($result)>0){
									while($row=mysqli_fetch_assoc($result)){
										echo "<tr align='center' bgcolor='#CCCCCC'><td>".$row["deviceid"]."</td><td>".$row["dev_name"]."</td><td>".$row["dev_type"]."</td></tr>";
									}
								}	
								#closing the query 
								mysqli_close($connection);
							?>
						</table>
					</td>
				</tr>
			</table>
		</div>
	</article>
</body>
</html>
