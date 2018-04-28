	

						   <?php //variables
					
					//add chore	vars	
							$chore_name=$_POST["choreName"];
							$chore_description=$_POST["choreDescription"];
							$chore_score=$_POST["choreScore"];
							$user_name=$_POST["choreName"];
							$cid= "1";
							
										
					//add present vars
							$presentName=$_POST["presentName"];
							$presentDescription=$_POST["presentDescription"];
							$presentPrice=null;//$_POST["presentPrice"];
							$requested_by=$_POST["presentName"];					
							$pStatus= "0";
							$pid= "9";
							
							
				
					
					

							 ?>
									


<?php
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
?>
									
								<?php
								
								echo "jhgdjhsdghhs";
								?>	

								
							<?php
							
							
							//we want to show it also after the insert of the form! - same as above
							//add chore query 
							$addChore="INSERT INTO chores (choreid,c_username,c_title,c_description,c_score) 
							VALUES ('".$cid."','".$user_name."','".$chore_name."','".$chore_description."','".$chore_score."');";//what we got from the user
							
							$conn->query($addChore);//operates the chore query 

							$result = $conn->query($addChore);
							?> 
							
							
							<?php
							
							
							//add present query
							$addPresent="INSERT INTO presents (presentid,p_name,p_description,p_username,p_score,p_status)
							VALUES ('".$pid."','".$presentName."','".$presentDescription."','".$requested_by."','".$presentPrice."','".$pStatus."');";//what we got from the user
							
							$conn->query($addPresent);//operates the chore query 

							$result = $conn->query($addPresent);
							
							
							
							
							

							$conn->close();
							
							?> 