<?php
	global $conn;
	$servername = "localhost";
	$username = "global89_globel";
	$password = "admin_golax";
	$dbname = "global89_sindo"; 
	 
	$conn = mysqli_connect($servername,$username,$password,$dbname);
	if (!$conn){ die("Connection failed : ".mysqli_connect_error()); }
?>