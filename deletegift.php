<?php
	$pid = $_POST['pid'];

	
      //--------dblogin---------


$servername = "zebra.mtacloud.co.il";
$username = "ilayel";
$password = "homies123";
$dbname = "ilayel_homies";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 		
	
	$q = "delete from presents WHERE presentid='" .$_POST['pid']. "' ";



$conn->query($q); 
?>