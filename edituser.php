<?php
	$username = $_POST['username'];
	$user = $_POST['user'];
	$newPermission = $_POST['newPermission'];
	$newPoints = $_POST['score'];
	$addOrRemove= $_POST['addOrRemove'];
	
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


		//------ifelse-----//
	if($addOrRemove=='1'){
	$addUser = "UPDATE users
	SET familyid=(select distinct familyid from (select * from users) as newUsers where newUsers.username='" .$_POST['user']. "')
	WHERE users.username='" .$_POST['username']. "' ";
	
				
	$deleteFromWaiting="DELETE from GroupWaitlist where username='" .$_POST['username']. "' ";
	
	$conn->query($addUser);
	$conn->query($deleteFromWaiting);
	 	

	}
	
	else if($addOrRemove=='0'){
			
		$deleteFromWaiting="DELETE from GroupWaitlist where username='" .$_POST['username']. "' ";
		$conn->query($deleteFromWaiting); 
	}
	else if($addOrRemove=='2')
	{
		$deleteFromGroup="UPDATE users
		SET familyid='0'
		WHERE users.username='" .$_POST['username']. "' ";
	
		$conn->query($deleteFromGroup); 
	}
	
?>