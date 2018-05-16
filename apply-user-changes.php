<?php
	$usertoChange = $_POST['userToChange'];
	$newPermission = $_POST['permission'];
	$newPoints = $_POST['score'];
	
	
	$q_updateUser = "UPDATE users SET permission = $newPermission , score = '".$newPoints."' WHERE username='".$usertoChange."'";
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

$conn->query($q_updateUser);
//echo json_encode("{'user':'". $usertoChange ."','permission':'$newPermission','score','$newPoints'}");
echo $newPermission;
	
?>