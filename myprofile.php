<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" href="img/family-logo.png">
      <title>Homies - Homepage</title>

          <!-- FONTS -->
      <link href="https://fonts.googleapis.com/css?family=Heebo" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <!-- Latest compiled JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="script/script.js"></script>
      <script src="script/group.js"></script>
      <script src="script/newcalendar.js"></script>
      <link href="https://fonts.googleapis.com/css?family=Mina:700" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
      <link rel="stylesheet" type="text/css" href="css/myprofile.css">

 <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">	  
  </head>


<?php 
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
          $q_userpass = "SELECT * FROM users WHERE username = '".$_SESSION['user']."'";
          $res = $conn->query($q_userpass);
          $row = $res->fetch_assoc();
          $userpass = $row['password'];
          
          $familyid = $row['familyid'];
          if($familyid == '0'){
            echo "
            <script>
                $(document).ready(function(){
                              document.getElementById('account-status').innerHTML = 'Waiting for approval';
                });
             </script>
            ";
          }
            else{
           echo "
            <script>
                $(document).ready(function(){
                              document.getElementById('account-status').innerHTML = 'Active';
                });
             </script>
            "; 
            }
          
    if(isset($_POST['currpass'])){
      if($userpass == $_POST['currpass']){
        $q_setNewPass = "UPDATE users SET password = ".$_POST['newpass']."WHERE username = '".$_SESSION['user']."'";
    
      if($_POST['newpass'] == $_POST['newpass2'] ){

              $conn->query($q_setNewPass);
             echo "
             <script>
                $(document).ready(function(){
                              document.getElementById('alert-msg').innerHTML = '<div class=\'alert alert-success\'><strong>Success!</strong> Password changed successfuly!</div>';
                });
             </script>
              ";
            }
      }
    }





?>
<body>
<!-- /DIV for users that arn't logged in! hide everything - show msg -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-default" role="navigation">
                        <span style="float:left;color:white;font-size:35px;cursor:pointer" class="burger-btn">&#9776;</span>
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <a class="navbar-brand" href="homepage.php">Homies<span class="dot"></span></a>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
<div class="dropdown pull-right" style='margin-top:6px'>
  <button style="vertical-align: top;display:inline-block" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" data-hover="dropdown">
   <div id="welcome-user"></div> <span style="float:left;" class="caret"></span>
  </button> <?php echo "<form style='vertical-align: top;display:inline-block' action='logout.php' method='post'><input style='margin-right:10px; border-radius:2px;' type='submit' value='Logout'>
</button></form>";
  ?>
  <ul class="dropdown-menu">
    <li><a href="myprofile.php"><img src="http://pluspng.com/img-png/user-png-icon-male-user-icon-512.png" style='width:20px'>   My Profile</a></li>
    <li><a href="adminpanel.php"><img src="https://i1.wp.com/lavaprotocols.com/wp-content/uploads/2014/09/google-apps-admin-panel-icon.png?ssl=1" width=20px alt="">   Admin Panel</a></li>
  </ul>
</div>
                     <!-- /.navbar-collapse -->
                  </nav>
               </div>
            </div>
         </div>
      </header>
      <div id="mySidenav" class="sidenav">
         <span style="color:white;font-size:50px;cursor:pointer" class="burger-btn">
         </span>
         <a href="homepage.php">Homepage</a>
         <a href="chores.php">Chores</a>
         <a href="gifts.php">Gifts</a>
         <a href="shoppinglist.php">Shopping</a>
         <a href="calendar.php">Calendar</a> 
   	 <a id="billsPage" href="bills.php">Bills</a>       
      </div>


<?php
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

	$permissions = "select permission from users WHERE username ='".$_SESSION['user']."' ";
	$user_permission = $conn->query($permissions);
	$row = $user_permission->fetch_assoc();
	$u_permission = $row['permission'];
	
	
	if($row['permission'] == 0){
      echo "<script>
      $(document).ready(function(){
        $('#billsPage').hide();
      });
      </script>";
	}

?>

<!--  PHP -->
    <?php
        session_start();
        if(!isset($_SESSION['user'])){
          header("Location: index.php");
          exit;
        }
        else{
            echo 
            "
            <script> console.log('password match'); 
            $(document).ready(function(){
            document.getElementById('welcome-user').innerHTML ='<h3><span>".$_SESSION['user']."</span></h3>';
            });
            </script>
        ";       
        }  
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
    //get permission for user
    $q_user = "SELECT * FROM users where username ='".$_SESSION['user']."'";
    $result = $conn->query($q_user);
    $row = $result->fetch_assoc();
    $permission = $row["permission"];
        if($permission == 0){    //if user is child - show points in dropdown
        $score = $row['score'];
            echo 
        "
        <script>
        $(document).ready(function(){
          $('.dropdown-menu li:nth-child(2)').html('<img src=\'img/coin.png\' width=35px>  ".$score."');
          //alert(".$score.");
        });
        </script>
        ";
        }

?>


    <main>
      <div id="alert-msg"></div>
      <table>
        <tr>
          <td>
 <h1 style= 'display:inline-block;'><span class="glyphicon glyphicon-user"></span>
My Profile</h1><br>
		   <div class="personal_info">
		   <br>
           <p> Username: <?php  echo $row['username']; ?> </p>
             <p> Password: ********  </p>

           <p>  Email Address: <?php  echo $row['email']; ?> </p> 
             <p> Date of Birth: <?php  echo $row['dob']; ?> </p>
			</div>
<br>
</td>
<td></td>


        </tr>
        <tr>
		<td>
		 <div class="personal_info">
<button id='change-pw-btn'>Change password </button>
<form style='padding:3%;display:none' action="myprofile.php" method='post'>
  <label>Enter your current password
  <input class="pass_reset" required type="password" name='currpass'></label><br>

<label>Type your new password
  <input class="pass_reset" required type="password" name='newpass'></label><br>
<label>Repeat new password
  <input class="pass_reset" required type="password" name='newpass2' ></label><br>

  <input  type="submit" id="change_password" value="Save">
</form>
  </div>
<br><br>
<script>
  $("#change-pw-btn").click(function(){
    $(".personal_info form").slideToggle();
  });
</script>
My account status:
            <h4 id='account-status'></h4>

          </td>
          <td id="my_family"">
           <center> <h2>My Family</h2> </center>
              <center>
             
<?php

$q_family = "SELECT * FROM users where  familyid = (SELECT distinct familyid FROM users WHERE username = '".$_SESSION['user']."') ";
$res = $conn->query($q_family);

	
	if($row['familyid'] == 0)
	{
		echo "you are not related to any family yet.";
	}
	else{
		
		while($row = $res->fetch_assoc()){
 echo "<div class='col-sm-6 col-lg-4' style='width:50%;' >
                      <img src='img/".$row['gender']."-".$row['permission'].".png'>
                      <h4>".$row['fname']."</h4>
                      
                    </div>";
		}
	}




?>
              </div>
</center>
          </td>

        </tr>
      </table>


    </main>

</body>

</html>