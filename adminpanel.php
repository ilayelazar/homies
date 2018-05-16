<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/family-logo.png">
    <title>Homies - Admin panel</title>


    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Heebo" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Mina:700" rel="stylesheet">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="script/admin.js"></script>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="css/chores.css">
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
<!-- DIV for users that arn't logged in! hide everything - show msg -->
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
            $('.nav.navbar-nav').css('display','none');
            document.getElementById('welcome-user').innerHTML ='<h1>Welcome, <span id=\'currUser\'>".$_SESSION['user']."</span><form action=\'logout.php\' method=\'post\'><input type=\'submit\' value=\'Logout\'></form></h1>';
            });
            </script>
        ";       
        }  
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
                            <!--<img src="img/family-logo.png" width="50px" id="logo-img"> -->
                            <a class="navbar-brand" href="homepage.php">Homies<span class="dot"></span></a>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav" id="nav-ul">
                                <li>
                                    <a href="signup.php" id="signup"><img src="img/signup.png"></a>
                                </li>
                            </ul>
                            <div id="welcome-user"></div>

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
  <!--  <nav>
        <div class="box" style="height:50px">
            <ul>
                <li class="col-lg-2"><a href="calendar.php">Calendar</a></li>
                <li class="col-lg-3"><a href="chores.php">Chores</a></li>
                <li class="col-lg-2"><a href="shoppinglist.php">Groceries</a></li>
                <li class="col-lg-3"><a href="gifts.php">Gifts</a></li>
                <li class="col-lg-2"><a href="bills.php">Bills</a></li>
            </ul>
        </div>
    </nav>-->
        <div class="box" style="width:75%">
            <div class="row">
                <div class="hidden-xs voffset6"></div>
                <div class="col-md-12 col-lg-12" panel>
                    <br>
                    <div class="panel-heading" id="syllabus">
                        <div class="tabbable">
                            <ul class="nav nav-tabs" id="myTabs">
							<span class="moduleHeader" style="margin-bottom:0px;" > Admin panel </span>
                                <li class="active"><a href="#p1" data-toggle="tab"><strong>group members</strong></a></li>
                                <!--<li><a href="#p2" data-toggle="tab"><strong>Permissions</strong></a></li>
                                <li><a href="#p3" data-toggle="tab"><strong>Points</strong></a></li>-->
								<li><a href="#p2" data-toggle="tab"><strong>gifts pricing</strong></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <!--  ------- tab 1 ------- -->
                            <div class="tab-pane fade  in active " id="p1">
                                <div id="add_member_form" class="">



<!--------------WAITING LIST TABLE----------------------------- -->		
				<h2>Group warint list:</h2>	
				<p class="empty_data">Approve or decline users that want to join your family group.</p>				
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
						
							$waiting_list = "SELECT fname, lname, users.username, users.permission FROM users INNER JOIN GroupWaitlist ON GroupWaitlist.familyid=(select familyid from users where username='".$_SESSION['user']."') AND users.username=GroupWaitlist.username";

							$result = $conn->query($waiting_list);

							if ($result->num_rows > 0) {
								 echo "<table class='homiesTables'>
                                    <br>
                                    <thead>
                                        <tr class='tableHeaders'>
                                            <th>First name </th>
                                            <th>Last name</th>
                                            <th>User name</th>
                                            <th>Permission</th>
                                            <th></th>
											<th></th>
                                        </tr>
                                    </thead>
                                    <tbody>";
								 // output data of each row
								 while($row = $result->fetch_assoc()) {
									 echo "<tr>
                                           						 
                                            <td id='firstName'> " . $row['fname']. "</td>
                                            <td id='lastName'> " . $row['lname']. " </td>
											 <td id='userName'>" . $row['username']. " </td>	
                                            <td id='permission'>"; 
											
											if($row['permission']=='1')
												echo "Parent";
											else
												echo "Child";
											
											echo "</td>
                                            <td><a href='#' onclick=\"edituser('".$row['username']."','".$_SESSION['user']."',1);\"><img id='approveUser' src='img/addUser.png' title='Approve user'></a></td>
											<td><a href='#' onclick=\"edituser('".$row['username']."','".$_SESSION['user']."',0);\"><img id='removeUser' src='img/removeUser.png' title='Deny user'></a></td>
											
											</td>
                                        </tr>
									 ";
								 }
								 echo "</tbody></table>";
							} else {
									 echo "<table class='user-manage homiesTables'>
                                    <br>
                                    <thead>
                                        <tr class='tableHeaders'>
                                            <th>First name </th>
                                            <th>Last name</th>
                                            <th>User name</th>
                                            <th>Permission</th>
                                            <th></th>
											<th></th>
                                        </tr>
                                    </thead>
									
									<tr><td><h4>There are no users in the group waiting list<h4> </td></tr> 
									
							  </table>";
							}
								?>
							
								
								
							    </div>
                                <br><br>



<!--------------GROUP USERS TABLE----------------------------- -->									
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
								
							$group_members = "SELECT fname, lname, username, permission, score FROM users WHERE familyid=(SELECT familyid from users WHERE username='".$_SESSION['user']."') ORDER BY score DESC";

							$result = $conn->query($group_members);

							if ($result->num_rows > 0) {
								 echo "<h2>My Family: </h2><table class='homiesTables' id='family-members-table'>
                                    <br>
                                    <thead>
                                        <tr class='tableHeaders'>
                                            <th>First name </th>
                                            <th>Last name</th>
                                            <th>User name</th>
                                            <th>Permission</th>
											<th>Score</th>
                                            <th></th>
											<th></th>
                                        </tr>
                                    </thead>
                                    <tbody>";
								 // output data of each row
								 while($row = $result->fetch_assoc()) {
									 echo "<tr>                                      						 
                                            <td id='firstName'> " . $row['fname']. "</td>
                                            <td id='lastName'> " . $row['lname']. " </td>
											<td id='userName'>" . $row['username']. " </td>	
                                            <td id='permission'>"; 
											if($row['permission'] == 1){
                                                echo "
                                                <label>
                                                <input type='radio' value='1' name='permission_".$row['username']."' checked>Parent
                                                </label>
                                                <label>
                                                <input type='radio' value='0' name='permission_".$row['username']."'>Child
                                                </label>
                                                ";
                                            }
                                            else{
                                                echo "
                                                <label>
                                                <input type='radio' value='1' name='permission_".$row['username']."'>Parent
                                                </label>
                                                <label>
                                                <input type='radio' value='0' name='permission_".$row['username']."' checked>Child
                                                </label>
                                                ";
                                            }
											// if($row['permission']=='1')
											// 	echo "
											//   <select name='premissions'>
											// 	<option value='1' selected>Parent</option>
											// 	<option value='0'>Child</option>
											//   </select>";
											// else
											// 	echo "<form action='adminpanel.php' method='POST'>
											// <select name='premissions'>
											// 	<option value='1' >Parent</option>
											// 	<option value='0' selected>Child</option>
											//   </select>";
										
											echo "</td>
											
											<td>";
											if($row['permission']=='1')
											{
												echo "<span>0</span>";
											}
											else
											{
												echo "<input type='number' pattern='.{1,}'  value='" . $row['score']. "' name='currScore'></form>";
											}
											
											
											echo "</td>
                          <td><button onclick=\"editUserScore('".$row['username']."');\" id='apply_".$row['username']."'>Apply</button</td>
											<td><input type='button' title='remove user from group' onclick=\"edituser('".$row['username']."','".$_SESSION['user']."',2);\" value='Remove user'></td>
                                        </tr>
									 ";
								 }
								 echo "</tbody></table>";
							} else {
									 echo "<table id='manage_mambers_table' class='homiesTables'>
                                    <br>
                                    <thead>
                                         <tr class='tableHeaders'>
                                            <th>First name </th>
                                            <th>Last name</th>
                                            <th>User name</th>
                                            <th>Permission</th>
											<th>Score</th>
                                            <th></th>
											<th></th>
                                        </tr>
                                    </thead>
							  </table>";
							}
								?>
								
                            </div>
                            <script>
                             function editUserScore(user){ 
                                //var newP = document.getElementById(id).parentElement.parentElement.children[3].children[0].value;
                                var id = "input[name='permission_"+user+"']:checked";
                                var newP = $(id).val();
                                var pointsId = "apply_"+user;
                                var newPoints = document.getElementById(pointsId).parentElement.parentElement.children[4].children[0].value;
                             $.post('apply-user-changes.php',   // url
                             { 
                              userToChange: user,                          
                              score:newPoints,
                              permission: newP
                              }, // data to be submit
                            function(response) {// success callback
                                    //alert(response);
                                    //window.location = window.location.href;
                                    $("body").load("#family-members-table");
                  
                                }
                              );
                            
                           }
						   

                            </script>
                            <!--  end tab 1-->
							
							
                            <!--  ------- tab 2 ------- --
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
                            --  end tab 2--
							
							
                            --  ------- tab 3 ------- --
							
                            <div class="tab-pane fade" id="p3">
							
							
								
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
                                        <tr class='tableHeaders'>
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
                                        <tr class='tableHeaders'>
                                            <th>User name </th>
                                            <th>Score</th>
                                            <th style='width:150px;'></th>
                                        </tr>
                                    </thead>
                                    <tbody>
							  </table>";
							}
								?>
								
								</div> -->
                            <!--  end tab 3 -->
							
						<!--  ------- tab 4 ------- -->
                            <div class="tab-pane fade " id="p2">
							
														<script>
							function editPresentPrice(presentid){ 
                                 var score = document.getElementById("apply_"+presentid).parentElement.parentElement.children[4].children[0].value;

                             $.post('apply-price.php',   // url
                             { presentid: presentid , score:score }, // data to be submit
                                function(response) {// success callback
                                    //alert(response);
									alert("Presents price updated");
                                }
                              );
                            
                           }
							</script>
							
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
								
								
							$group_presents = "SELECT presentid, p_name, p_description, p_link, p_username, p_score FROM presents INNER JOIN users ON p_username=username WHERE familyid=(select familyid from users where username='".$_SESSION['user']."') ORDER BY p_score ASC";

							$result = $conn->query($group_presents);

							if ($result->num_rows > 0) {
								 echo "<table class= 'homiesTables'>
                                   <thead>
                                        <tr class='tableHeaders'>  
                                            <th>Name</th>
                                            <th>Description</th>
											
											<th>Requested by</th>
                                            <th colspan='2'>Price</th>
											
											<th></th>
											<th></th>
                                        </tr>
                                    </thead>
                                    <tbody>";
								 // output data of each row
								 while($row = $result->fetch_assoc()) {
									 echo "<tr>
                                            <td >" . $row['p_name']. "</td>							 
                                            <td >" . $row['p_description']. "</td>
											
											 <td >" . $row['p_username']. "</td>											
											 <td><input type='number' value='" . $row['p_score']. "' name='currScore' name='presentScore'></td>;
											 <td><a href='".$row['p_link']."' title='".$row['p_link']."' target='_blank' style='display:inline; color:#2fa7e0; background-color:#efefef; padding:8px 0px 8px 10px; font-weight:bold;'>Link</a></td>
											 <td><button onclick='editPresentPrice(".$row['presentid'].");' id='apply_".$row['presentid']."'>Apply</button></td>
                          </tr>";
								 }
							echo "</tbody></table>";}
							 else {
									 echo "<table id='score_board' class= 'homiesTables'>
                                     <thead>
                                        <tr>
                                            
                                            <th>Present name</th>
                                            <th>Description</th>
											<th>Link</th>
											<th>Requested by</th>
                                            <th>Price</th>
											<th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
							  </table>";
							}
								?>
							
							
							

							
							
							       <!---    <table id="gifts_table" class="user-manage cell-border row-border hover order-column homiesTables">
									   
                                    <br>
                                    <thead>
                                        <tr class="tableHeaders">
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
                                </table>-->

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
    <!--scripts-->
    <script>
      /*  $(document).ready(function() {
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
                    if (confirm('Remove \'' + user + '\' from the family group?') && confirm('are you sure?')) { //remove user from table } });*/
					

		function edituser(username,user,addOrRemove){					
		   var username = username;
		   var user = user;
		   var addOrRemove = addOrRemove;
		
		
		 if(addOrRemove=='1')
		 {
			 if(confirm(' Add this user to your group?'))
			 {
				 	  $.post('edituser.php',   // url
					 { username:username ,user:user ,addOrRemove:addOrRemove}, // data to be submit
						function(data, status, jqXHR) {// success callback
						  window.location="adminpanel.php";
						  
						  if(addOrRemove=='1')
						  alert("User successfully ADDED to your group");
						  else 
						  alert("User REMOVED successfully ");
						}
				);
			 }
		 
		 
		 
		 } 
		 
		 else if(addOrRemove=='0')
		 {if(confirm(' Delete this user from your group wating list?'))
			 
		 
		 	  $.post('edituser.php',   // url
					 { username:username ,user:user ,addOrRemove:addOrRemove}, // data to be submit
						function(data, status, jqXHR) {// success callback
						  window.location="adminpanel.php";
						  
						  if(addOrRemove=='1')
						  alert("User successfully ADDED to your group");
						  else 
						  alert("User REMOVED successfully ");
						}
				);
		 
		 }
		}
			 
		 
		
		
		
		function editUserSettings(username, currScore, permission){
		
		 var username = username;
		   var currScore = currScore;
		   var permission = permission;
		   
		   alert(currScore);
			alert(username);
			alert(permission);
		
		};

		   


    </script>

</body>

</html>
