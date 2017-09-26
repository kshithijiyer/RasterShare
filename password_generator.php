<!--
Password generator script
Description:This is the password generator script of RasterShare.
Author:Kshithij Iyer
Date: 15/8/2017
Email: ahole@disroot.org
Note: This should only be executed once. 
-->
<?php 
	#array of characters
	$letter_array=array(
	array(2,3,4,5,6,7,8,9,"@","#","%","$","&","*","<",">",2,3,4,5,6,7,8,9,"!","?"),
	array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"),
	array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"));
	#random password generation
	$default_password=$letter_array[rand(1,2)][rand(0,25)].$letter_array[rand(0,2)][rand(0,25)].$letter_array[rand(0,2)][rand(0,25)].$letter_array[rand(0,2)][rand(0,25)];
	$default_password=$default_password.$letter_array[rand(1,2)][rand(0,25)].$letter_array[rand(0,2)][rand(0,25)].$letter_array[rand(0,2)][rand(0,25)].$letter_array[rand(0,2)][rand(0,25)];
?>
