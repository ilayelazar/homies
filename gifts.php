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
      <link rel="stylesheet" type="text/css" href="css/gifts.css">
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
   

<?php   //Controller for new present
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
            document.getElementById('welcome-user').innerHTML ='<h3>Welcome, ".$_SESSION['user']."<form action=\'logout.php\' method=\'post\'><input type=\'submit\' value=\'Logout\'></form></h3>';
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
                            <a class="navbar-brand" href="homepage.php">Homies<span class="dot"></span></a>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
<div class="dropdown pull-right" style='margin-top:6px'>
  <button style="height:50px;display:inline-block" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" data-hover="dropdown">
   <div id="welcome-user"></div> <span style="float:left;" class="caret"></span>
  </button> <?php echo "<form style='vertical-align: top;display:inline-block' action='logout.php' method='post'><input style='margin-right:10px; border-radius:2px;' type='submit' value='Logout'>
</button></form>";
  ?>
  <ul class="dropdown-menu">
    <li><a href="myprofile.php"><img src="http://pluspng.com/img-png/user-png-icon-male-user-icon-512.png" style='width:20px'>   My Profile</a></li>
    <li><a href="adminpanel.php"><img src="https://i1.wp.com/lavaprotocols.com/wp-content/uploads/2014/09/google-apps-admin-panel-icon.png?ssl=1" width=20px alt="">   Admin Panel</a></li>
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
		 <a id="billsPage" href="bills.php">Bills</a>      
      </div>


<?php
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
} 	

	$permissions = "select permission from users WHERE username ='".$_SESSION['user']."' ";
	$user_permission = $conn->query($permissions);
	$row = $user_permission->fetch_assoc();
	$u_permission = $row['permission'];
	
	
	if($row['permission'] == 0){
      echo "<script>
      $(document).ready(function(){
        $('#billsPage').hide();
      });
      </script>";
	}
	
	
	if($row['permission'] == 1){
      echo "<script>
      $(document).ready(function(){
        $('#pricing_gifts').hide();
		
      });
      </script>
	  
	  ";
	}

?>

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
            document.getElementById('welcome-user').innerHTML ='<h3><span>".$_SESSION['user']."</span></h3>';
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
      
       
   <!----Scoreboard------ -->
     
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
                
              $scoreboard = "SELECT fname, username, score FROM users WHERE familyid=(SELECT familyid from users WHERE username='".$_SESSION['user']."') AND permission='0' ORDER BY score DESC";

              $result = $conn->query($scoreboard);

              if ($result->num_rows > 0) {
                 echo "<table class='scoreboard' style='width:30%; text-align:center; font-size:17px;' title='Scoreboard'>
                                    <br>
                                    <thead>
                                        <tr class='SB_Headers'>
                                        
                                            <th><img src='img/chores/Child.png' title='user name'></th>                                        
											<th><img src='img/chores/piggy-bank.png' title='user score'></th>
                                                                  
                                        </tr>
                                    </thead>
                                    <tbody>";
                 // output data of each row
                 while($row = $result->fetch_assoc()) {
                   echo "<tr>                                                  
                                        
                      <td id='userName'>" . $row['fname']. " </td> 
                                          
                      <td>" . $row['score']. "</td> </tr>";
                   
                 }
                 echo "</tbody></table>";
              } else {
                    echo "<table class='homiesTables scoreboard' style='width:30%; text-align:center; font-size:17px;' title='Scoreboard'>
                                    <br>
                                    <thead>
                                        <tr class='SB_Headers'>
                                        
                                            <th><img src='img/chores/Child.png' title='user name'></th>                                        
											<th><img src='img/chores/piggy-bank.png' title='user score'></th>
                                                                  
                                        </tr>
                                    </thead>
                                    </table>
									<center><h4 style='text-align:center; width:30%; padding:5px; border: solid #efefef 3px;'>There are not children in the	 group </h4></center>" ;
              }
              $q_permission="SELECT permission FROM users WHERE username='".$_SESSION['user']."'";
              $result = $conn->query($q_permission);
              $row = $result->fetch_assoc();
              if($row['permission']=='1'){
                echo "
                <script>
                $(document).ready(function(){
                  $(\"input[value='BUY']\").hide();
                });
                </script>
                ";
              }
                ?>
  
     
       <script>
            function buygift(pid, p_score, user, user_score){         
               var pid = pid;
              var user = user;
              var p_score = p_score;
              var user_score = user_score;
			  
			  
             
            if(confirm('Buy this gift?')){
            if(p_score > user_score)
            {
              alert('You dont have enough points to buy this gift, do more chores ! :)');
            }
            else{
              $.post('buygift.php',   // url
                  { pid: pid, p_score:p_score, user:user }, // data to be submit
                  function(data, status, jqXHR) {// success callback
                    window.location="gifts.php";
                    
                    alert("You have successfully bought this gift! ");
                  }
              );
            }
            }}
            

       </script>
	     <div id="alert-msg"></div>
         <div class="box">
            <div class="row">
               <div class="hidden-xs voffset6"></div>
               <div class="col-md-12 col-lg-12" panel>
                  <br>
                  <div class="panel-heading tabs" id="syllabus">
                     <div class="tabbable">
					  <span class="moduleHeader">Gifts </span>
                        <ul class="nav nav-tabs" id="myTabs">
           
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
						
					<div id="pricing_gifts">
                         <h3> Your pricing gifts: </h3>
		   
			      <?php
						   
														   
 $q_presents = "SELECT presentid, p_name, p_description, p_username, p_score, score, type FROM presents inner join users on p_username=username WHERE p_status='0' and p_score >'0' and p_username='".$_SESSION['user']."' ";
                
                $result = $conn->query($q_presents);
							
								
								if ($result->num_rows > 0) {
									 // output data of each row
									 while($row = $result->fetch_assoc()) {
										 $newPresent="";
										 $newPresent= $newPresent.
                     "
<div class='newPresentTest newChoreTest'>
    <div class='chore-icon'>
      <img src='img/presents/".$row['type'].".png'>
    </div>
    <div class='chore-info'>
      <table>
        <tr>
          <td style='color:#f05768'>Title:</td>
          <td style='width:66.5%'>".$row['p_name']."</td>
         
        </tr>
        <tr>
          <td style='color:#f05768'>Description:</td>
          <td style='width:40%'>".$row['p_description']."</td>
		  <td><a href='".$row['p_link']."' tytle='".$row['p_link']."' target='_blank' style='display:inline; color:#f05768; background-color:#efefef; padding:8px 30px 8px 30px; font-weight:bold; margin-right:50%'>LINK</a></td>
		   <td><input style='display:inline-block; margin-top:-15px; margin-left:3px;    padding: 6px 10px;' type='button' value='BUY' onclick=\"buygift(".$row['presentid'].",".$row['p_score'].",'".$_SESSION['user']."',".$row['score'].");\" ></td>
		</tr>
		   <tr>
          <td style='color:#f05768'>Price:</td>
          <td>".$row['p_score']."</td>
		  
		  </tr>
        <tr>";
         
        $newPresent= $newPresent."          
        </tr>
      </table>
   </div>
</div>                 

                     ";
      echo $newPresent;            
											}
										 
										 
										 }
										 
										 else{
											 echo "<h4 style='text-align:center; padding:5px; border: solid white 3px;'>Your gifts have not received a price from your parents yet.<h4> ";
										 }
						   
						   ?>
						   
						
			   
			   
               
               
             
             
                           <br>
                           <br>
						   </div>
						   
						   <?php
						   
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
} 	

	$permissions = "select permission from users WHERE username ='".$_SESSION['user']."' ";
	$user_permission = $conn->query($permissions);
	$row = $user_permission->fetch_assoc();
	$u_permission = $row['permission'];
						   if($row['permission'] == 1){
							   echo "<h4 style='text-align:center; padding:5px; border: solid white 3px;'>As a parent, you don't have items to buy.</h4>";
						   }
						   ?>
                        </div>
                        <!--  end tab 1-->
            
                        <!--  ------- tab 2 ------- -->
                      <div class="tab-pane fade " id="p2">
               
	

	<?php
														   
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
} 	

	$permissions = "select permission from users WHERE username ='".$_SESSION['user']."' ";
	$user_permission = $conn->query($permissions);
	$row = $user_permission->fetch_assoc();
	$u_permission = $row['permission'];
				
	
			 if($row['permission']==1){
                echo "
                <script>			
                $(document).ready(function(){
                  $('#add_present').hide();
              
                  $('.u_wishlist').hide();
                  $('#h3_u_wishlist').hide();
                });
                </script>
                ";
              }					

	?>	
	
						   
<div class='newChoreTest new-chore' id="add_present">

          <div class="add-chore-icon">
                <div id="chorePicture">
                  <h4>Choose Icon:</h4>
                <center>
                  <div class="row">
                 <label class='col-sm-4'>
                 <input type='radio' value='diamond' name='ptype'>
                <img src="img/presents/diamond.png">
                 </label>
                 <label class='col-sm-4'>
                 <input type='radio' value='dices' name='ptype'>
                <img src="img/presents/dices.png">
                 </label>
                 <label class='col-sm-4'>
                 <input type='radio' value='gamepad' name='ptype'>
                <img src="img/presents/gamepad.png">
                 </label>
                 </div>
                 <div class="row">
                 <label class='col-sm-4'>
                 <input type='radio' value='hanger' name='ptype'>
                <img src="img/presents/hanger.png">
                 </label>
                 <label class='col-sm-4'>
                 <input type='radio' value='sword' name='ptype'>
                <img src="img/presents/sword.png">
                 </label>
                 <label class='col-sm-4'>
                 <input type='radio' value='teddy-bear' name='ptype'>
                <img src="img/presents/teddy-bear.png">    
                 </label>
                 </div>
               </center>
               </div>

          </div>
    <div class='new chore-info'>
      <table>
        <tr>
          <td style='color:#f05768;width:30%'>Present name: </td>
          <td style='width:20%'><input tabindex="1" required type="text" name='presentName'></td>
          <td style='width:10%'></td>
        </tr>
        <tr>
          <td style='color:#f05768;width:30%'>Description</td>
          <td><input tabindex="2" required type="text" name='presentDescription'></td>
        </tr>
        <tr>
          <td style='color:#f05768;width:30%'>Link (optional):</td>
          <td style='width:20%'><input tabindex="3" type="text" name='presentLink'></td>
          <td style='width:27%'></td>
          <td id='newPresentButton' style='text-align:right;width:20%'><button tabindex="4" type="submit" id="addChoreBtn" onclick="addPresent();" value="Add Present">Add Present</button></td>

        </tr>
      </table>
   </div>
	  <hr>
</div>
 


						   <?php
						   
														   
		$q_chores = "SELECT presentid, p_name, p_description, p_username, p_score,p_link,type,fname FROM presents INNER JOIN users ON p_username=username WHERE p_status='0' and familyid=(select familyid from users where username='".$_SESSION['user']."') and p_username='".$_SESSION['user']."'order by presentid DESC";
                $result = $conn->query($q_chores);
							
								if ($result->num_rows > 0) {
									 // output data of each row
									 echo " <h3 id='h3_u_wishlist'> My wishlist: </h3>";
									 while($row = $result->fetch_assoc()) {
										 $newPresent="";
										 $newPresent= $newPresent.
                     "<div class='u_wishlist'>
					
<div class='newPresentTest newChoreTest'>
    <div class='chore-icon'>
      <img src='img/presents/".$row['type'].".png'>
    </div>
    <div class='chore-info'>
      <table>
        <tr>
          <td style='color:#f05768;'>Title:</td>
          <td style='width:30%'>".$row['p_name']."</td>
          <td ><span style='color:#f05768'>Requested by: </span>".$row['p_username']."</td>
        </tr>
        <tr>
          <td style='color:#f05768'>Description:</td>
          <td style='width:40%'>".$row['p_description']."</td>
		  <td><a href='".$row['p_link']."' title='".$row['p_link']."' target='_blank' style='display:inline-block; color:#2fa7e0; background-color:#efefef; padding:4px 10px 4px 10px; font-weight:bold; float:right'>LINK</a>		  
		<td style='margin:4px;'> <input style='display:inline-block; background-color:#efefef; font-weight:bold;color:red' type='button' value='remove' onclick=\"deletegift(".$row['presentid'].");\" ></td>
        </td>
		</tr>
		  
        <tr>
          <td> <span style='color:#f05768'>Price:</span> ";
		    if($row['p_score']=='0')
                         { $newPresent= $newPresent." - </td>";}
                       else{
                        $newPresent= $newPresent." ".$row['p_score']." </td>" ;
                       }
		  
        $newPresent= $newPresent."  
		
        </tr>
      </table>
   </div>
</div> 
                 
</div>                 

                     ";
      echo $newPresent;            
											}
								}
		else{
			 $newPresent="";
				$newPresent= $newPresent.
                     "<div class='u_wishlist'><h3> My wishlist: </h3>
					 <h4 style='text-align:center; padding:5px; border: solid white 3px;'>You don't have gifts requests. Add above the gifts you wish for.<h4> </div>";
					     echo $newPresent;
					 
			
		}								 
										 
										 
						   
						   ?>
	<br>					   
	<hr>					   
   <h3> Family members wishlist: </h3> 
		
<?php
						   
														   
		$q_chores = "SELECT presentid, p_name, p_description, p_username, p_score,p_link,type,fname FROM presents INNER JOIN users ON p_username=username WHERE p_status='0' and familyid=(select familyid from users where username='".$_SESSION['user']."') and not p_username='".$_SESSION['user']."' order by presentid DESC";
                $result = $conn->query($q_chores);
							
								if ($result->num_rows > 0) {
									 // output data of each row
									 while($row = $result->fetch_assoc()) {
										 $newPresent="";
										 $newPresent= $newPresent.
                     "
<div class='newPresentTest newChoreTest'>
    <div class='chore-icon'>
      <img src='img/presents/".$row['type'].".png'>
    </div>
    <div class='chore-info'>
      <table>
        <tr>
          <td style='color:#f05768;'>Title:</td>
          <td style='width:65%'>".$row['p_name']."</td>
          <td ><span style='color:#f05768'>Requested by: </span>".$row['p_username']."</td>
        </tr>
        <tr>
          <td style='color:#f05768;'>Description:</td>
          <td style='width:30%;'>".$row['p_description']."</td>
		  <td style='width:20%'><a href='".$row['p_link']."' title='".$row['p_link']."' target='_blank' style='display:inline; color:#2fa7e0; background-color:#efefef; padding:4px 10px 4px 10px; font-weight:bold; margin-right:10%'>LINK</a>
		  
		</td>
		</tr>
		<tr>
          <td style='color:#f05768'>Price: </td>";
		    if($row['p_score']=='0')
                         { $newPresent= $newPresent."<td> - </td>";}
                       else{
                        $newPresent= $newPresent."<td>".$row['p_score']."</td> " ;
                       }
		  
        $newPresent= $newPresent."          
        </tr>
      </table>
   </div>
</div>                 
 ";
      echo $newPresent;            
			} 
		 }
		 
		 else{
			 echo "<h4 style='text-align:center; padding:5px; border: solid white 3px;'>Your family members didn't insert gifts requests yet. <h4>";
		 }

?>
						   
                    
    
						   
						   
						   
						   
						   
			  
						   
						   
						   
						   
                        </div>
                        <!--  end tab 2-->
						
						
                        <!--  ------- tab 3 ------- -->
                        <div class="tab-pane fade" id="p3">
						
						 <h3>Family memers purchase history:</h3>
            <?php
         
              $g_history = "SELECT p_name, p_description, p_username, p_score,dop FROM presents inner join users on p_username=username WHERE p_status='1' and familyid=(select distinct familyid from users where username='".$_SESSION['user']."' ) order by dop DESC";
              $result = $conn->query($g_history);

              if ($result->num_rows > 0) {
                 echo "<table class='homiesTables' style='font-size:18px;'>     <thead>
                                 <tr class='tableHeaders'>
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
                   echo "<table class='homiesTables' style='font-size:18px;'>     <thead>
                                 <tr class='tableHeaders'>
                                    <th>User name </th>
                                    <th>Present</th>
                                    <th>Price</th>
                                    <th>Date of purchase</th>
                                 </tr>
                              </thead>
                </table>
				
				<h4 style='text-align:center; padding:5px; border: solid white 3px;'>No purchase history<h4>";
              }
            
            ?>
            
            
            
            
                    
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

         
    function addPresent(){
    var presentName= document.getElementsByName("presentName")[0].value;
    var presentDescription= document.getElementsByName("presentDescription")[0].value;
    var presentLink= document.getElementsByName("presentLink")[0].value;         
    var ptype= $('input[name=ptype]:checked').val();
  
  if(ptype == null){
  alert('Please set an icon to your new present');
}
else{
    if( Boolean(presentName && presentDescription && ptype)){
        if(confirm("Add new present to wishlist?")){
        $.post('addpresent.php',   // url
            { presentName: presentName, presentDescription:presentDescription, presentLink:presentLink,ptype:ptype }, // data to be submit
            function(response) {// success callback
              $("body").load('#p2'); 
              alert("Successfully added new present! ");   
          }
        );
      }
    }
      else{
        alert("Please fill all fields. (Set name and description)");
      }
  }
  } 
  
  
  
    function deletegift(pid){         
               var pid = pid;
               
               if(confirm("Delete this gift?")){
                $.post('deletegift.php',   // url
                   { pid: pid}, // data to be submit
                    function(data, status, jqXHR) {// success callback
                      window.location=window.location.href;
                     
                      alert("Gift deleted successfully");
                    
                    }
                );
            }
          }
          </script>
   </body>
</html>