<?php
	$servername="localhost";
	$usr="hkuo2";
	$ps="hkuo2";
	$db="hkuo2";
	
	$conn=new mysqli($servername, $usr, $ps, $db);
	if($conn->connect_error){
		die("Connection failed.". $conn->connect_error);
	}
?>
