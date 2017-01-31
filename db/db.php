<?php
	include('../config/config.php');
	$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DATABASE);
	if(!$connection){
		die("connection fail");
	}
	
	if (!$connection->set_charset("utf8")) {
		 printf("Error loading character set utf8: %s\n",$connection->error);
	} 
?>