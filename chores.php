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
      <!--JS-->
      <script src="script/chores.js"></script>
      <script src="script/script.js"></script>
      <script src="script/paging.js"></script>
      <script src="script/multi_pagination.js"></script>
	  
	  <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
   </head>
   <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
   <body>

<?php		//Controller for chores forms
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
   	$addChore="INSERT INTO chores (choreid,familyid,c_title,c_description,c_score,is_available, c_status,c_username) 
   	VALUES ('".$cid."', (select familyid from users where username= '". $_SESSION['user'] ."') ,'".$chore_name."','".$chore_description."','".$chore_score."',1,0,'NOBODY');";//what we got from the user
   	
   	$conn->query($addChore);//operates the chore query 

   	$result = $conn->query($addChore);
   }
   	
?>
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
            document.getElementById('welcome-user').innerHTML ='<h1>Welcome, ".$_SESSION['user']."<form action=\'logout.php\' method=\'post\'><input type=\'submit\' value=\'Logout\'></form></h1>';
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
                            <!-- -->
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
<?php
          if($_GET['tab'] == '1'){
         echo "
         <script> 
            $('a[href=\'#p1\'').parent().removeClass('active');              
            $('a[href=\'#p2\'').parent().addClass('active');
            $('#p1').removeClass('active in');                           
            $('#p2').addClass('active in');

         </script>
      ";
	}

  ?>

      <main>
         <!--<nav>
            <div class="box" style="height:50px">
                <ul>
                  <li class="col-lg-2"><a href="calendar.php">Calendar</a></li>
                  <li class="col-lg-3"><a href="chores.php">Chores</a></li>
                  <li class="col-lg-2"><a href="shoppinglist.php">Groceries</a></li>
                  <li class="col-lg-3"><a href="gifts.php">Gifts</a></li>
                  <li class="col-lg-2"><a href="bills.php">Bills</a></li>
               </ul>
            </div> 
         </nav> -->
         <div class="box">
            <div class="row">
               <div class="hidden-xs voffset6"></div>
               <div class="col-md-12 col-lg-12" panel>
                  <br>
                  <div class="panel-heading" id="syllabus">
                     <div class="tabbable">
                        <ul class="nav nav-tabs" id="myTabs">
						<span class="moduleHeader">Chores </span>
                           <li class="active"><a href="#p1" data-toggle="tab"><strong>available</strong></a></li>
                           <li><a href="#p2" data-toggle="tab"><strong>mine</strong></a></li>
						   <li><a href="#p3" data-toggle="tab"><strong>all</strong></a></li>
						   <li><a href="#p4" data-toggle="tab"><strong>scoreboard </strong></a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="panel-body">
                     <div class="tab-content">
                        <!--  ------- tab 1 ------- -->
                        <div class="tab-pane fade  in active " id="p1">
            
						   <?php
						   
														   
								$q_chores = "SELECT choreid, c_title, c_description, c_score, c_username, is_available FROM chores WHERE is_available ='1' and familyid=(SELECT distinct familyid from users WHERE username= '".$_SESSION['user']."') ";
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
													$newChore= $newChore."<input type='button' value='assign to me' onclick=\"assignchore(".$row['choreid'].",'".$_SESSION['user']."',1);\" >
														
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
						   
						   
                           <!--<div id="newChores"></div> -->
						   
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
						   
														   
								$my_to_do = "SELECT choreid, c_title, c_description, c_score, c_username, is_available, c_status FROM chores WHERE c_username= '".$_SESSION['user']."' AND c_status='0'";
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
													$myToDo= $myToDo."<input type='button' value='DONE' onclick=\"donechore(".$row['choreid'].",".$row['c_score'].",'".$_SESSION['user']."');\" >
													<input type='button' value='RETURN' onclick=\"assignchore(".$row['choreid'].",'".$_SESSION['user']."',0);\" >
														
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
						   
				<div class="panel-heading" id="syllabus2">
                     <div class="tabbable">
                        <ul class="nav nav-tabs" id="myTabs2">
						
                           <li class="active"><a href="#p3a" data-toggle="tab"><strong>Assinged</strong></a></li>
						   <li><a href="#p3c" data-toggle="tab"><strong>Already done</strong></a></li>
                        </ul>
                     </div>
                  </div>
				   <div class="panel-body">
                     <div class="tab-content">
                        <!--  ------- tab 3a ------- -->
                        <div class="tab-pane fade  in active " id="p3a">
						  <div id="pg3a">
						   <?php 		
 
								$family_to_do = "SELECT choreid,familyid, c_title, c_description, c_score, c_username, is_available, c_status FROM chores
								WHERE is available='0' and familyid=(select distinct familyid from chores where familyid=(select distinct familyid from users where username= '". $_SESSION['user'] ."'))";
								
								$result = $conn->query($family_to_do);
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
													$myToDo= $myToDo."<h4>Assigned to ".$row['c_username']." </h4>
														
												 </p>
										   </div>";
												 }
												 else{
													$myToDo= $myToDo."<h4>already done by ".$row['c_username']." </h4>
												 </p>
										   </div>";
												 }
										 
										 
										 echo $myToDo;
										 }
										 echo "</center>";
								}
								
							else{
								echo"<h2>Any of your family members had assigned themselves to any chore </h2>";
							}

						   
						   ?>
						  
						  
						   </div>
						   </div>
						
						  
						<!--  -------  end tab 3a ------- -->
						
						
						<!--  ------- tab 3c ------- -->
						<div class="tab-pane fade  in active " id="p3c">
						  <div id="pg3c">
						    <?php 

								$family_to_do = "SELECT choreid,familyid, c_title, c_description, c_score, c_username, is_available, c_status FROM chores
								WHERE c_status='1' and familyid=(select distinct familyid from chores where familyid=(select distinct familyid from users where username= '". $_SESSION['user'] ."'))";
								
								$result = $conn->query($family_to_do);
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
													$myToDo= $myToDo."<h4>Assigned to ".$row['c_username']." </h4>
														
												 </p>
										   </div>";
												 }
												 else{
													$myToDo= $myToDo."<h4>already done by ".$row['c_username']." </h4>
												 </p>
										   </div>";
												 }
										 
										 
										 echo $myToDo;
										 }
										 echo "</center>";
								}
								
							else{
								echo"<h2>Any of your family members had assigned themselves to any chore </h2>";
							}

						   
						   ?>
						
						  </div>
						</div>	
						<!--  -------end tab 3c ------- -->						
					</div>
				</div>
            </div>
		</div>	 
                        
                        <!--  end tab 3-->
			
			<!-- end of tab 3 -->
      			 <!--  ------- tab 4 ------- -->
                        <div class="tab-pane fade " id="p4">
                            <div id="pg4">
    

	
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
								
							$scoreboard = "SELECT username, score FROM users WHERE familyid=(SELECT familyid from users WHERE username='".$_SESSION['user']."') AND permission='0' ORDER BY score DESC";

							$result = $conn->query($scoreboard);

							if ($result->num_rows > 0) {
								 echo "<table class='homiesTables'>
                                    <br>
                                    <thead>
                                        <tr id='tableHeaders'>
                                           <th></th>
                                            <th>User name</th>                                        
											<th>Score</th>
                                            											
                                        </tr>
                                    </thead>
                                    <tbody>";
								 // output data of each row
								 while($row = $result->fetch_assoc()) {
									 echo "<tr>                                      						 
                                            <td></td>
											<td id='userName'>" . $row['username']. " </td>	
                                          
											<td>" . $row['score']. "</td> </tr>";
									 
								 }
								 echo "</tbody></table>";
							} else {
									 echo "<table class='homiesTables'>
                                    <br>
                                    <thead>
                                     <tr id='tableHeaders'>
                                            <th></th>
                                            <th>User name</th>
                                            
											<th>Score</th>
                                        </tr>
                                    </thead>
							  </table>";
							}
								?>
							
							 
							 
							 
							 
							 
							 
                           </div>
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
						function donechore(cid,score,user){					
						   var cid = cid;
							var user = user;
							var score = score;
							$.post('doneChore.php',   // url
									{ cid: cid, score:score, user:user }, // data to be submit
									function(data, status, jqXHR) {// success callback
									  window.location="chores.php";
									  alert("Successfully marked this chore as done");
									}
							);
						}

		   </script>


		   <script>
						function assignchore(cid,user,doneOrBacktoqueue){					
						   var cid = cid;
						   var user = user;
						   var doneOrBacktoqueue=doneOrBacktoqueue;
							  $.post('assignchore.php',   // url
									 { cid: cid,user:user, doneOrBacktoqueue:doneOrBacktoqueue }, // data to be submit
										function(data, status, jqXHR) {// success callback
										  window.location=window.location.href;
										  if(doneOrBacktoqueue=='1')
										  alert("Successfully assigned to you");
									  else
										    alert("Successfully sent to available chores");
									  
										}
								);
						}

		   </script>

     
      <!--functions-->
      <script>

         
         
         
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