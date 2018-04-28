<?php
	$cid = $_POST['cid'];
	$user = $_POST['user'];
	$q = "UPDATE chores
	SET is_available='0', c_username ='". $user ."'
	WHERE choreid='" .$_POST['cid']. "' ";
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


$conn->query($q); 
?>