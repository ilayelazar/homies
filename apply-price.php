<?php
	$presentid = $_POST['presentid'];
	$score = $_POST['score'];
	
	
	$q_updatePresent = "UPDATE presents SET p_score = '".$score."' WHERE presentid='".$presentid."'";
	
	      //--------dblogin---------//
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

$conn->query($q_updatePresent);
echo json_encode("{'user':'". $usertoChange ."','permission':'$newPermission','score','$newPoints'}");

	
?>