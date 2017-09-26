<!--
Index file
Description: This is the index file for the main project.
Author:Kshithij Iyer
Date: 10/9/2017
Email: ahole@disroot.org
-->
<?php
	$uid=$_REQUEST["id"];
	if(is_numeric($uid)==1){
		#Redirecting to the blog page. 
		header("Location: ./themes/?id=".$uid);
	}
	else{
		#Redirecting to the Home page. 
		header("Location: homepage.php");
	}
?>
