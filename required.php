<?php
session_start();
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
else{
  echo "<script>console.log('DB Connection succeded');</script>";
}

/* ------------------------------------------------*/
if(isset($_SESSION['user'])){
	$q_fid= "SELECT familyid as fid FROM users WHERE username='".$_SESSION['user']."'";
    $res = $conn->query($q_fid);
    $row = $res->fetch_assoc();
    $_SESSION['fid'] = $row["fid"];
	    if($_SESSION['fid'] == 0){
	    $url = 'creategroup.php';
		echo "<script>console.log('redirected to creategroup.php because fid not exist');</script>";
		}
		else{
			$url = 'calendar.php';
	    echo "<script>console.log('redirected to homepage.php because fid exists');</script>";
		}
}
else{
	header("Location: index.php");
}
$url;
if(!isset($_SESSION['fid'])){
		$url = 'creategroup.php';
		echo "<script>console.log('redirected to creategroup.php because fid not exist');</script>";
	}




header('Location: '. $url);
?>