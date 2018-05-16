<?php
	ob_start();
  session_start();
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


      $max_family = "SELECT COALESCE(max(familyid) ,0) as max FROM family";
                $res = $conn->query($max_family);
                $row = $res->fetch_assoc();
                $f_id = $row["max"];
                $f_id = $f_id + 1;

      $q_newFamily= "INSERT INTO family(familyid, name) VALUES( ".$f_id." , '".$_POST['groupname']."')";
      $conn->query($q_newFamily);


      $q_assignToFamily = "UPDATE users SET familyid = ". $f_id." WHERE username='".$_SESSION['user']."'";
      $conn->query($q_assignToFamily);
header("Location: homepage.php");
ob_end_flush();
?>
