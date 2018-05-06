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
        <!-- DIV for users that arn't logged in! hide everything - show msg -->
         <div class="please-login-msg">
        <?php
          session_start();
          if(!isset($_SESSION['user'])){
              
            }
            else{
              header("Location: homepage.php");
            }
        ?>
          <center>
             <h2><i><strong>Welcome to Homies</strong></i></h2>
              <div class="container" style="width:100%">
                    <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                      <div class="panel panel-login">
                        <div class="panel-heading">
                          <div class="row">
                            <div class="col-xs-6">
                              <a href="#" class="active" id="login-form-link" style="letter-spacing: 2px"><u><i>Login</i></u></a>
                            </div>
                            <div class="col-xs-6">
                              <a href="signup.php" id="register-form-link" style="color:blue; font-style: underline;">Register</a>
                            </div>
                          </div>
                          <hr>
                        </div>
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-lg-12">
                              <form id="login-form" action="index.php" method="post" style="display: block;">
                                <div class="form-group">
                                  <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                                </div>
                                <div class="form-group">
                                  <input type="password" name="userpass" id="password" tabindex="2" class="form-control" placeholder="Password">
                                  
                                </div>
                                 <?php
        if(isset($_POST['username'])){
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
                        header("Location:homepage.php");
                    }
                    else{
                      echo "Wrong password, try again...";
                      echo 
                      " <div class='text-center'>
                                        
                        <!-- @@@@@@@@@@@@@   TODO: FORGOT PW PAGE @@@@@@@@@@@@@@@@-->
                                        <a href='#' tabindex='5' class='forgot-password'>Forgot Password?</a>
                                      </div>";                            
                    }
            }
            else{
              echo "invalid username";
            }
          }

                  ?>
                                <div class="form-group text-center">
                                  <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                                  <label for="remember"> Remember Me</label>
                                </div>
                                <div class="form-group">
                                  <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                      <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="row">
                                    <div class="col-lg-12">
                                    </div>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>  
        </center>
         </div>
         <!-- DIV for users that arn't logged in! hide everything - show msg -->         


         
         </div>
      </main>
   </body>
</html>