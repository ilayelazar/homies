<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="icon" href="img/family-logo.png">
      <title>Homies</title>
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
      <link rel="stylesheet" type="text/css" href="css/index.css">
	  
	    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
   </head>
   <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->
   <body>
             
  <header>
     <div class="container">
        <div class="row">              
           <div class="col-md-12">
              <nav class="navbar navbar-default" role="navigation">
            
                 <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                   <a class="navbar-brand" href="homepage.php">Homies<span class="dot"></span></a>
                 </div>
                 <div class="navbar-header">
                   <h2>Family Management System</h2>
                 </div>
                 <!-- Collect the nav links, forms, and other content for toggling -->
                 <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <!--<ul class="nav navbar-nav" id="nav-ul">
                           <li><a href="signup.php" id="signup"><img src="img/signup.png"></a></li>
                        </ul>-->
                        <div id="welcome-user">
                        </div>
                     </div>
                     <!-- /.navbar-collapse -->
                  </nav>
               </div>
            </div>
         </div>
      </header>
	  <aside>
      <div class="container-fluid">
    <div class="row-fluid">
        <div class="col-md-12" id="box">
            <h2>Login</h2>
            <hr>
            <form class="form-horizontal" action="index.php" method="POST">
                <fieldset>
                    <!-- Form Name -->
                    <!-- Text input-->

                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input name="username" placeholder="Username" class="form-control" type="text">
                            </div>
                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group">

                        <div class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input name="userpass" type="password" placeholder="Password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="submit" value='Login' class="btn btn-md btn-danger pull-right">
                        </div>
                    </div>
        <?php
        session_start();
        if(isset($_POST['username'])){
          echo "<script> alert(1);</script>";
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
        $q ="SELECT password,permission FROM users where username ='" . $user . "'";
        
        $result = $conn->query($q);
            if ($result->num_rows > 0) {
                        // output data of each row
                $row = $result->fetch_assoc();
                $dbPass = $row["password"];
                $userpass = $_POST["userpass"];
                    if($dbPass == $userpass){
                        //input pw match db pw  
                        $_SESSION['user'] = $_POST['username'];
                        $_SESSION["permission"] = $row['permission'];
                        
                        header("Location:homepage.php");
                        exit;
                    }
                    else{
                      echo "Wrong password, try again...";
                      echo 
                      " <div class='text-center'>
                         <a href='#' tabindex='5' class='forgot-password'>Forgot Password?</a>
                                      </div>";  
                    }
            }
            else{
              echo "invalid username";
            }
          }
            ?>
                </fieldset>
            </form>
                <hr>
            <h4 style="color:white;">
              New here? <a href="signup.php">Join Us!</a>
            </h4>
        </div>

    </div>
    </aside>
	  <main>
     <center>
	  <img id="flow_chart" src="img/flowChart.png" alt="homies flow chart">
	 </center>   
	  <!--Welcome--- -->
	
<div id="manage_your_family">
    <h1> Manage your family life <span class="dot"></span></h1>
    <h3>Homies will help you manage your family.</h3>
  
   
    <br>
	
    <center>
        <row>
          <div id="Dchores" class="index-imgs col-md-2 col-sm-6 col-md-offset-1"><img src="img/index_img/index_chores.png">
            <p><span style="color:#2f3848; font-weight: bold;">Manage house chores.</span><br>do house chores and earn points! </p>
            
        </div>
        <div id="Dbills" class="index-imgs col-md-2 col-sm-6"><img src="img/index_img/wallet.png">
            <p><span style="color:#2f3848; font-weight: bold;">Bills management.</span><br>Easy manage your bills and payments history</p>
        </div>
        <div id="Dcalendar" class="index-imgs col-md-2 col-sm-6"><img src="img/index_img/calendar.png">
            <p><span style="color:#2f3848; font-weight: bold;">Family calendar.</span><br>Shared family calendar and important notes</p>
        </div>
        <!--<div id="Dadmin"class="index-imgs col-md-2 col-sm-6" ><img src="img/index_img/"><p></p></div> -->
        <div id="Dgifts" class="index-imgs col-md-2 col-sm-6"><img src="img/index_img/gift.png">
            <p><span style="color:#2f3848; font-weight: bold;">Gift shop.</span><br>Creat a wishlist and buy your gifts with the points you earned!</p>
          
        </div>
        <div id="Dshopping" class="index-imgs col-md-2 col-md-offset-right-1 col-sm-6"><img src="img/index_img/shoping.png">
            <p><span style="color:#2f3848; font-weight: bold;">Family Shopping List.</span> manage an accurate and relevant shopping list</p>
        </div>
      </row>
    </center>
</div>
	  
	 
	  
        <!-- DIV for users that arn't logged in! hide everything - show msg -->
         <div class="please-login-msg">
        <?php
          session_start();
          if(isset($_SESSION['user'])){
            header("Location: homepage.php");
            }
        ?>
<!--           <center>
             <h2>Welcome to Homies</h2>
              <div class="container" style="width:100%">
                    <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                      <div class="panel panel-login">
                        <div class="panel-heading">
                          <div class="row">
                            <div class="col-xs-6">
                              <a href="#" class="active">Login</a>
                            </div>
                            <div class="col-xs-6">
                              <a href="signup.php" id="register-form-link" style="color:blue;">Register</a>
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
                                  <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                                  
                                </div>

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
        </center> -->

      </main>
	  

    <footer>
      <br><h6>2018 Workshop by: Ilay Elazar | Noy Tsarfaty | Nadia Medavdovski</h6>

    </footer>
	  
	  
	  
	  
   </body>
</html>