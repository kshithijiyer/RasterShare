<!--
Top 10 update script
Description: Php script to update top ten images.
Author:Kshithij Iyer
Date: 10/9/2017
Email: ahole@disroot.org
-->
<?php
	#copying top ten from images to resources/images
	for($counter=0;$counter<sizeof($_POST["filename"]);$counter++){
		$image_name=$counter+1;
		copy(getcwd()."/images/".$_POST["filename"][$counter],getcwd()."/resources/images/".$image_name.".jpg");
		if($image_name>10){
			break;
		}
		#divert code
		header("Location: adminaccount.php");
?>
