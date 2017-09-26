<!--
Main page of theme.
Description: This is the main page of the default theme.
Author: Kshithij Iyer
Date: 25/9/2017
Email: ahole@disroot.org
-->
<?php
	#including all the needed anchor and config files 
	include_once("../../db_connection.php");
	include_once("../../anchor_images_all.php");
	include_once("../../anchor_usermeta.php");
	#calling anchor functions
	get_usermeta($_REQUEST["id"]);
	get_images_all($_REQUEST["id"]);
?>
<html>
	<head>
		<title>
				<? echo $display_name; ?>
		</title>
		<link rel="stylesheet" type="text/css" href="mytheme.css">
	</head>
	<body bgcolor="#C1C1C1">
		<article>
		<header>
		<table align="center">
			<tr align="center">
				<td>
					<img src="<? echo "../../userdp/".$display_pic ?>" style="width:200px;height:200px;">
				</td>
			</tr>
			<tr align="center">
				<td>
					<div class="title">
						<? echo $display_name; ?>
					</div>
				</td>
				
			</tr>
			<tr align="center">
				<td>
					<div class="bio">
					<? echo $bio; ?>
					</div>
				</td>
			</tr>
		</table>
		</header>
		<?php
			for($counter=0;$counter<sizeof($images);$counter++){
			echo "<a href='display.php?postid=".$postids[$counter]."&id=".$_REQUEST["id"]."'>";
			echo "<div class='gallery'>";
				echo "<img src='../../images/".$images[$counter]."'>";
			echo "</div>";
			echo "</a>";
			}
		?>
		</article>
	</body>
</html>
