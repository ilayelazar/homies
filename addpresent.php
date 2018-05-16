   <?php
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
    
 
   if(isset($_POST["presentName"])){
    //add present vars
    $presentName=$_POST["presentName"];
    $presentDescription=$_POST["presentDescription"];
    $presentPrice="null";//$_POST["presentPrice"];
  $presentLink=$_POST["presentLink"];
    $requested_by=$_SESSION['user'];          
    $pStatus= "0";
	$presentType=$_POST["ptype"];
    
    $max_query = "SELECT COALESCE(max(`presentid`) ,0) as max FROM `presents`";
    $result = $conn->query($max_query);
    $row = $result->fetch_assoc();
    $pid = $row["max"];
    $pid = $pid + 1;
    
    //add present query
    $addPresent="INSERT INTO presents (presentid,p_name,p_description,p_username,p_score,p_link ,p_status,type)
    VALUES ('".$pid."','".$presentName."','".$presentDescription."','".$requested_by."','".$presentPrice."','".$presentLink."','".$pStatus."','".$presentType."');";//what we got from the user
    
    $conn->query($addPresent);//operates the chore query 

    $result = $conn->query($addPresent);
    }

   ?>