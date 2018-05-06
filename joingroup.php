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
    else{
      echo "<script>console.log('DB Connection succeded');</script>";
    }

    $familyid = $_POST['familyid'];

    $q_join_family = "INSERT INTO GroupWaitlist (familyid, username) VALUES(".$familyid." , '".$_SESSION['user']."' ) ";
    $conn->query($q_join_family);

?>