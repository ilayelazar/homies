<?php
	$cid = $_POST['pid'];
	$user = $_POST['user'];
	$score= $_POST['p_score'];
	$date=$_POST['date'];
	
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


	
	$q = "UPDATE presents
	SET p_status='1', buy_p_username = '" .$_POST['user']. "', dop='".$_POST['date']."'
	WHERE presentid='" .$_POST['pid']. "' ";
	
	$currpoints = "SELECT score from users where username = '" .$user ."'";
	$score_points = $conn->query($currpoints);
	$row = $score_points->fetch_assoc();
	$u_score = $row['score'];
	
	$q2= "UPDATE users SET score = ".$u_score." - ".$score." WHERE username ='". $user ."'";

	

$conn->query($q);
$conn->query($q2); 

?>