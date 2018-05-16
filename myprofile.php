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
      <link rel="stylesheet" type="text/css" href="css/homepage.css">   
  </head>

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
  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" data-hover="dropdown">
   <div id="welcome-user"></div> <span class="caret"></span>
  </button> <?php echo "<form action='logout.php' method='post'><input type='submit' value='Logout'>
</button></form>";
  ?>
  <ul class="dropdown-menu">
    <li><a href="#"><img src="http://pluspng.com/img-png/user-png-icon-male-user-icon-512.png" style='width:20px'>   My Profile</a></li>
    <li><a href="#"><img src="https://i1.wp.com/lavaprotocols.com/wp-content/uploads/2014/09/google-apps-admin-panel-icon.png?ssl=1" width=20px alt="">   Admin Panel</a></li>
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
    <a href="bills.php">Bills</a>      
      </div>



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
            document.getElementById('welcome-user').innerHTML ='<h1><span>".$_SESSION['user']."</span></h1>';
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
</body>

</html>