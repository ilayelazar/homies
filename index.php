<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" href="img/family-logo.png">
      <title>Homies - Homepage</title>
      <link href="https://fonts.googleapis.com/css?family=Heebo" rel="stylesheet">
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <!-- Latest compiled JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="script/script.js"></script>
      <link href="https://fonts.googleapis.com/css?family=Mina:700" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
      <link rel="stylesheet" type="text/css" href="css/homepage.css">
   </head>
   <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->
   <body>
       

       
  <header>
     <div class="container">
        <div class="row">              
           <div class="col-md-12">
              <nav class="navbar navbar-default" role="navigation">
             <span style="float:left;color:white;font-size:35px;cursor:pointer" class="burger-btn">&#9776;</span>
                 <!-- Brand and toggle get grouped for better mobile display -->
                 <div class="navbar-header">   
                    <img src="img/family-logo.png" width="50px" id="logo-img">  
                    <a class="navbar-brand" href="homepage.php">Homies</a>
                 </div>
                 <!-- Collect the nav links, forms, and other content for toggling -->
                 <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav" id="nav-ul">
                       <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="img/login-img.png" width=90px> <b class="caret"></b></a>
                          <ul class="dropdown-menu" style="padding: 15px;min-width: 250px;">
                                 
                                  
<?php
session_start();
	if(isset($_POST['username'])){             
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
          echo "<script>console.log('DB Connection failed');</script>";
            
        } 
        else{
          echo "<script>console.log('DB Connection succeded');</script>";
        }
          //--------end-dblogin---------
    //check login credentials in db   
        $user=$_POST['username'];
        $q ="SELECT password FROM users where username ='" . $user . "'";
        
        $result = $conn->query($q);
            if ($result->num_rows > 0) {
                        // output data of each row
                $row = $result->fetch_assoc();
                $dbPass = $row["password"];
                $userpass = $_POST["userpass"];
                    if($dbPass == $userpass){
                        //input pw match db pw  
                        $_SESSION['user'] = $_POST['username'];
                    }
                    else{
                            echo "
                            <script>
                            console.log('password dont match'); 
                                    $(document).ready(function() {
                                        $('header .dropdown').addClass('open');
                                    });
                            </script>
                            Invalid login, try again <br>
                            ";                            
                    }
            }
            else{
                echo "
                <script>
                console.log('password dont match'); 
                        $(document).ready(function() {
                            $('header .dropdown').addClass('open');
                        });
                </script>
                Invalid login, try again <br>
                ";                     	
            }
    }

  if(isset($_SESSION['user'])){
  	 echo 
        "
        <script> console.log('password match'); 
		$('.nav.navbar-nav').css('display','none');
		$(document).ready(function(){
        document.getElementById('welcome-user').innerHTML ='<h1>Welcome, ".$_SESSION['user']."<form action=\'logout.php\' method=\'post\'><input type=\'submit\' value=\'Logout\'></form></h1>';
        });
        </script>
        ";       
  }
    
?>
                                  
                                  
                                  
                                  
                                  <li>
                                    <div class="row">
                                       <div class="col-md-12">
                                          <form class="form" role="form" method="post" action="homepage.php" accept-charset="UTF-8" id="login-nav">
                                             <div class="form-group">
                                                <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                                             </div>
                                             <div class="form-group">
                                                <label class="sr-only" for="password">Password</label>
                                                <input type="password" class="form-control" name="userpass" id="password" placeholder="Password" required>
                                             </div>
                                             <center>
                                                <label>
                                                <input style="width:initial" type="checkbox">Remember me
                                                </label>
                                                <div class="form-group">
                                                   <button type="submit" class="btn btn-success btn-block">Sign in</button>
                                                </div>
                                             </center>
                                          </form>
                                       </div>
                                    </div>
                                 </li>
                              </ul>
                           </li>
                           <li><a href="signup.php" id="signup"><img src="img/signup.png"></a></li>
                        </ul>
                        <div id="welcome-user">
                        </div>
                        
                     </div>
                     <!-- /.navbar-collapse -->
                  </nav>
               </div>
            </div>
         </div>
      </header>
      <main>
         <div class="box">
            <h1 style="color:white;">Welcome to Homies!</h1>
              <center>
                <a style="display: block" href="login.php"> Login!</a>
                <div class="box" style="width:40%">
                   <form class="form" role="form" method="post" action="homepage.php" accept-charset="UTF-8">
                                                <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                                <input type="text" class="form-control" name="username" placeholder="Username" required>
                                             <div class="form-group">
                                                <label class="sr-only" for="password">Password</label>
                                                <input type="password" class="form-control" name="userpass" placeholder="Password" required>
                                             </div>
                                             <center>
                                                <label>
                                                <input style="width:initial" type="checkbox">Remember me
                                                </label>
                                                <div class="form-group">
                                                   <button type="submit" class="btn btn-success btn-block">Sign in</button>
                                             </center>
                                          </form>
                </div>
                <a style="display: block" href="register.php">Register to Homies</a>         
              </center>
         </div>
      </main>
   </body>
</html>