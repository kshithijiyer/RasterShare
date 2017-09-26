<!--
Lens type retrive
Description: Php script to retrive types of lens from lens_type table.
Author:Kshithij Iyer
Date: 23/8/2017
Email: ahole@disroot.org
-->
<?php
	include_once("db_connection.php");
	#connection creation
	$connection=mysqli_connect($host,$username,$password,$db_name);
	$query="SELECT * FROM ".$table_prefix."lens_type;";
	$result=mysqli_query($connection,$query);
	#creating a drop down list
	while($row=mysqli_fetch_assoc($result)){
		echo "<option value=".$row["lens_type_id"].">".$row["lens_name"]."</option>";
	}
	#connection closed
	mysqli_close($connection);
?>
