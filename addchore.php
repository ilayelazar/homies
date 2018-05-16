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
    
   if(isset($_POST["choreName"])){
      //add chore vars  
    $chore_name=$_POST["choreName"];
    $chore_description=$_POST["choreDescription"];
    $chore_score=$_POST["choreScore"];
    $ctype = $_POST['chore_type'];
    //$user_name=null;
    
    $max_query = "SELECT COALESCE(max(`choreid`) ,0) as max FROM `chores`";
    $result = $conn->query($max_query);
    $row = $result->fetch_assoc();
    $cid = $row["max"];
    $cid = $cid + 1;
    //we want to show it also after the insert of the form! - same as above
    //add chore query 
    $addChore="INSERT INTO chores (choreid,familyid,c_title,c_description,c_score,is_available, c_status,c_username, type) 
    VALUES ('".$cid."', (select familyid from users where username= '". $_SESSION['user'] ."') ,'".$chore_name."','".$chore_description."','".$chore_score."',1,0,'NOBODY', '".$ctype."');";//what we got from the user
    
    $conn->query($addChore);//operates the chore query 
    $result = $conn->query($addChore);
   }
   echo $cid;
   ?>