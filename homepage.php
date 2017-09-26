<!DOCTYPE html>
<!--
Home page
Description: This is the home page for Rastershare WCMS.
Author: Kshithij Iyer
Date: 18/7/2017
Email: ahole@disroot.org
-->
<html>
<head>
	<title>RasterShare Homepage</title>
	<link rel="stylesheet" type="text/css" href="./resources/css/homepage.css">
</head>
<body bgcolor="#BFBFBF">
 	<a name="top"></a>
 	<?php
		include_once("./resources/inc/header.inc.php");
 	?>
 	<br><br>
	<div class="block1">
	<article>
		<header>
			<div class="title">What is RasterShare?</div>
		</header>
		<p class="text">
			RasterShare is a <strong>W</strong>eb <strong>C</strong>ontent <strong>M</strong>anagment <strong>S</strong>ystem i.e a WCMS to host websites for photographers.<br>
			It helps in photographers to display their photographs in an attractive manner. 
		</p>
			<div class="buttonloc"><button class="button" onclick="location.href='signup.php'">Get Started</button></div>
	</article>
	<br><br>
	<article>
	<div class="block2">
		<div class="gallery">
   			<img src="./resources/images/topten.jpg">
		</div>
		<?php 
		#fetch and display top ten images
		for($counter=1;$counter<11;$counter++){
			echo "<div class='gallery'>";
				echo "<img src='./resources/images/".$counter.".jpg'>";
			echo "</div>";
		}
		?>
		<a href="#top">
		<div class="gallery">
    		<img src="./resources/images/back.jpg">
		</div>
		</a>
	</div>
	</div>
	</article>
	<?php
		include_once("./resources/inc/footer.inc.php");
 	?>
</body>
</html>
