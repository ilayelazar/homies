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


$calendarid= $_POST['calendarid'];
$name = $_POST['name'];


$max_query = "SELECT COALESCE(max(`familyid`) ,0) as max FROM `family`";
   	$result = $conn->query($max_query);
   	$row = $result->fetch_assoc();
   	$familyid = $row["max"];
   	$familyid = $familyid + 1;

$q_insert = "INSERT INTO family (familyid, name, calendarid) VALUES ($familyid, '".$name."', '".$calendarid."')";

$conn->query($q_insert);
$q_updateFamilyID = "update users SET familyid = $familyid WHERE username = '".$_SESSION['user']."'";
$conn->query($q_updateFamilyID);

echo "Assigned family $familyid, $calendarid";



?>