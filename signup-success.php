<html>
  <body>
    
<?php
ob_start();
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
else{
  echo "<script>console.log('DB Connection succeded');</script>";
}


$username = $_POST["username"];
$password = $_POST["password"];
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$permission = $_POST["permission"];
$groupid = null;
$dob = $_POST["birth-year"] . "-" .
       $_POST["DOBMonth"] . "-" .
       $_POST["DOBDay"];



  	$sql_u = "SELECT * FROM users WHERE username='$username'";
  	
  	
		$result = $conn->query($sql_u);

		if ($result->num_rows > 0) {
  	  echo "<script> alert('Sorry... Username  - ".$username." - already taken');window.location = 'signup.php'; 
	  </script>"; 

	  
  	}
	else{
      $sql = "INSERT INTO `users`(`username`, `password`, `fname`, `lname`, `email`, `permission`, `familyid`, `dob` , `gender`) VALUES (
                  '" . $username . "',
                  '" . $password . "',
                  '" . $fname . "',
                  '" . $lname . "',
                  '" . $email . "',
                  '" . $permission . "',
                  '" . $groupid . "',
                  '" . $dob . "',
                  '" . $_POST['gender'] . "'        
                  )";

      $conn->query($sql);  
      echo "<script>console.log('registered successfuly')</script>";  
      $conn->close();
         header("Location: creategroup.php");

          $_SESSION["permission"] = $permission;
          $_SESSION["user"] = $username;
    ob_end_flush();
	
	}

?>
  </body>
</html>




