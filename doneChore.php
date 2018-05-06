<?php


	  
	$cid = $_POST['cid'];
	$user = $_POST['user'];
	$score= $_POST['score']; 

	
	$q = "UPDATE chores
	SET c_status='1'
	WHERE choreid='" . $_POST['cid']. "'";
	
	$currpoints = "SELECT score from users where username = '" .$user ."'";
	
//  dblogin 
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
	
	
	$score_points = $conn->query($currpoints);
	$row = $score_points->fetch_assoc();
	$u_score = $row['score'];
	
	$q2= "UPDATE users SET score = ".$u_score."+ ".$score." WHERE username ='". $user ."'";


$conn->query($q); 

$conn->query($q2); 



?>