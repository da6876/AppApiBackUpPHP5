<?php

/* 


$servername = "www.71bazaar.com:3306";
$username = "user_tolet_service";
$password = "tolet@service4321#%";
$dbname = "bazercom_tolet_service";  */


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "soc_tolet_ervice";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn) {
	//die("Connection failed: " . $conn->connect_error);
}else{
	//echo "Connected successfully";
}
?>