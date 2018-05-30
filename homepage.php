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
<div class="dropdown pull-right" style='margin-top:6px'>
  <button style="height:50px;display:inline-block" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" data-hover="dropdown">
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
         <a href="homepage.php"><span class="glyphicon glyphicon-home"></span>  Homepage</a>
         <a href="chores.php"><span class='glyphicon glyphicon-list-alt'></span>  Chores</a>
         <a href="gifts.php"><span class='glyphicon glyphicon-gift'></span>  Gifts</a>
         <a href="shoppinglist.php"><span class='glyphicon glyphicon-shopping-cart'></span> Shopping</a>
         <a href="calendar.php"><span class='glyphicon glyphicon-calendar'></span>  Calendar</a> 
     <a id="billsPage" href="bills.php"><span class='glyphicon glyphicon-usd'></span>  Bills</a>      
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
          $(\".dropdown-menu\").children(1)[1].innerHTML = \"  <img src='img/coin.png' width=40px>    ".$score."\";
        });
        </script>
        ";
        }

?>
      <main>
      <div class="container">
        <div class="row" dir="rtl">
            <a href="calendar.php">
            <div class="col5">
              <h1>Calendar</h1>              
              <img src="img/homepage/hp_calendar.png">
              <ul dir='ltr' class='col-details'>
                <li>Shared Calendar</li>
                <li>Family Notes</li>
              </ul>
            </div>
            </a>
       <a href="gifts.php">
            <div class="col5" style="background-color: #a8a8a8">
              <h1>Gifts</h1>
              <img src="img/homepage/hp_gifts.png">
              <ul dir='ltr' class='col-details'>
                <li>Gifts Shop</li>
                <li>Wishlist</li>
              </ul>
            </div>
            </a>

            <a href="shoppinglist.php">
              <div class="col5" style="background-color: #f05768">
              <h1>Family Cart</h1>
              <img src="img/homepage/hp_shopping.png">
              <ul dir='ltr' class='col-details'>
                <li>Grocery List</li>
                <li style='font-size: 20px'>Food Recipes Search</li>
              </ul>
            </div>
            </a>
                       <a href="chores.php">
            <div class="col5" style="background-color: #a8a8a8">
              <h1>Chores</h1>
              <img src="img/homepage/hp_chores.png">
              <ul dir='ltr' class='col-details'>
                <li>Assign Chores</li>
                <li>Chores History</li>
              </ul>
            </div>
            </a>
            <a href="bills.php">
            <div class="col5" style="background-color: gray">
              <h1>Bills</h1>
              <img src="img/homepage/hp_bills.png">
              <ul dir='ltr' class='col-details'>
                <li>Bills Management</li>
                <li>Reports</li>
              </ul>
            </div>
            </a>
        </div>
    </div>
    
  
        <div class="container">
          <div class="row">
            
            <div class="updates col-lg-4 col-md-12">
              <h3>Latest completed chores</h3>              
      
      <?php
            $q_done_chores = "SELECT * FROM chores WHERE c_status='1' AND doneDate IN (SELECT max(doneDate) from chores WHERE familyid=(select familyid from users where username = '".$_SESSION['user']."') group by c_username) group by c_username ORDER BY doneDate DESC";                
        $result = $conn->query($q_done_chores);
              if ($result->num_rows > 0) { 
              while($row = $result->fetch_assoc()) {
                $originalDate = $row['doneDate'];
                $newDate = date("d/m", strtotime($originalDate));
                echo         "
<div class='done-chore col-md-8'>
<h3> ".$row['c_username']."</h3>
<h4><b> ".$row['c_title']."</b></h4><h4 style='display:inline'>".$row['c_score']."<img src='img/coin.png' style='display:inline-block;vertical-align:bottom;width:30px;height:30px;'></h4><h4 style='padding:3px;'>".$newDate."  <span class='glyphicon glyphicon-calendar'></span></h4>
</div>";
        

              }
            }

        else {
              echo "No chores complete yet";
              }            
            ?>
            
            </div>
            
            
            <div class="updates col-lg-4 col-md-12" >
              <h3>    Upcoming events  </h3>
            
             
      <?php
              $upcoming_events = "SELECT familyid,title,date,start_time,end_date FROM events where date > now() and familyid=(select distinct familyid from users where username= '". $_SESSION['user'] ."') AND DATE(date) - DATE(now()) < '5'
                AND DATE(date) - DATE(now()) > '-1' order by date ASC";
                
        $result = $conn->query($upcoming_events);

              if ($result->num_rows > 0) {
                 echo "<table class='homiesTables'> <thead>
                                 <tr class='tableHeaders'>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Event</th>  
                                 </tr>
                              </thead>
                 <tbody>";
                 // output data of each row
                 while($row = $result->fetch_assoc()) {
                  $originalDate = $row['date'];
                  $newDate = date("d/m", strtotime($originalDate));
                   echo "<tr><td>" . $newDate. "</td><td>" . $row["start_time"]. " </td>
                   <td>" . $row["title"]. " </td></tr>";
                 }
                 echo "</tbody></table>";
              } 
        else {
                   echo "<table class='homiesTables'>     
                   <thead>
                      <tr class='tableHeaders'>
                          <th>Date</th>
                          <th>Start</th> 
                          <th>Event </th> 
                          <th>End</th>    
                       </tr>
                    </thead>
                </table>";
              }
            
            ?>
            </div>
            
              <div class="updates col-lg-4 col-md-12" >
              <h3>Last Notes</h3>


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
          echo "<script>console.log('DB Connection failed');</script>";
            
        } 
        else{
          echo "<script>console.log('DB Connection succeded');</script>";
        }
            $q_notes = "SELECT * FROM notes WHERE familyid=(SELECT familyid FROM users WHERE username='".$_SESSION['user']."') ORDER BY noteid DESC LIMIT 10";
                $result = $conn->query($q_notes);
                if ($result->num_rows > 0) {
                   // output data of each row
                   while($row = $result->fetch_assoc()) {
                     $newNote="";
                     $newNote= $newNote."
                      <div class='note-line'>                          
                        <h5 style='text-align:left;margin-left:10%'><strong><u>".$row['note_title']."</u></strong></h5>                         
                         <p style='color:black'>
                        ".$row['text']."
                         </p></div>";
                  echo $newNote;
                      } 
                  }                
                  else{
                    echo "<div style='width:50%; text-align:center; background-color:rgb(255,255,255,0.5);margin:auto;margin-bottom:3%;border-radius:20px;border:3px double white;'>0 Notes have been found</div>";
                  }

                ?>
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

                    $q_familyid = "SELECT familyid, permission as u_permission FROM users where username ='".$_SESSION['user']."'";
                    $result = $conn->query($q_familyid);
                    $row = $result->fetch_assoc();
                    $familyid = $row["familyid"];
                    $_SESSION['u_permission'] = $row['u_permission'];

                    if($_SESSION['u_permission'] == 0){
                      echo "<script>
                        </script>";
                    }
                ?>
      
            </div>
         
             
           </div>
        </div>
           

    
    <!--updates col-lg-4 col-md-12-->
  

      </main>

   </body>
</html>