<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" href="img/family-logo.png">
      <title>Homies - Homepage</title>

          <!-- FONTS -->
      <link href="https://fonts.googleapis.com/css?family=Heebo" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <!-- Latest compiled JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="script/script.js"></script>
      <script src="script/group.js"></script>
      <script src="script/newcalendar.js"></script>
      <link href="https://fonts.googleapis.com/css?family=Mina:700" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
      <link rel="stylesheet" type="text/css" href="css/homepage.css">   
    <style>
      #join-family-form,#create-family-form{
        display:none;
      }
      .grp-buttons{
        display: inline-block;
        margin:2%;
        width:45%;
        height: 50px;
        background-color:rgba(33,183,212,0.9);
        font-size: 16px;
        font-weight: bold;
        outline:0;
        font-family: 'Ubuntu', sans-serif;
        border-radius: 10px;
        letter-spacing: 2px;
      }
    </style>
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
                    <a class="navbar-brand" href="#">Homies</a>
                 </div>
                 <!-- Collect the nav links, forms, and other content for toggling -->
                 <div id="welcome-user"></div>
              </nav>
               </div>
            </div>
         </div>
      </header>
      <main>
         <div class="box">
            <h1 style="color:white;">Welcome to Homies!</h1>
              <center>
                   
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
                    //get permission for user
          $q_permission = "SELECT fname ,permission FROM users where username ='".$_SESSION['user']."'";
          $result = $conn->query($q_permission);
          $row = $result->fetch_assoc();
          $permission = $row["permission"];
            $msg="<div class='box'>
                <button class='grp-buttons' id='join-family-btn'>Join a family</button>  
                <button class='grp-buttons' id='create-family-btn'>Create new family group!</button>
                  <br>
                  <div id='join-family-form'>
                      <form method='GET' action='creategroup.php'>
                        <label>Search family: <input type='text' placeholder='search for username...' name='search-username'></label>
                        <input type='submit' value='search'>
                      </form>                         
                  </div>
                          <div id='create-family-form'>
                      <h3>New Family Calendar:</h3>
                       <button id='authorize-button'>1. Log in with Google to create new family group</button><br><br>
                         <label style='display:none'>Choose a nickname for your family:<br>
                            <input type='text' id='familyname'></label>
                         <br>
                         <a href='#instructions'>
                         <button onclick='newCalendar();'>
                          2.Create new family calendar
                         </button></a>  
							
							                <div id='instructions' style='width:80%;display:none'>
                  	<span style='color:red; font-size: 28px'><u>important!</u></span>
                  <h1>Make your new calendar public for your family!</h1>

                  <ol>
                    <li>
                      <strong>Enter the following link: <a style='font-size:18px' href='https://calendar.google.com'>https://calendar.google.com</a></strong>
                    </li>
                    <li>
                      Enter 'Settings and sharing' for the new calendar you created.
                      <img src='img/public-calendar/1.png' height=300px>
                    </li>
                    <li>
                      Tick 'Make available to public' so you're family members can also see this calendar.
                      <img src='img/public-calendar/2.png' height=200px>
                    </li>
                  </ol>
                </div>
                           </div>

                        </div>
                        ";
                          echo $msg;
                          echo "
                          <script> console.log('password match'); 
                          $(document).ready(function(){
                          $('.navbar-nav').css('display','none');
                          document.getElementById('welcome-user').innerHTML ='Welcome, ".$_SESSION['user']."<form action=\'logout.php\' method=\'post\'><input type=\'submit\' value=\'Logout\'></form>';
                          });
                          </script>
                      ";     
            $_SESSION['familyid'] = $row['familyid'];      
                          if($permission == '0'){
                            echo "
                            <script> 
                            $(document).ready(function(){
                                $('#create-family-btn').css('display','none');
                                }); 
                            </script>";
                          }
                          if(isset($_GET['search-username'])){
                          $q_family = "SELECT DISTINCT familyid, fname, lname, username, family.name, permission
                                        FROM users INNER JOIN family using(familyid)
                                        WHERE username LIKE '%" . $_GET['search-username'] ."%' ";
                                        $result = $conn->query($q_family);
                echo '<strong>Search results for \''.$_GET['search-username'].'\'... </strong><br>';

              if ($result->num_rows > 0){
                 // output data of each row
                 while($row = $result->fetch_assoc()) {
                   $s_result=$s_result. "
                    <div style='border:1px solid black;width:32%; padding:1%;margin:1%;display:inline-block; background-color:white;' class='family-circle'>
                      <h4> #". $row['familyid'] ."<br>Full name: ".$row['fname']." ".$row['lname']."<br>user: ".$row['username']." <br>Family name:".$row['name'] . " </h4>
                      <button onclick='joinFamily(".$row['familyid'].");'> JOIN Group </button>
                    </div>
                   ";
                 }
              }
            echo $s_result;   
           }
?>

                   
  
    <script type="text/javascript">
     // Client ID and API key from the Developer Console
      var CLIENT_ID = '98238606757-gqp64sm8unfdb4v5a46p9ddsgf8cms46.apps.googleusercontent.com';
      var API_KEY = 'AIzaSyDFS0JGmEHNOod0raa53D6d4KEK19cT4VE';

      // Array of API discovery doc URLs for APIs used by the quickstart
      var DISCOVERY_DOCS = ["https://www.googleapis.com/discovery/v1/apis/calendar/v3/rest"];

      // Authorization scopes required by the API; multiple scopes can be
      // included, separated by spaces.
      var SCOPES = "https://www.googleapis.com/auth/calendar";

      var authorizeButton = document.getElementById('authorize-button');
      

      /**
       *  On load, called to load the auth2 library and API client library.
       */
      function handleClientLoad() {
        gapi.load('client:auth2', initClient);
      }

      /**
       *  Initializes the API client library and sets up sign-in state
       *  listeners.
       */
      function initClient() {
        gapi.client.init({
          apiKey: API_KEY,
          clientId: CLIENT_ID,
          discoveryDocs: DISCOVERY_DOCS,
          scope: SCOPES
        }).then(function () {
          // Listen for sign-in state changes.
          gapi.auth2.getAuthInstance().isSignedIn.listen(updateSigninStatus);

          // Handle the initial sign-in state.
          updateSigninStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
          authorizeButton.onclick = handleAuthClick;
        });
      }

      /**
       *  Called when the signed in status changes, to update the UI
       *  appropriately. After a sign-in, the API is called.
       */
      function updateSigninStatus(isSignedIn) {
        if (!isSignedIn) {
          authorizeButton.style.display = 'block';
        }
        else{
         authorizeButton.style.display = 'none'; 
         $("#create-family-form label").show();
        }
      }

      /**
       *  Sign in the user upon button click.
       */
      function handleAuthClick(event) {
        gapi.auth2.getAuthInstance().signIn();
      }

      
      

      /**
       * Append a pre element to the body containing the given message
       * as its text node. Used to display the results of the API call.
       *
       * @param {string} message Text to be placed in pre element.
       */
      function appendPre(message) {
        var textContent = document.createTextNode(message + '\n');
        pre.appendChild(textContent);
      }
function newCalendar() {
    var familyname = document.getElementById("familyname").value;
    var request = gapi.client.calendar.calendars.insert({
      "resource" :
            {"summary": familyname}
    });
    request.execute(function(calendar){
    	alert(calendar.id); //
      var name = calendar.summary;
    	var calid = calendar.id;
    	 
       $.post('createcalendar.php',   // url
            { calendarid:calid ,
              name: name}, // data to be submit
            function(response) {// success callback
              alert(response);
              	$("#instructions").slideDown();
            }
        );          
    });
}

</script>

<script async defer src="https://apis.google.com/js/api.js"
      onload="this.onload=function(){};handleClientLoad()"
      onreadystatechange="if (this.readyState === 'complete') this.onload()">
</script>


            </center>
         </div>
      </main>
      <script>
          function joinFamily(familyid){
                $.post('joingroup.php',   // url
                          { familyid:familyid }, // data to be submit
                          function(data, status, jqXHR) {// success callback
                            window.location='creategroup.php';
                            alert("Your join request has been sent, Please wait until your parent approves your request.");
                          }
                      );          
              }

      </script>


      <!-- Calendar API - create new event -->
     
   </body>
</html>