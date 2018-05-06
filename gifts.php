<!DOCTYPE html>
<html>
  <!--<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" href="img/family-logo.png">
      <title>Homies - Gifts</title>
      <link href="https://fonts.googleapis.com/css?family=Heebo" rel="stylesheet">
      <!-- Latest compiled and minified CSS
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <!-- jQuery library 
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <!-- Latest compiled JavaScript 
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link href="https://fonts.googleapis.com/css?family=Mina:700" rel="stylesheet">
      <!--CSS
      <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
	  <link rel="stylesheet" type="text/css" href="css/chores.css">

      <!--JS--
      <script src="script/chores.js"></script>
      <script src="script/script.js"></script>	  
      <script src="script/paging.js"></script>
      <script src="script/multi_pagination.js"></script>
	  
	    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
   </head>-->
   
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
      <!--JS-->
      <script src="script/chores.js"></script>
      <script src="script/script.js"></script>
      <script src="script/paging.js"></script>
      <script src="script/multi_pagination.js"></script>
	  
	  <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
   </head>
   
   <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->
   <body>
   <main>
   

<?php		//Controller for new present
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
                  <div class="panel-heading tabs" id="syllabus">
                     <div class="tabbable">
                        <ul class="nav nav-tabs" id="myTabs">
						<span class="moduleHeader">Gifts </span>
                           <li class="active"><a href="#p1" data-toggle="tab"><strong>shop</strong></a></li> <!--gifts with price-->
                           <li><a href="#p2" data-toggle="tab"><strong>wishlist </strong></a></li> <!--gifts without price, user can add-->
                           <li><a href="#p3" data-toggle="tab"><strong>history</strong></a></li> <!--who bought what-->
                        </ul>
                     </div>
                  </div>
                  <div class="panel-body">
                     <div class="tab-content">
                        <!--  ------- tab 1 ------- -->
                        <div class="tab-pane fade  in active " id="p1">
                         <h1> Available gifts </h1> 

						<?php
														   
								$q_chores = "SELECT presentid, p_name, p_description, p_username, p_score, p_link FROM presents WHERE p_status='0' and p_score >'0'  ";
								
								$result = $conn->query($q_chores);
								
								//$user_score="select score from users where username='".$_SESSION['user']."'";
								//$result2 = $conn->query($user_score);
								//$row2 = $result2->fetch_assoc();
								
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
												 <p> ".$row['p_username']." </p>
												 
		 <input type='button' value='BUY' onclick=\"buygift(".$row['presentid'].",".$row['p_score'].",'".$_SESSION['user']."', ". date("d/m/Y") .");\" >" ;

										 $newPresent= $newPresent."
										   </div>";
										 echo $newPresent;
										 }
										 echo "</center>";
								}

						   
						   ?>
						   
						   
		   <script>
						function buygift(pid, p_score, user, date){					
						   var pid = pid;
							var user = user;
							var p_score = p_score;
							//var user_score = user_score;
							var date=date;
							
							alert('im in');
						
							$.post('buygift.php',   // url
									{ pid: pid, p_score:p_score, user:user, date:date }, // data to be submit
									function(data, status, jqXHR) {// success callback
									  window.location="gifts.php";
									  
									  alert("You have successfully bought this gift! ");
									}
							);
							}
						}

		   </script>
						 
						 
                           <br>
                           <br>
                        </div>
                        <!--  end tab 1-->
						
                        <!--  ------- tab 2 ------- -->
                      <div class="tab-pane fade " id="p2">
                   	   
						    <?php
						   
$q_chores = "SELECT p_name, p_description, p_username, p_score,p_link FROM presents INNER JOIN users ON p_username=username WHERE p_status='0' and p_score='0' and familyid=(select familyid from users where username='".$_SESSION['user']."')";
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
												 <p> ".$row['p_username']." </p>
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
					
							$g_history = "SELECT p_name, p_description, p_username, p_score,dop FROM presents WHERE p_status='1'";
							$result = $conn->query($g_history);

							if ($result->num_rows > 0) {
								 echo "<table class='homiesTables'>     <thead>
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
									 <td id='giftPrice'>" . $row["p_score"]. " </td><td id='giftDateOfPurchase'>" . $row["dop"]. " </td></tr>";
								 }
								 echo "</tbody></table>";
							} else {
									 echo "<table id='gifts_history'  class='homiesTables'>     
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