<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" href="img/family-logo.png">
      <title>Homies - Gifts</title>
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
   	

   if(isset($_POST["presentName"])){
   	//add present vars
   	$presentName=$_POST["presentName"];
   	$presentDescription=$_POST["presentDescription"];
   	$presentPrice="null";//$_POST["presentPrice"];
	$presentLink=$_POST["presentLink"];
   	$requested_by=$_SESSION['user'];					
   	$pStatus= "0";
   	
   	$max_query = "SELECT COALESCE(max(`presentid`) ,0) as max FROM `presents`";
   	$result = $conn->query($max_query);
   	$row = $result->fetch_assoc();
   	$pid = $row["max"];
   	$pid = $pid + 1;
    

   	//add present query
   	$addPresent="INSERT INTO presents (presentid,p_name,p_description,p_username,p_score,p_link ,p_status)
   	VALUES ('".$pid."','".$presentName."','".$presentDescription."','".$requested_by."','".$presentPrice."','".$presentLink."','".$pStatus."');";//what we got from the user
   	
   	$conn->query($addPresent);//operates the chore query 

   	$result = $conn->query($addPresent);
   	
   	}
	

?>

<script>

/////// Update present
         
		 function buyGift(pid){
			 alert ("hiiii");
			 <?php
				$update_p = "UPDATE presents
				SET p_status = '1'
				WHERE presentid = pid";
				$result = $conn->query($update_p);
			 
			 ?>
			 
		 }
</script>



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
                           <li class="active"><a href="#p1" data-toggle="tab"><strong>Gifts</strong></a></li> <!--gifts with price-->
                           <li><a href="#p2" data-toggle="tab"><strong>Wishlist </strong></a></li> <!--gifts without price, user can add-->
                           <li><a href="#p3" data-toggle="tab"><strong>Gifts History</strong></a></li> <!--who bought what-->
                        </ul>
                     </div>
                  </div>
                  <div class="panel-body">
                     <div class="tab-content">
                        <!--  ------- tab 1 ------- -->
                        <div class="tab-pane fade  in active " id="p1">
                         <h1> Available gifts ! </h1> 

						<?php
														   
								$q_chores = "SELECT presentid, p_name, p_description, p_username, p_score, p_link FROM presents WHERE p_status='0' and p_score >'0'";
								$result = $conn->query($q_chores);
									echo "<center>";
								if ($result->num_rows > 0) {
									 // output data of each row
									 while($row = $result->fetch_assoc()) {
										 $newPresent="";
										 $newPresent= $newPresent."
				                            <div class='task-box col-lg-3 col-sm-4'>
												 <h2>".$row['p_name']."</h2>
												 <h4>description:</h4>
												 <p class='descriptionFont'>
													".$row['p_description']."
												 </p>
												 <h4>Link:</h4>
												 <p>
												  ".$row['p_link']." </p>
												 <h4>Price:</h4>
												 <p class='score_for_chore'>
												  ".$row['p_score']." </p>
												 <h4>Requested by:</h4>
												 <p> ".$_row['p_username']." </p>
												 <button onclick='buyGift(".$row['presentid'].");'>BUY!</button>" ;

										 $newPresent= $newPresent."
										   </div>";
										 echo $newPresent;
										 }
										 echo "</center>";
								}

						   
						   ?>
						 
						 
                           <br>
                           <br>
                        </div>
                        <!--  end tab 1-->
						
                        <!--  ------- tab 2 ------- -->
                      <div class="tab-pane fade " id="p2">
                   	   
						    <?php
						   
														   
								$q_chores = "SELECT p_name, p_description, p_username, p_score,p_link FROM presents WHERE p_status='0' and p_score='0'";
								$result = $conn->query($q_chores);
									echo "<center>";
								if ($result->num_rows > 0) {
									 // output data of each row
									 while($row = $result->fetch_assoc()) {
										 $newPresent="";
										 $newPresent= $newPresent."
				                            <div class='task-box col-lg-3 col-sm-4'>
												 <h2>".$row['p_name']."</h2>
												 <h4>description:</h4>
												 <p class='descriptionFont'>
													".$row['p_description']."
												 </p>
												 <h4>Link:</h4>
												 <a href='".$row['p_link']."' target='_blank'>".$row['p_link']."											
												 </a>
												 <h4>Requested by:</h4>
												 <p> ".$_SESSION['user']." </p>
												 " ;

										 $newPresent= $newPresent."
										   </div>";
										 echo $newPresent;
										 }
										 echo "</center>";
								}

						   
						   ?>
						   
                    <!--add present button-->
                           <div class="col-lg-3 newPresent">
                              <img src="img/green-plus.png" alt="Add new present" class="newItemBtn" id="newPresentBtn">
                              <div class="addPresent" style="display:none">
                                 <hr>
                                 <form action="gifts.php" onsubmit="return validateForm()" name="myPresentForm" method="POST">
                                    <table>
                                       <tr>
                                          <td>Present name:</td>
                                          <td><input type="text" name="presentName" maxlength="11" class="form-control formFont">
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>Description:</td>
                                          <td><input type="text" name="presentDescription" maxlength="22" class="formFont"></td>
                                       </tr>
                                       <tr>
                                          <td>Link (optional):</td>
                                          <td><input type="link" name="presentLink" class="formFont"></td>
                                       </tr>
                                       <tr>
                                          <td>
										    <button type="submit" id="addPresentBtn" onclick="addPresent();" value="Add Present">Add Present</button>										  
                                          </td>
                                          <td><input type="button" value="CLOSE"></td>
                                       </tr>
                                    </table>
                                 </form>
                              </div>
                           </div>
                        </div>
                        <!--  end tab 2-->
                        <!--  ------- tab 3 ------- -->
                        <div class="tab-pane fade" id="p3">
						<?php
					
							$g_history = "SELECT p_name, p_description, p_username, p_score FROM presents WHERE p_status='1'";
							$result = $conn->query($g_history);

							if ($result->num_rows > 0) {
								 echo "<table id='gifts_history'  class='cell-border row-border hover order-column'>     <thead>
                                 <tr id='tableHeaders'>
                                    <th>User name </th>
                                    <th>Present</th>
                                    <th>Price</th>
                                    <th>Date of purchase</th>
                                 </tr>
                              </thead>
							   <tbody>";
								 // output data of each row
								 while($row = $result->fetch_assoc()) {
									 echo "<tr><td id='userName'>" . $row["p_username"]. "</td><td id='giftName'>" . $row["p_name"]. " </td>
									 <td id='giftPrice'>" . $row["p_score"]. " </td><td id='giftDateOfPurchase'>" . $row["p_name"]. " </td></tr>";
								 }
								 echo "</tbody></table>";
							} else {
									 echo "<table id='gifts_history'  class='cell-border row-border hover order-column'>     
									 <thead>
                                 <tr id='tableHeaders'>
                                    <th>User name </th>
                                    <th>Present</th>
                                    <th>Price</th>
                                    <th>Date of purchase</th>
                                 </tr>
                              </thead>
							  </table>";
							}
						
						?>
						
						
						
						
                           <!--<table id="gifts_history"  class="cell-border row-border hover order-column">
                              <thead>
                                 <tr id="tableHeaders">
                                    <th>User name </th>
                                    <th>Present</th>
                                    <th>Price</th>
                                    <th>Date of purchase</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td id="userName"> Shahr</td>
                                    <td id="giftName"> Freedom </td>
                                    <td id="giftPrice"> 700M </td>
                                    <td id="giftDateOfPurchase"> Null </td>
                                 </tr>
                                 <tr>
                                    <td id="userName"> Noy</td>
                                    <td id="giftName"> Car </td>
                                    <td id="giftPrice"> 1000 </td>
                                    <td id="giftDateOfPurchase"> 14/4/2018 </td>
                                 </tr>
                              </tbody>
                           </table>-->
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
        <!-- <span style="color:white;font-size: 18px">© 2018 </span>	
         <ul>
            <li><a href="#">link</a></li>
            <li><a href="#">link</a></li>
            <li><a href="#">link</a></li>
            <li style="border-right:0"><a href="#">link</a></li>
         </ul>-->
      </footer>

	  
	  														
					 
							
					
<!--scripts-->
<?php
        if(isset($_POST['presentName'])){
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

<!--data table script-->							
      <script>
         $(document).ready( function () {
         
           $('#gifts_history').DataTable();
         
         } );
         
         
         
         $('#gifts_history').DataTable( {
         
         autoFill: true,
         
         responsive: true} );
         
         
         
      </script>
         	
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