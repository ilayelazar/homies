<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Cache-Control" content="no-store" />
      <meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" href="img/family-logo.png">
      <title>Homies - Homepage</title>
      <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Heebo" rel="stylesheet">
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <!-- Latest compiled JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="script/script.js"></script>
      <link href="https://fonts.googleapis.com/css?family=Mina:700" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
      <link rel="stylesheet" type="text/css" href="css/homepage.css">
   </head>
   <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->
   <body>
    <script>
      
      
    </script>
       
  <!-- DIV for users that arn't logged in! hide everything - show msg -->
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
                    //get permission for user
                    $q_familyid = "SELECT familyid FROM users where username ='".$_SESSION['user']."'";
                    $result = $conn->query($q_familyid);
                    $row = $result->fetch_assoc();
                    $familyid = $row["familyid"];




        if(!isset($_SESSION['user'])){
          header("Location: index.php");
          exit;
        }
        else if($familyid == '0'){
          header("Location:creategroup.php");
        }
            echo 
            "
            <script> console.log('password match'); 
            $(document).ready(function(){
            $('.nav.navbar-nav').css('display','none');
            document.getElementById('welcome-user').innerHTML ='Welcome, ".$_SESSION['user']."<form action=\'logout.php\' method=\'post\'><input type=\'submit\' value=\'Logout\'></form>';
            });
            </script>
        ";
?>
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
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav" id="nav-ul">
                                <li>
                                    <a href="signup.php" id="signup"><img src="img/signup.png"></a>
                                </li>
                            </ul>
							        <div class="box" style="height:40px">
          <div id="welcome-user"></div>          
        </div>
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
		<a href="bills.php">Bills</a> 		 
      </div>
      <main>

         <div class="box">
            <h1 style="color:white;">Welcome Homie</h1>
            <center>
             <div class="nav-buttons">
               <div class="row">
                  <a href="gifts.php" class="btn-link">
                     <div class="container col-lg-4 col-sm-4">
                        <p><img src="https://freeiconshop.com/wp-content/uploads/edd/shopping-bag-flat.png" alt="Avatar" class="image">
                          <span class="nav-button-label">Gifts</span>
                        </p>
                        <div class="middle">
                           <div class="text">Gifts</div>
                        </div>
                     </div>
                  </a>
                  <a href="calendar.php" class="btn-link">
                     <div class="container col-lg-4 col-sm-4">
                        <p><img src="img/calendar-logo.png" alt="Avatar" class="image">
                        <span class="nav-button-label">Calendar</span></p>
                        <div class="middle">
                           <div class="text">Calendar
                           </div>
                        </div>
                     </div>
                  </a>
                  <a href="shoppinglist.php" class="btn-link">
                     <div class="container col-lg-4 col-sm-4">
                        <p><img src="img/shopping-logo.png" alt="Avatar" class="image">
                        <span class="nav-button-label">Shopping</span></p>
                        <div class="middle">
                           <div class="text">Shopping</div>
                        </div>
                     </div>
                  </a>
               </div>
               <div class="row">
                  <a href="chores.php" class="btn-link">
                     <div class="container col-lg-4 col-sm-4">
                        <p><img src="img/house-clean.png" alt="Avatar" class="image">
                        <span class="nav-button-label">Chores</span></p>
                        <div class="middle">
                           <div class="text">Chores</div>
                        </div>
                     </div>
                  </a>
                  <a href="bills.php" class="btn-link">
                     <div class="container col-lg-4 col-sm-4">
                        <p><img src="img/billing-logo.png" alt="Avatar" class="image">
                        <span class="nav-button-label">Bills</span></p>
                        <div class="middle">
                           <div class="text">Bills</div>
                        </div>
                     </div>
                  </a>
                  <a href="adminpanel.php" class="btn-link">
                     <div class="container col-lg-4 col-sm-4">
                        <p><img src="img/admin-logo.png" alt="Avatar" class="image">
                        <span class="nav-button-label">Admin Panel</span></p>
                        <div class="middle">
                           <div class="text">Panel</div>
                        </div>
                     </div>
                  </a>
               </div>
            </div>
        </center>
         </div>
         <!-- @@@@@@@@  BOTTOM DASHBOARD @@@@@@@@@ -->
          <div class="box" style="width:90%;min-height:150px" id="dashboard">
              <center>
              <div class="col-lg-4">
               <table>
                <tr><th colspan="2">Upcoming Events</th></tr>
                  <tr>
                    <td>1/1/18</td>
                    <td>Event Title</td>
                  </tr>
                  <tr>
                    <td>1/1/18</td>
                    <td>Event Title</td>
                  </tr>
                  <tr>
                    <td>1/1/18</td>
                    <td>Event Title</td>
                  </tr>                  <tr>
                    <td>1/1/18</td>
                    <td>Event Title</td>
                  </tr>
              </table>
            </div>
              <div class="col-lg-4">
               <table>
                <tr><th colspan="2">My Family</th></tr>
                  <tr><td style="width:100%">
                    <div class="col-lg-4 col-sm-6" class="family-member">
                   <img src="https://www.powerschool.com/wp-content/uploads/2017/09/icon-student-parent.png" alt="">Parent
                  </div>
                  <div class="col-lg-4 col-sm-6" class="family-member">
                   <img src="https://www.powerschool.com/wp-content/uploads/2017/09/icon-student-parent.png" alt="">Parent
                  </div>
                  <div class="col-lg-4 col-sm-6" class="family-member">
                   <img src="https://www.powerschool.com/wp-content/uploads/2017/09/icon-student-parent.png" alt="">Parent
                  </div>
                  <div class="col-lg-4 col-sm-6" class="family-member">
                   <img src="https://www.powerschool.com/wp-content/uploads/2017/09/icon-student-parent.png" alt="">Parent
                  </div>                  
                </td></tr>
              </table>
            </div>
              <div class="col-lg-4">
               <table>
                <tr><th colspan="2">Recent Chores</th></tr>
                  <tr>
                    <td>Chore Title</td>
                    <td>150 Points</td>
                  </tr>
                  <tr>
                    <td>Chore Title</td>
                    <td>150 Points</td>
                  </tr>
                  <tr>
                    <td>Chore Title</td>
                    <td>150 Points</td>
                  </tr>
                  <tr>
                    <td>Chore Title</td>
                    <td>150 Points</td>
                  </tr>
                  <tr>
                    <td>Chore Title</td>
                    <td>150 Points</td>
                  </tr>
              </table>
            </div>                        
          </center>
          </div>
      </main>

   </body>
</html>