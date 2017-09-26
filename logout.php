<!--
Logout script
Description: A script to destory the Session.
Author: Kshithij Iyer
Date: 29/8/2017
Email: ahole@disroot.org
-->
<?php
	#destory session
	session_destroy();
	$_SESSION["uid"]=000;
	unset($_SESSION["uid"]);
	$_SESSION = array();
	#divert
	header("Location: homepage.php");
?>
