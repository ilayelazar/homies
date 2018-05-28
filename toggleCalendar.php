<?php
session_start();
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
	
	$q = "update family SET isCalPublic = 1 WHERE familyid = (select familyid from users where username ='".$_SESSION['user']."')  ";

$conn->query($q); 
?>