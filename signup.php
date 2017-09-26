<!DOCTYPE html>
<!--
Signup page
Description: This is the signup page for Rastershare WCMS.
Author: Kshithij Iyer
Date: 18/7/2017
Email: ahole@disroot.org
-->
<html>
<head>
	<title>RasterShare Signup</title>
	<link rel="stylesheet" type="text/css" href="./resources/css/signup.css">
</head>
<body bgcolor="#BFBFBF">
	<?php
		include_once("./resources/inc/header.inc.php");
 	?>
	<br><br>
	<div class="login-page">
  		<div class="form">
    		<form method="post" action="new_signup.php">
    			<img src="./resources/images/logo.png" class="login-logo">
      			<input type="text" placeholder="Email" id="email" name="email" required/>
      			<input type="password" placeholder="password" id="password1" name="password1" pattern=".{8,}" title="password should be atleat 8 characters" required/>
      			<input type="password" placeholder="Re-password" id="password2" name="password2" pattern=".{8,}" title="password should be atleat 8 characters" required/>
      			<button type="submit">Signup</button>
    		</form>
 		</div>
	</div>
</body>
</html>
