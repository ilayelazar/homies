<?php

	$calid = "SELECT calendarid from family where familyid = (SELECT familyid from users where username = '".$_POST['user']."')";
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
	
	$res = $conn->query($calid);
	$row = $res->fetch_assoc();
	$calendarid = $row['calendarid'];
	
	echo $calendarid;
?>