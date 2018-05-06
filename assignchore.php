<?php
	$cid = $_POST['cid'];
	$user = $_POST['user'];
	$doneOrBacktoqueue= $_POST['doneOrBacktoqueue'];
	
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

if($doneOrBacktoqueue=='1'){	
	
	$q = "UPDATE chores
	SET is_available='0', c_username ='". $user ."'
	WHERE choreid='" .$_POST['cid']. "' ";


}

else
{
	$q = "UPDATE chores
	SET is_available='1', c_username ='NOBODY'
	WHERE choreid='" .$_POST['cid']. "' ";
	
}

$conn->query($q); 
?>