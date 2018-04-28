<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" href="img/family-logo.png">
      <title>Homies - Calendar</title>
      <link href="https://fonts.googleapis.com/css?family=Heebo" rel="stylesheet">
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <!-- Latest compiled JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
      <link rel="stylesheet" type="text/css" href="css/calendar.css">
      <link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css">
      <script src="script/script.js"></script>
      <script src="script/jquery.timepicker.js"></script>

      <link href="https://fonts.googleapis.com/css?family=Mina:700" rel="stylesheet">
      <!--Date Picker -->
      <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.css">
      <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
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
                                                   <button type="submit" class="btn btn-success btn-block">Login</button>
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
         <span style="color:white;font-size:50px;cursor:pointer" class="burger-btn">&#9776;
         </span>
         <a href="homepage.php">Homepage</a>
         <a href="chores.php">Chores</a>
         <a href="gifts.php">Gifts</a>
         <a href="shoppinglist.php">Shopping</a>
         <a href="calendar.php">Calendar</a>      
         <a href="bills.php">Bills</a>      

      </div>
<?php
if(isset($_POST['newNote'])){
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
               //Generate note id by current max (id+1)
                $max_noteid = "SELECT COALESCE(max(noteid) ,0) as max FROM notes";
                $res = $conn->query($max_noteid);
                $row = $res->fetch_assoc();
                $n_id = $row["max"];
                $n_id = $n_id + 1;
                  //insert query
          //$q_insertNote = "INSERT INTO notes (`noteid`, `n_creator`, `text`, `familyid`, `note_title`, `note_date`) VALUES (".$n_id.",'".$_SESSION['user']."','".$_POST['newNote']."',1,'".$_POST['note_title']."','2018-04-25')";

           $q_insertNote = "INSERT INTO notes (`noteid`, `n_creator`, `text`, `familyid`, `note_title`, `note_date`) VALUES (".$n_id.",'".$_SESSION['user']."','".$_POST['newNote']."',(SELECT familyid FROM users WHERE username='".$_SESSION['user']."'),'".$_POST['note_title']."',now())";;
          $conn->query($q_insertNote);

        }

?>

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
         <div class="box cal">
            <iframe id="google-cal" src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;height=600&amp;wkst=1&amp;bgcolor=%239999ff&amp;src=ggjruj0qp00c93aceda7v2j72o%40group.calendar.google.com&amp;color=%23AB8B00&amp;ctz=Asia%2FJerusalem" style="border-width:0" width="100%" height="600" frameborder="1" scrolling="no"></iframe>
         </div>
         <center><div class="form box">
            <img src="img/green-plus.png" alt="" width="35px" id="newEventBtn">
            <div class="addEvent">
               <hr>
               <form action="#" method="POST">
                  <table>
                     <tr>
                        <td>Start Date:</td>
                        <td>
                           <div id="sandbox-container">
                              <input type="text" name="start_date" class="form-control">
                           </div>
                        </td>
                     </tr>
                      <tr>
                        <td>End Date:</td>
                        <td>
                           <div id="sandbox-container">
                              <input type="text" name="end_date" class="form-control">
                           </div>
                        </td>
                     </tr>
                     <tr>
                        <td>Title:</td>
                        <td><input type="text" name="summary"></td>
                     </tr>
                     <tr>
                        <td>Location:</td>
                        <td><input type="text" name="location"></td>
                     </tr>
                     <tr>
                        <td>Start Time:</td>
                        <td>
                          <input type="text" class="timepicker-e" name="start-time" data-time-format="H:i" data-step="15" data-min-time="06:00" data-max-time="05:00" data-show-2400="true"/>
                        </td>
                     </tr>
                     <tr>
                        <td>End Time:</td>
                        <td>
                          <input type="text" class="timepicker-e" name="end-time" data-time-format="H:i" data-step="15" data-min-time="06:00" data-max-time="05:00" data-show-2400="true"/>
                        </td>
                     </tr>
                     <tr>
                        <td>Description:</td>
                        <td> <input type="text" name="description"></td>
                     </tr>
                         <button id="authorize-button" style="display: none;">Sign in to create event! <br><img src="https://i.stack.imgur.com/xAiqi.png" width=200px></button>
                   

                    <script> 
                    $(function(){
                       $('.timepicker-e').timepicker(); 
                    });
                    </script>
    <pre id="content"></pre>

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
        var pre = document.getElementById('content');
        var textContent = document.createTextNode(message + '\n');
        pre.appendChild(textContent);
      }

      /**
       * Print the summary and start datetime/date of the next ten events in
       * the authorized user's calendar. If no events are found an
       * appropriate message is printed.
       */
function insertEvent() {

  var event = 
  {
    'summary': document.getElementsByName('summary')[0].value,
    'location':  document.getElementsByName('location')[0].value,
    'description':  document.getElementsByName('description')[0].value,
    'start': {
      'dateTime': document.getElementsByName('start_date')[0].value +"T"+ document.getElementsByName('start-time')[0].value + ":00",
      'timeZone': "Asia/Jerusalem"
    },
    'end': {
      'dateTime': document.getElementsByName('end_date')[0].value +"T"+ document.getElementsByName('end-time')[0].value+ ":00",
      'timeZone': "Asia/Jerusalem"
    }
  };

  var request = gapi.client.calendar.events.insert({
    'calendarId': 'ggjruj0qp00c93aceda7v2j72o@group.calendar.google.com',
    'resource': event
  });

  request.execute(function(event) {
    appendPre('Event created!');
    alert('New event created on: \n'+ document.getElementsByName('start_date')[0].value +'\n'+ document.getElementsByName('start-time')[0].value)
  });


}

    </script>



    <script async defer src="https://apis.google.com/js/api.js"
      onload="this.onload=function(){};handleClientLoad()"
      onreadystatechange="if (this.readyState === 'complete') this.onload()">
    </script>
                     </tr>
                  </table>
               </form>
               <button id="addEventBtn" onclick="insertEvent();"> Add Event</button>
                <input type="reset" style="background-color: pink;font-style: initial;"></td>
            </div>
         </div>
      </center>
         <script>
            $('#sandbox-container input').datepicker({
            
            	format:'yyyy-mm-dd',
            
                autoclose: true
            
            });
            
            
            
            $('#sandbox-container input').on('show', function(e){
            
                console.debug('show', e.date, $(this).data('stickyDate'));
            
                
            
                if ( e.date ) {
            
                     $(this).data('stickyDate', e.date);
            
                }
            
                else {
            
                     $(this).data('stickyDate', null);
            
                }
            
            });
            
            
            
            $('#sandbox-container input').on('hide', function(e){
            
                console.debug('hide', e.date, $(this).data('stickyDate'));
            
                var stickyDate = $(this).data('stickyDate');
            
                
            
                if ( !e.date && stickyDate ) {
            
                    console.debug('restore stickyDate', stickyDate);
            
                    $(this).datepicker('setDate', stickyDate);
            
                    $(this).data('stickyDate', null);
            
                }
            
            });
              
         </script>
         <div class="result"></div>
         <div class="box" id="notes-area">
            <div class="notesHeader">
               <h1 style="display:inline-block;">Group notes</h1>
               <div class="box newNote" style="width:initial;"><img src="img/new-note.png" alt="" id="newNoteImg" width=50px>
                  <div id="newNoteContent">
                    <form action="calendar.php" method="POST">
                    <label style="float:left"><strong>Title:</strong><input name="note_title" style="margin:10px; width:60%"></label>
                    <textarea rows="3" name="newNote"></textarea>
                    <button id="addNoteBtn">Add</button>
                    </form>
                  </div>
               </div>
            </div>
            <div class="note">
               <div class="note-data">
                  <span id="note-name">NAME_NAME</span>
                  <span id="note-date">DD/MM/YYYY</span>
               </div>
               <p>

               </p>
            </div>
          <?php
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
            $q_notes = "SELECT noteid, n_creator, text, familyid, note_title ,note_date FROM notes WHERE familyid=(SELECT familyid FROM users WHERE username='".$_SESSION['user']."')";
                $result = $conn->query($q_notes);
                if ($result->num_rows > 0) {
                   // output data of each row
                   while($row = $result->fetch_assoc()) {
                     $newNote="";
                     $newNote= $newNote."
                      <div class='note'>
                         <div class='note-data'>
                            <span id='note-name'> <i><u> Created by: ".$row['n_creator']."</u></i>
                          </span>
                            <span id='note-date'>".$row['note_date']."</span>
                         </div>
                        <strong><u>".$row['note_title']."</u></strong><br>                         
                         <p>
                        ".$row['text']."
                         </p>
                      </div>";
                  echo $newNote;
                      } 
                  }

                ?>
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
   </body>
</html>