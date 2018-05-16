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
   	
    $q_familyid = "SELECT familyid, permission as u_permission FROM users where username ='".$_SESSION['user']."'";
    $result = $conn->query($q_familyid);
    $row = $result->fetch_assoc();
    $familyid = $row["familyid"];
    $_SESSION['u_permission'] = $row['u_permission'];

    if($_SESSION['u_permission'] == 0){
      echo "<script>
      $(document).ready(function(){
        $('#newChoreBtn').hide();
      });
      </script>";
    }else{
     echo "<script>
      $(document).ready(function(){
        $('.task-box input').hide(); //hide 'assign to me'
        $('#pg2>h1').hide();          //hide h1
      });
      </script>";
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
                 echo "<table class='homiesTables scoreboard' style='width:30%; text-align:center; font-size:17px;' title='Scoreboard'>
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
                   echo "<table class='homiesTables' style='width:50%; text-align:center; font-size:17px;'>
                                    <br>
                                    <thead>
                                     <tr id='tableHeaders'>
                                          
                                            <th>User name</th>
                                            
											<th>Score</th>
                                        </tr>
                                    </thead>
                </table>";
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
		 
         <div class="box">
            <div class="row">
               <div class="hidden-xs voffset6"></div>
               <div class="col-md-12 col-lg-12" panel>
                  <br>
                  <div class="panel-heading" id="syllabus">
                     <div class="tabbable">
					 <span class="moduleHeader">Chores </span>
                        <ul class="nav nav-tabs" id="myTabs">
						
                           <li class="active"><a href="#p1" data-toggle="tab"><strong>available</strong></a></li>
                           <li><a href="#p2" data-toggle="tab"><strong>assigned</strong></a></li>
						   <li><a href="#p3" data-toggle="tab"><strong>done</strong></a></li>
						  
                        </ul>
                     </div>
                  </div>
                  <div class="panel-body">
                     <div class="tab-content">
                        <!--  ------- tab 1 ------- -->
                        <div class="tab-pane fade  in active " id="p1">
                           
						   
						   	<?php
														   
				$permissions = "SELECT distinct permission FROM users WHERE username='".$_SESSION['user']."'";
                $result = $conn->query($permissions);
				$row = $result->fetch_assoc();
				$u_per = $row['permission'];
				
	
			 if($u_per=='0'){
                echo "
                <script>			
                $(document).ready(function(){
                  $(\"#add_chore\").hide();
                });
                </script>
                ";
              }					

	?>
<div class='newChoreTest new-chore' id="add_chore">
          <div class="add-chore-icon">
                <div id="chorePicture">
                  <h4>Choose Icon:</h4>
                <center>
                  <div class="row">
                 <label class='col-sm-4'>
                 <input type='radio' value='broom' name='chore-type'>
                <img src="img/chores/broom.png">
                 </label>
                 <label class='col-sm-4'>
                 <input type='radio' value='homework' name='chore-type'>
                <img src="img/chores/homework.png">
                 </label>
                 <label class='col-sm-4'>
                 <input type='radio' value='washing-machine' name='chore-type'>
                <img src="img/chores/washing-machine.png">
                 </label>
                 </div>
                 <div class="row">
                 <label class='col-sm-4'>
                 <input type='radio' value='bucket' name='chore-type'>
                <img src="img/chores/bucket.png">
                 </label>
                 <label class='col-sm-4'>
                 <input type='radio' value='spray' name='chore-type'>
                <img src="img/chores/spray.png">
                 </label>
                 <label class='col-sm-4'>
                 <input type='radio' value='dish-soap' name='chore-type'>
                <img src="img/chores/dish-soap.png">    
                 </label>
                 </div>
               </center>
               </div>

         </div> 
    <div class='chore-info'>
      <table>
        <tr>
          <td style='color:#f05768;width:20%'>Chore Title: </td>
          <td style='width:50%'><input tabindex="1" required type="text" name='choreName'></td>
          <td style='width:20%'></td>
        </tr>
        <tr>
          <td style='color:#f05768;width:20%'>Description</td>
          <td style='width:50%'><input tabindex="2" required type="text" name='choreDescription'></td>
          <td style='width:20%'><button tabindex="4" id="addChoreBtn" onclick="addChore();" value="Add Chore">Add Chore</button></td>
         

		 <script>
    function addChore(){
    var choreName= document.getElementsByName("choreName")[0].value;
    var choreDescription= document.getElementsByName("choreDescription")[0].value;
    var choreScore= document.getElementsByName("choreScore")[0].value;         
    var chore_type= $( 'input[name=chore-type]:checked' ).val();
	
	
if(choreScore<0){
	alert('Chore score can be positive only.');
}
else if(!chore_type){
	alert('Please set an icon to your new chore');
}
else{
    if( Boolean(choreName && choreDescription && choreScore)){
        if(confirm("Add new chore?")){
        $.post('addchore.php',   // url
            { choreName: choreName, choreDescription:choreDescription, choreScore:choreScore,chore_type:chore_type }, // data to be submit
            function(response) {// success callback
              // window.location = window.location.href;
              alert("Successfully added chore");
              $("body").load("#p1");
            }
        );
      }
    }
      else{
        alert("Please fill all fields. (Set name, description and score)");
      }
  }
	}
	
	/*INT to MONEY ?????===============================
	
	function toDecimal(){
		alert('hiiii');
	var num = document.getElementById("numToMoney").value;
	num.toLocaleString();
	document.getElementById("numToMoney").innerHTML = num;
	}*/
          </script>
        </tr>
        <tr>
          <td style='color:#f05768;width:20%'>Score:</td>
          <td style='width:50%'><input tabindex="3" type="number" min="0" title='Only Number' name='choreScore'></td>
          <td style='width:20%'></td>
        </tr>
      </table>
   </div>
</div>

   <hr>



						   <?php
						   
														   
								$q_chores = "SELECT choreid, c_title, c_description, c_score, c_username, is_available, type FROM chores WHERE is_available ='1' and familyid=(SELECT distinct familyid from users WHERE username= '".$_SESSION['user']."') ORDER BY choreid DESC ";
								$result = $conn->query($q_chores);
								$permission="select distinct permission from users where username='".$_SESSION['user']."'";
								$user_permission = $conn->query($permission);
								
								
								$row = $user_permission->fetch_assoc();
								$u_permission = $row['permission'];
								
								if ($result->num_rows > 0) {
									 // output data of each row
									 while($row = $result->fetch_assoc()) {
										 $newChore="";
										 $newChore= $newChore.
                     "
<div class='newChoreTest'>
    <div class='chore-icon'>
      <img src='img/chores/".$row['type'].".png'>
    </div>
    <div class='chore-info'>
      <table>
        <tr>
          <td style='color:#f05768'>Title:</td>
          <td>".$row['c_title']."</td>
          <td></td>
        </tr>
        <tr>
          <td style='color:#f05768'>Description</td>
          <td style='width:60%'>".$row['c_description']."</td>";
		  if($u_permission=='0'){
           $newChore= $newChore."<td style='width:20%'><input type='button' value='assign to me' onclick=\"assignchore(".$row['choreid'].",'".$_SESSION['user']."',1);\" >
		  </td>";}
		  else{
			   $newChore= $newChore."<td style='width:20%'><input type='button' value='delete chore' onclick=\"deletechore(".$row['choreid'].");\" >
		  </td>";
		  }
      $newChore= $newChore."</tr>
        <tr>
          <td style='color:#f05768'>Score:</td>
          <td>".$row['c_score']."</td>
          <td></td>
        </tr>
      </table>
   </div>
</div>                     

                     ";
      echo $newChore;            
											}
										 
										 
										 }
						   
						   ?>
						   
						   
                           <!--<div id="newChores"></div> -->
						   
<script>

</script>

						<br>
                        </div>
                        <!--  end tab 1-->
                        <!--  ------- tab 2 ------- -->
                        <div class="tab-pane fade " id="p2">
                           <div id="pg2">
                           <h2>My assigned chores:</h2>   

						   
				   <?php

						   
	$my_to_do = "SELECT choreid, c_title, c_description, c_score, c_username, is_available, c_status, type FROM chores WHERE c_username= '".$_SESSION['user']."' AND c_status='0'";
	$result = $conn->query($my_to_do);


if ($result->num_rows > 0) {
	 // output data of each row
	 while($row = $result->fetch_assoc()) {
		 $myToDo="";
		 $myToDo= $myToDo.
"
<div class='myToDoTest'>
    <div class='chore-icon'>
      <img src='img/chores/".$row['type'].".png'>
    </div>
    <div class='chore-info'>
      <table>
        <tr>
          <td style='color:#f05768'>Title:</td>
          <td>".$row['c_title']."</td>
          <td></td>
        </tr>
        <tr>
          <td style='color:#f05768'>Description</td>
          <td style='width:60%'>".$row['c_description']."</td>
		  <td style='width:20%'><input type='button' value='done' onclick=\"donechore(".$row['choreid'].",".$row['c_score'].",'".$_SESSION['user']."');\" >&nbsp;&nbsp;
		  <input type='button' value='return' onclick=\"assignchore(".$row['choreid'].",'".$_SESSION['user']."',0);\" >
		  </td>
		 </tr>
        <tr>
          <td style='color:#f05768'>Score:</td>
          <td id='numToMoney'>".$row['c_score']."</td>
          <td> </td>
        </tr>
      </table>
   </div>
</div>  
<br>    ";

      echo $myToDo;            
											}
										 
										 
										 }
					else{
								echo"<p class='empty_data'>You didn't assigned yourself to any chore, to do so - navigate to 'available' tab and pick some chores. </p>";
							}
										 
						   
						   ?>
						   
		<br><h2>My siblings assigned chores:</h2>
				   
				   <?php

						   
		$sibilingsTodo = "SELECT choreid, familyid, c_title, c_description, c_score, type, c_username, is_available, c_status FROM chores
								WHERE is_available='0' and familyid=(select distinct familyid from chores where familyid=(select distinct familyid from users where username= '". $_SESSION['user'] ."')) and not c_username = '". $_SESSION['user'] ."'";
								
								$result = $conn->query($sibilingsTodo);


if ($result->num_rows > 0) {
	 // output data of each row
	 while($row = $result->fetch_assoc()) {
		 $myToDo="";
		 $myToDo= $myToDo.
"
<div class='myToDoTest'>
    <div class='chore-icon'>
      <img src='img/chores/".$row['type'].".png'>
    </div>
    <div class='chore-info'>
      <table>
        <tr>
          <td style='color:#f05768'>Title:</td>
          <td>".$row['c_title']."</td>
          <td></td>
        </tr>
        <tr>
          <td style='color:#f05768'>Description</td>
          <td style='width:60%'>".$row['c_description']."</td>
		  <td style='width:20%;'> Assignee: <span style='color:#f05768; font-weight:bold;'>".$row['c_username']." </spen></td>
		  
		 </tr>
        <tr>
          <td style='color:#f05768'>Score:</td>
          <td style='width:50%'>".$row['c_score']."</td>
          
        </tr>
		
      </table>
   </div>
</div>  
<br>    ";

      echo $myToDo;            
											}
										 
										 
										 }
					else{
								echo"<h2>Your siblings didn't assigned themselves to any chore </h2>";
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
						

   <?php

	$done_chores = "SELECT choreid,familyid, c_title, c_description, c_score, c_username,type, is_available, c_status, doneDate FROM chores
								WHERE c_status='1' and familyid=(select distinct familyid from chores where familyid=(select distinct familyid from users where username= '". $_SESSION['user'] ."')) order by doneDate DESC";
								
								$result = $conn->query($done_chores);


if ($result->num_rows > 0) {
	 // output data of each row
	 while($row = $result->fetch_assoc()) {
		 $originalDate = $row['doneDate'];
     $newDate = date("d/m/h", strtotime($originalDate));
     $myToDo="";
		 $myToDo= $myToDo.
"
<div class='myToDoTest'>
    <div class='chore-icon'>
      <img src='img/chores/".$row['type'].".png'>
    </div>
    <div class='chore-info'>
      <table>
        <tr>
          <td style='color:#f05768'>Title:</td>
          <td>".$row['c_title']."</td>
          <td></td>
        </tr>
        <tr>
          <td style='color:#f05768'>Description</td>
          <td style='width:60%'>".$row['c_description']."</td>
		  <td style='width:20%;'> done by: <span style='color:#f05768; font-weight:bold;'> ".$row['c_username']." </spen></td>
		  
		 </tr>
        <tr>
          <td style='color:#f05768'>Score:</td>
          <td style='width:64.5%'>".$row['c_score']."</td>
           <td style='width:20%;'> on: <span style='color:#f05768; font-weight:bold;'> ".$newDate." </spen></td>
        </tr>
		
      </table>
   </div>
</div>  
<br>    ";

      echo $myToDo;            
											}
										 
										 
										 }
					else{
								echo"<h2>Any of your family members had done to any chore </h2>";
							}
										 
						   
						   ?>						   
					
            </div>
		</div>	 
                        

			
			<!-- end of tab 3 -->

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
							if(confirm("Mark this chore as DONE?")){
							$.post('doneChore.php',   // url
									{ cid: cid, score:score, user:user }, // data to be submit
									function(data, status, jqXHR) {// success callback
                    window.location = window.location.href;
									  alert("Successfully marked this chore as done");
									}
							);
						}
						}
		   </script>


		   <script>
						function assignchore(cid,user,doneOrBacktoqueue){					
						   var cid = cid;
						   var user = user;
						   var doneOrBacktoqueue=doneOrBacktoqueue;
						   if(doneOrBacktoqueue=='1'){
						   if(confirm("Assign this chore to you?")){
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
						   }
						   else if(doneOrBacktoqueue=='0'){
							    if(confirm("Return this chore to availiable chores?")){
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
						   }
						}
						
						
					function deletechore(cid){					
						   var cid = cid;
						   
						   if(confirm("Delete this chore?")){
							  $.post('deletechore.php',   // url
									 { cid: cid}, // data to be submit
										function(data, status, jqXHR) {// success callback
										  window.location=window.location.href;
										 
										  alert("Chore deleted successfully");
									  
										}
								);
						}
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