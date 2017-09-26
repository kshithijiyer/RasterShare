<!--
Main page of theme.
Description: This is the main page of the default theme.
Author: Kshithij Iyer
Date: 25/9/2017
Email: ahole@disroot.org
-->
<?php
	#including all the needed anchors and config files
	include_once("../../db_connection.php");
	include_once("../../anchor_image.php");
	include_once("../../anchor_usermeta.php");
	include_once("../../anchor_postdata.php");
	#ccalling all the needed functino
	get_usermeta($_REQUEST["id"]);
	get_image($_REQUEST["postid"]);
	get_postdata($_REQUEST["postid"]);	
?>
<html>
	<head>
		<title>
				<? echo $display_name; ?>
		</title>
		<style>	
		body{
			overflow: hidden;
		}
		.gallery {
			display: inline-flex;
			width: 50%;
			height: 100%;
			float: left;
		}
		.gallery img {
				width: 100%;
				height: auto;
		}
		body, html {
			height: 100%;
			margin: 0;
		}
		.txt {
			display: inline-flex;
			width: 50%;
			height: 100%;
			float: right;
			font-size: 90px;
		}
		</style>
	</head>
	<body bgcolor="#C1C1C1">
		<article>
			<div class="gallery">
				<? echo "<img src=\"../../images/".$image."\">";?>
			</div>
			<div class="txt">
				<table align="center">
				 <tr>
					<td>Caption:</td>
					<td><? echo $caption;?></td>
				 </tr>
				 <tr>
					<td>Hashtags:</td>
					<td><? echo $hashtags;?></td>
				 </tr>
				  <tr>
					<td>Device:</td>
					<td><? echo $device;?></td>
				 </tr>
				 <tr>
					<td>Lens:</td>
					<td><? echo $lens;?></td>
				 </tr>
				 <tr>
					<td>Lens type:</td>
					<td><? echo $lens_type;?></td>
				 </tr> 
				 <tr>
					<td>Shutter Speed:</td>
					<td><? echo $shutter_speed;?></td>
				 </tr> 
				 <tr>
					<td>ISO:</td>
					<td><? echo $iso;?></td>
				 </tr>
				 <tr>
					<td>App:</td>
					<td><? echo $app;?></td>
				 </tr>
				 <tr>
					<td>latitude:</td>
					<td><? echo $latitude;?></td>
				 </tr> 
				 <tr>
					<td>longitude:</td>
					<td><? echo $longitude;?></td>
				 </tr> 
				 <tr>
					<td>Date:</td>
					<td><? echo $date;?></td>
				 </tr>  
				</table>
			</div>
		</article>
	</body>
</html>
