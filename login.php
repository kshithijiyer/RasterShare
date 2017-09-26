<!DOCTYPE html>
<!--
Login page
Description: This is the Login page for Rastershare WCMS.
Author: Kshithij Iyer
Date: 18/7/2017
Email: ahole@disroot.org
-->
<html>
<head>
	<title>RasterShare Login</title>
	<link rel="stylesheet" type="text/css" href="./resources/css/login.css">
</head>
<body bgcolor="#BFBFBF">
	<?php
	include_once("./resources/inc/header.inc.php");
 	?>
	<br><br>
	<div class="login-page">
  		<div class="form">
    		<form action="login_user.php" method="post">
    			<img src="./resources/images/logo.png" class="login-logo">
      			<input type="text" placeholder="Email" id="email" name="email" required/>
      			<input type="password" placeholder="password" id="password" name="password"required/>
      			<button type="submit">login</button>
    		</form>
 		</div>
	</div>
</body>
</html>
