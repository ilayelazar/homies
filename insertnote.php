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
       //Generate note id by current max (id+1)
        $max_noteid = "SELECT COALESCE(max(noteid) ,0) as max FROM notes";
        $res = $conn->query($max_noteid);
        $row = $res->fetch_assoc();
        $n_id = $row["max"];
        $n_id = $n_id + 1;
 //insert query
   $q_insertNote = "INSERT INTO notes (`noteid`, `n_creator`, `text`, `familyid`, `note_title`, `note_date`) VALUES (".$n_id.",'".$_SESSION['user']."','".$_POST['note']."',(SELECT familyid FROM users WHERE username='".$_SESSION['user']."'),'".$_POST['title']."',now())";;
  $conn->query($q_insertNote);
echo "$n_id";
?>