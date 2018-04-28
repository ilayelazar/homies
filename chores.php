<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" href="img/family-logo.png">
      <title>Homies - Chores</title>
      <link href="https://fonts.googleapis.com/css?family=Heebo" rel="stylesheet">
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <!-- Latest compiled JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link href="https://fonts.googleapis.com/css?family=Mina:700" rel="stylesheet">
      <!--CSS-->
      <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
      <link rel="stylesheet" type="text/css" href="css/chores.css">
      <!--Data Table-->
      <script type="text/javascript"  src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>  
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
      <!--JS-->
      <script src="script/chores.js"></script>
      <script src="script/script.js"></script>
      <script src="script/paging.js"></script>
      <script src="script/multi_pagination.js"></script>
   </head>
   <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->
   <body>
   

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
   if(isset($_POST["choreName"])){
      //add chore	vars	
   	$chore_name=$_POST["choreName"];
   	$chore_description=$_POST["choreDescription"];
   	$chore_score=$_POST["choreScore"];
   	//$user_name=null;
   	
   	$max_query = "SELECT COALESCE(max(`choreid`) ,0) as max FROM `chores`";
   	$result = $conn->query($max_query);
   	$row = $result->fetch_assoc();
   	$cid = $row["max"];
   	$cid = $cid + 1;



   	
   	//we want to show it also after the insert of the form! - same as above
   	//add chore query 
   	$addChore="INSERT INTO chores (choreid,c_title,c_description,c_score,is_available, c_status) 
   	VALUES ('".$cid."','".$chore_name."','".$chore_description."','".$chore_score."',1,0);";//what we got from the user
   	
   	$conn->query($addChore);//operates the chore query 

   	$result = $conn->query($addChore);
   }
   	
?>
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
         <div class="box">
            <div class="row">
               <div class="hidden-xs voffset6"></div>
               <div class="col-md-12 col-lg-12" panel>
                  <br>
                  <div class="panel-heading" id="syllabus">
                     <div class="tabbable">
                        <ul class="nav nav-tabs" id="myTabs">
                           <li class="active"><a href="#p1" data-toggle="tab"><strong>TO DO</strong></a></li>
                           <li><a href="#p2" data-toggle="tab"><strong>My TO DO </strong></a></li>
						   <li><a href="#p3" data-toggle="tab"><strong>Scoreboard </strong></a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="panel-body">
                     <div class="tab-content">
                        <!--  ------- tab 1 ------- -->
                        <div class="tab-pane fade  in active " id="p1">
            
						   <?php
						   
														   
								$q_chores = "SELECT choreid, c_title, c_description, c_score, c_username, is_available FROM chores WHERE is_available =1";
								$result = $conn->query($q_chores);
									echo "<center>";
								if ($result->num_rows > 0) {
									 // output data of each row
									 while($row = $result->fetch_assoc()) {
										 $newChore="";
										 $newChore= $newChore."
				                            <div class='task-box col-lg-3 col-sm-4'>
												 <h2>".$row['c_title']."</h2>
												 <h4>description:</h4>
												 <p class='descriptionFont'>
													".$row['c_description']."
												 </p>
												 <h4>Score:</h4>
												 <p class='score_for_chore'>
												 <h3> ".$row['c_score']." </h3>" ;
												 if($row['is_available'] == '1' ){
													$newChore= $newChore."<input type='button' value='assign to me' onclick=\"assignchore(".$row['choreid'].",'".$_SESSION['user']."');\" >
														
												 </p>
										   </div>";
												 }
												 else{
													$newChore= $newChore."<h3>Assigned to:<br>".$row['c_username']."</h3>
												 </p>
										   </div>";
												 }
										 
										 
										 echo $newChore;
										 }
										 echo "</center>";
								}

						   
						   ?>
						   
						   
                           <!--<div id="newChores"></div>-->
						   
                   <!--add chorn button-->
                           <div class="col-lg-3 newChore">
                              <img src="img/green-plus.png" alt="Add new chore" class="newItemBtn" id="newChoreBtn">
                              <div class="addChore" style="display:none">
                                 <hr>
                                 <form action="chores.php" method="post" onsubmit="return validateForm()" name="myChoreForm">
                                    <table>
                                       <tr>
                                          <td>Chore name:</td>
                                          <td><input type="text" name="choreName" maxlength="15" class="form-control formFont">
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>Description:</td>
                                          <td><input type="text" name="choreDescription" maxlength="22" class="formFont"></td>
                                       </tr>
                                       <tr>
                                          <td>Score:</td>
                                          <td><input type="number" min="0" name="choreScore" class="formFont" pattern=".{1,}" title="digits only"></td>
                                       </tr>
                                       <tr>
                                          <td>
										  <button type="submit" id="addChoreBtn" onclick="addChore();" value="Add Chore">Add Chore</button>
                                          </td>
                                          <td><input type="button" value="CLOSE"></td>
                                       </tr>
                                    </table>
									
                                 </form>
                              </div>
                           </div>

						<br>
                        </div>
                        <!--  end tab 1-->
                        <!--  ------- tab 2 ------- -->
                        <div class="tab-pane fade " id="p2">
                           <div id="pg2">
                               
						   <?php
						   
														   
								$my_to_do = "SELECT choreid, c_title, c_description, c_score, c_username, is_available, c_status FROM chores WHERE c_username= '".$_SESSION['user']."'";
								$result = $conn->query($my_to_do);
									echo "<center>";
								if ($result->num_rows > 0) {
									 // output data of each row
									 while($row = $result->fetch_assoc()) {
										 $myToDo="";
										 $myToDo= $myToDo."
				                            <div class='task-box col-lg-3 col-sm-4'>
												 <h2>".$row['c_title']."</h2>
												 <h4>description:</h4>
												 <p class='descriptionFont'>
													".$row['c_description']."
												 </p>
												 <h4>Score:</h4>
												 <p class='score_for_chore'>
												 <h3> ".$row['c_score']." </h3>" ;
												 if($row['c_status'] == '0' ){
													$myToDo= $myToDo."<input type='button' value='DONE' onclick=\"donechore(".$row['choreid'].",'".$_SESSION['user']."');\" >
														
												 </p>
										   </div>";
												 }
												 else{
													$myToDo= $myToDo."<h4>already done</h4>
												 </p>
										   </div>";
												 }
										 
										 
										 echo $myToDo;
										 }
										 echo "</center>";
								}
								
							else{
								echo"<h2>You didn't assigned yourself to any chore, to do so - navigate to 'TO DO' tab and pick some chores :) </h2>";
							}

						   
						   ?>
            

                           </div>
                           <br>
                           <br>
                        </div>
                        <!--  end tab 2-->
					 <!--  ------- tab 3 ------- -->
                        <div class="tab-pane fade " id="p3">
                           <div id="pg3">
                              <div id="barchart"></div>
                           </div>
                           <br>
                           <br>
                        </div>
                        <!--  end tab 3-->
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
       <!--   <span style="color:white;font-size: 18px">© 2018 </span>	
        <ul>
            <li><a href="#">link</a></li>
            <li><a href="#">link</a></li>
            <li><a href="#">link</a></li>
            <li style="border-right:0"><a href="#">link</a></li>
         </ul>-->
      </footer>

	  
	  														
					 
							
					
<!--scripts-->


		   <script>
						function assignchore(cid,user){					
						   var cid = cid;
               var user = user;
                  $.post('assignchore.php',   // url
                         { cid: cid,user:user }, // data to be submit
                            function(data, status, jqXHR) {// success callback
                              
                            }
                    );
								//$assign_chore = "UPDATE chores SET c_username='noy_ts' WHERE choreid=cid";
						}

		   </script>

      <!--draw chart script-->
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
         function hashCode(str) { // java String#hashCode
         
             var hash = 0;
         
             for (var i = 0; i < str.length; i++) {
         
                hash = str.charCodeAt(i) + ((hash << 5) - hash);
         
             }
         
             return hash;
         
         } 
         
         
         
         		function intToRGB(i){
         
         		    var c = (i & 0x00FFFFFF)
         
         		        .toString(16)
         
         		        .toUpperCase();
         
         
         
         		    return "00000".substring(0, 6 - c.length) + c;
         
         		}
         
         
         
         	// Load google charts
         
         	google.charts.load('current', {'packages':['corechart']});
         
         	google.charts.setOnLoadCallback(drawChart);
         
         
         
         	// Draw the chart and set the chart values
         
         	   function drawChart() {
         
         		  var data = google.visualization.arrayToDataTable([
         
         			['User', 'Score', { role: 'style' }, { role: 'annotation' } ],
         
         			['Noy', 25, 'stroke-color: black; stroke-opacity: 0.2; stroke-width: 0.5; fill-color: #'+intToRGB(hashCode('Noy'))+'; fill-opacity: 1', 'Noy'],
         
         			['Ilay', 50, 'stroke-color: black; stroke-opacity: 0.2; stroke-width: 0.5; fill-color: #'+intToRGB(hashCode('Ilay'))+'; fill-opacity: 1', 'Ilay'],
         
         			['Nadia', 30, 'stroke-color: black; stroke-opacity: 0.2; stroke-width: 0.5; fill-color: #'+intToRGB(hashCode('Nadia'))+'; fill-opacity: 1', 'Nadia'],
         
         			['Shahar', 20, 'stroke-color: black; stroke-opacity: 0.2; stroke-width: 0.5; fill-color: #'+intToRGB(hashCode('Shahar'))+'; fill-opacity: 1', 'Shahar'],
         
         		  ]);
         
         	  // Optional; add a title and set the width and height of the chart
         
             var view = new google.visualization.DataView(data);
         
             view.setColumns([0, 1,
         
                                { calc: "stringify",
         
                                  sourceColumn: 1,
         
                                  type: "string",
         
                                  role: "annotation" },
         
                                2]);
         
         
         
         	  var options = {
         
         	  	    animation: {
         
         	        duration: 1000,
         
         	        easing: 'linear',
         
         	        startup:true
         
         	      },
         
         
         		'backgroundColor': 'transparent',
         
         	  	'width':1100,
         
         	  	'height':400,
         
         	  	'title':'Score',
         
         	  	'titlePosition':'none',
         
         	  	'annotations.alwaysOutside': true,
         
                 legend: { position: "none"},
         
                 bar: {groupWidth: "75%"},
         
                  annotations: {
         
         		    textStyle: {
         
         		      fontName: 'Calibri',
         
         		      fontSize: 30,
         
         		      bold: true,
         
         		      // The color of the text.
         
         		      color: 'black',
         
         		      // The color of the text outline.
         
         		      auraColor: 'white'
         
         		    }
         
         		  }
         
         	  };
         
         
         
         	  // Display the chart inside the <div> element with id="barchart"
         
         	  var chart = new google.visualization.ColumnChart(document.getElementById('barchart'));
         
         	  chart.draw(view, options);
         
         	}
         
         	
      </script>
      <!--functions-->
      <script>
         function assignChore()
         
         {
         
         //assign the chore to the user
         
         }
         
         
         
         /*function validateForm(){
         var chname = document.forms["myChoreForm"]["chore_name"].value;
         		if (chname == "") 
         		{alert("Please insert chore name");
         		return false;}
         		
         var chdescription = document.forms["myChoreForm"]["chore_description"].value;
         		if (chdescription == "") 
         		{alert("Please insert chore description");
         		return false;}
         
         var chschore = document.forms["myChoreForm"]["chore_score"].value;
         		if (chschore == "") 
         		{alert("Please insert chore schore");
         		return false;}
         var prname = document.forms["myPresentForm"]["present_name"].value;
         		if (prname == "") 
         		{alert("Please insert present name");
         		return false;}
         var prdescription = document.forms["myPresentForm"]["present_description"].value;
         	if (prdescription == "") 
         	{alert("Please insert present description");
         	return false;}		
         	
         var prprice = document.forms["myPresentForm"]["present_price"].value;
         	if (prprice == "") 
         	{alert("Please insert price for present");
         	return false;}
         
         }*/
         
         
         
         
         
         
         
      </script>
   </body>
</html>