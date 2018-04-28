
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/family-logo.png">
    <title>Homies - Admin panel</title>
    <link href="https://fonts.googleapis.com/css?family=Heebo" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="script/admin.js"></script>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="css/chores.css">
    <link href="https://fonts.googleapis.com/css?family=Mina:700" rel="stylesheet">
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="css/adminPanel.css">
    <!--Data Table-->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
      <!--JS-->
      <script src="script/admin.js"></script>
      <script src="script/script.js"></script>	  
      <script src="script/paging.js"></script>
      <script src="script/multi_pagination.js"></script>
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
      <div id="mySidenav" class="sidenav">
         <span style="color:white;float:right;font-size:30px;cursor:pointer" class="burger-btn">&#9776;
         </span>
         <a href="homepage.php">Homepage</a>
         <a href="chores.php">Chores</a>
         <a href="gifts.php">Gifts</a>
         <a href="shopping.php">Shopping</a>
         <a href="calendar.php">Calendar</a>      
      </div>
    <main>
        <nav>
            <div class="box" style="height:50px">
               <ul>
                  <li class="col-lg-2"><a href="calendar.php">Calendar</a></li>
                  <li class="col-lg-3"><a href="chores.php">Chores</a></li>
                  <li class="col-lg-2"><a href="shoppinglist.php">Groceries</a></li>
                  <li class="col-lg-3"><a href="gifts.php">Gifts</a></li>
                  <li class="col-lg-2"><a href="bills.php">Bills</a></li>
               </ul>
            </div>
        </nav>
        <div class="box" style="width:75%">
            <div class="row">
                <div class="hidden-xs voffset6"></div>
                <div class="col-md-12 col-lg-12" panel>
                    <br>
                    <div class="panel-heading" id="syllabus">
                        <div class="tabbable">
                            <ul class="nav nav-tabs" id="myTabs">
                                <li class="active"><a href="#p1" data-toggle="tab"><strong>Group Members</strong></a></li>
                                <li><a href="#p2" data-toggle="tab"><strong>Permissions</strong></a></li>
                                <li><a href="#p3" data-toggle="tab"><strong>Points</strong></a></li>
								<li><a href="#p4" data-toggle="tab"><strong>Gifts</strong></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <!--  ------- tab 1 ------- -->
                            <div class="tab-pane fade  in active " id="p1">
                                <div id="add_member_form" class="user-manage">
								
								<!--add user query--> 
								<?php						
									if(isset($_POST['uname'])){
										$s_user=$_POST['uname'];
										$user_fnl_name=$_POST['user_fnl_name'];
										
									
									//search user query 
									$searchUser="SELECT username FROM users WHERE username='".$s_user."';";//what we got from the user
									
									$conn->query($searchUser);//operates the chore query 

									$result = $conn->query($searchUser);
									
										  echo "
											 <script>                          
												$('#user_fnl_name').val('".$result."');
											 </script>
										  ";
										
									}
								?>
								
								
                                    <form action="adminpanel.php" method="get">
                                        <p id="add_member"> Add member:</p>
                                        <p id="username">Username: <input type="text" name="uname" id="search_uname">
										<input id="check_btn" type="submit" value="check" alt="Look for this username"><br><br></p>
                                        <center>Found: <input id="check_res" type="text" name="user_fnl_name" value="" readonly><br><br> Permission:
                                            <label><input type="radio" name="Upermission" value="1" checked> Parent</label>
                                            <label><input type="radio" name="Upermission" value="0">Child </label>
                                            <input type="submit" value="ADD">
                                        </center>
                                    </form>
                                </div>
                                <br><br>

								
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
          echo "<script>console.log('DB Connection failed');</script>";
            
        } 
        else{
          echo "<script>console.log('DB Connection succeded');</script>";
        }
								
							$group_members = "SELECT fname, lname, username, permission FROM users WHERE familyid=(SELECT familyid from users WHERE username='".$_SESSION['user']."')";

							$result = $conn->query($group_members);

							if ($result->num_rows > 0) {
								 echo "<h1>My Family: </h1><table id='manage_mambers_table' class='user-manage cell-border row-border hover order-column'>
                                    <br>
                                    <thead>
                                        <tr id='tableHeaders'>
                                            <th>First name </th>
                                            <th>Last name</th>
                                            <th>User name</th>
                                            <th>Permission</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>";
								 // output data of each row
								 while($row = $result->fetch_assoc()) {
									 echo "<tr>
                                            <td id='userName'>" . $row['username']. " </td>							 
                                            <td id='firstName'> " . $row['fname']. "</td>
                                            <td id='lastName'> " . $row['lname']. " </td>
                                            <td id='permission'>"; 
											
											if($row['permission']=='1')
												echo "Parent";
											else
												echo "Child";
											
											echo "</td>
                                            <td><img id='removeUser' src='img/remove.png'></td>
                                        </tr>
									 ";
								 }
								 echo "</tbody></table>";
							} else {
									 echo "<table id='manage_mambers_table' class='user-manage cell-border row-border hover order-column'>
                                    <br>
                                    <thead>
                                        <tr id='tableHeaders'>
                                            <th>First name </th>
                                            <th>Last name</th>
                                            <th>User name</th>
                                            <th>Permission</th>
                                            <th></th>
                                        </tr>
                                    </thead>
							  </table>";
							}
								?>
								
                            </div>
                            <!--  end tab 1-->
                            <!--  ------- tab 2 ------- -->
                            <div class="tab-pane fade " id="p2">
                                <div id="pg2" class="change_permission user-manage">
                                    <center>
                                        <div class="container" style="width:100%">
                                            <h1>Edit Family Permissions</h1>
                                            <form action="#">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Username</th>
                                                            <th>Permission</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>user1</td>
                                                            <td><label><input type="radio" value="1" name="user1">Parent</label></td>
                                                            <td><label><input type="radio" value="0" name="user1">Child</label></td>
                                                        </tr>
                                                        <tr>
                                                            <td>user2</td>
                                                            <td><label><input type="radio" value="1" name="user2">Parent</label></td>
                                                            <td><label><input type="radio" value="0" name="user2">Child</label></td>
                                                        </tr>
                                                        <tr>
                                                            <td>user3</td>
                                                            <td><label><input type="radio" value="1" name="user3">Parent</label></td>
                                                            <td><label><input type="radio" value="0" name="user3">Child</label></td>
                                                        </tr>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <input type="submit" value="Save">
                                            </form>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            <!--  end tab 2-->
                            <!--  ------- tab 3 ------- -->
							
                            <div class="tab-pane fade" id="p3">
                            <!--<table id="score_board" class="cell-border row-border hover order-column">
                                    <thead>
                                        <tr id="tableHeaders">
                                            <th>User name </th>
                                            <th>Score</th>
                                            <th style="width:150px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id="userNameScore"> Noy</td>
                                            <td id="userScore"> 10000 </td>
                                            <td><a href="#" onclick="edit_score();"><img id="editScore" src="img/edit.png"></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                <br>
                            </div>-->
							
							
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
          echo "<script>console.log('DB Connection failed');</script>";
            
        } 
        else{
          echo "<script>console.log('DB Connection succeded');</script>";
        }
								
							$scores_in_group = "SELECT permission, username, score FROM users WHERE familyid=(SELECT familyid from users WHERE username='".$_SESSION['user']."') AND permission='0'";

							$result = $conn->query($scores_in_group);

							if ($result->num_rows > 0) {
								 echo "<table id='score_board' class='cell-border row-border hover order-column'>
                                    <thead>
                                        <tr id='tableHeaders'>
                                            <th>User name </th>
                                            <th>Score</th>
                                            <th style='width:150px;'></th>
                                        </tr>
                                    </thead>
                                    <tbody>";
								 // output data of each row
								 while($row = $result->fetch_assoc()) {
									 echo "<tr>
                                            <td id='userNameScore'>" . $row['username']. "</td>							 
                                            <td id='userScore'>" . $row['score']. "</td> 
											 <td><a href='#' onclick='edit_score();'><img id='editScore' src='img/edit.png'></a></td>
                          </tr>' ";
								 }
							echo "</tbody></table>";}
							 else {
									 echo "<table id='score_board' class='cell-border row-border hover order-column'>
                                    <thead>
                                        <tr id='tableHeaders'>
                                            <th>User name </th>
                                            <th>Score</th>
                                            <th style='width:150px;'></th>
                                        </tr>
                                    </thead>
                                    <tbody>
							  </table>";
							}
								?>
								
								</div>
                            <!--  end tab 3-->
							
						<!--  ------- tab 4 ------- -->
                            <div class="tab-pane fade " id="p4">
							           <table id="gifts_table" class="user-manage cell-border row-border hover order-column">
									   <!-----------שליפההההההה-->
                                    <br>
                                    <thead>
                                        <tr id="tableHeaders">
                                            <th>Requested by</th>
                                            <th>Present name</th>
                                            <th>Description</th>
                                            <th>Price</th>
											<th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id="requestedBy"> Shahar</td>
                                            <td id="presentName"> Xbox </td>
                                            <td id="description"> adjlkajsld </td>
                                            <td id="price"> <input readonly type="text" id="presentprice" name="presentPrice" id="presentPrice"> </td>
                                            <td><button id="editpr" onclick="editPrice()">Edit</button><input type="submit" value="Save"></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <br>
                                <br>
                            </div>
                            <!--  end tab 4-->
                        </div>
                        <!-- tab-content-->
                    </div>
                    <!-- panel body -->
                    <!-- panel -->
                </div>
                <!-- end column -->
            </div>
            <!-- end row -->
        </div>
    </main>
    <footer>
        <span style="color:white;font-size: 18px">© 2018 </span>
        <ul>
            <li><a href="#">link</a></li>
            <li><a href="#">link</a></li>
            <li><a href="#">link</a></li>
            <li style="border-right:0"><a href="#">link</a></li>
        </ul>
    </footer>
    <!--scripts-->
    <script>
        $(document).ready(function() {
            $('#score_board').DataTable();
        });
        $('#score_board').DataTable({
            autoFill: true,
            responsive: true
        });
        $(document).ready(function() {
            $('#gifts_history').DataTable();
        });
        $('#gifts_history').DataTable({
            autoFill: true,
            responsive: true
        });

        function show_alert() {
            if (document.getElementById("search_uname") == 'n') alert("The user was found");
            else alert("The user wasn't found");
        }
        $("#removeUser").click(function() {
                    var user = document.getElementById("removeUser").parentElement.parentElement.children[2].innerHTML;
                    if (confirm('Remove \'' + user + '\' from the family group?') && confirm('are you sure?')) { //remove user from table } });

    </script>
    <!--data table script-->
    <script>
	<!--tab 1-->
        $(document).ready(function() {

            $('#manage_mambers_table').DataTable();

        });



        $('#manage_mambers_table').DataTable({

            autoFill: true,

            responsive: true
        });
		
	<!--tab 3-->
		
		       $(document).ready(function() {

            $('#score_board').DataTable();

        });


        $('#score_board').DataTable({

            autoFill: true,

            responsive: true
        });
		
	<!--tab 4 -->
	       $(document).ready(function() {

            $('#gifts_table').DataTable();

        });



        $('#gifts_table').DataTable({

            autoFill: true,

            responsive: true
        });
		
		
		function editPrice(){
			
		};

    </script>
</body>

</html>
