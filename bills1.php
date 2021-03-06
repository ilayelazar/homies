<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Homie - Homepage</title>
      <link href="https://fonts.googleapis.com/css?family=Heebo" rel="stylesheet">
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <!-- Latest compiled JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
      <script type="text/javascript" src="script/paging.js"></script>
      <script type="text/javascript" src="script/script.js"></script>
      <script type="text/javascript" src="script/multi_pagination.js"></script>
      <script type="text/javascript"  src="script/billsAjax.js"></script>
      <script type="text/javascript"  src="script/bills.js"></script>

      <!-- Excel Plugin-->
      <script type="text/javascript" src="script/jquery.table2excel.js"></script>
      <link href="https://fonts.googleapis.com/css?family=Mina:700" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
      <link rel="stylesheet" type="text/css" href="css/bills.css">
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
         <span style="color:white;font-size:50px;cursor:pointer" class="burger-btn">&#9776;
         </span>
         <a href="homepage.php">Homepage</a>
         <a href="chores.php">Chores</a>
         <a href="gifts.php">Gifts</a>
         <a href="shoppinglist.php">Shopping</a>
         <a href="calendar.php">Calendar</a>
         <a href="bills.php">Bills</a>      
      
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
         <div class="panel-heading" id="syllabus">
            <div class="tabbable">
               <ul class="nav nav-tabs" id="myTabs">
                  <li class="active"><a href="#p1" data-toggle="tab"><strong>Add bill</strong></a></li>
                  <li><a href="#p2" data-toggle="tab"><strong>Bills Report</strong></a></li>
               </ul>
            </div>
         </div>
         <div class="panel-body">
         <div class="tab-content">
            <!--  ------- tab 1 ------- -->
            <div class="tab-pane fade in active" id="p1">
               <div id="pg1">
                  <div class="payments" align=center>
                     <h3>Add your payments here</h3>
                     <br>
                     <div id="wrraper">
                        <div class="row">
                           <div class="col-md-12">
                              <table id="pay_bills" class="cell-border row-border hover order-column">
                                 <thead>
                                    <tr id="tableHeaders">
                                       <th>Date Added </th>
                                       <th>Type</th>
                                       <th>Sum(NIS)</th>
                                       <th>Due date</th>
                                       <th>Comments</th>
                                       <th class="no-sort"></th>
                                       <th class="no-sort"></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="col-md-10 dataTables_wrapper not print pagination-style">
                           <div id="main-pagination" class="dataTables_paginate paging_simple_numbers">
                           </div>
                        </div>
                        <div id="count-record" class="col-md-3 not-print">
                           <span id="initial-display">Displayed</span> <span id="from-record"></span> - <span id="to-record"></span> of <span id="total-records"></span>
                        </div>
                        <div id="pagination">
                        </div>
                        <div id="pagination1">
                        </div>
                        <div id="pagination2">
                        </div>
                     </div>
                     <div class="functional_buttons">
                     <button type="button" id="addRow" class="btn btn-secondary">Add</button>
                     <button type="button" id="saveAllBills" class="btn btn-secondary">save</button>
                   </div>
                  </div>
               </div>
            </div>
            <!--  end tab 1-->
            <!--  ------- tab 2 ------- -->
            <div class="tab-pane fade " id="p2">
               <div id="pg2">
                  <div class=row>
                     <div class="col-md-3"></div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label>   </label>
                           <select class="form-control">
                              <option> Month</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label>   </label>
                           <select class="form-control">
                              <option> Type</option>
                           </select>
                        </div>
                     </div>
                        <div class="col-md-3">
                        <div class="form-group">
                           <label>   </label>
                           <select class="form-control">
                              <option> Payed</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <table id="pay_report" class="cell-border row-border hover order-column">
                     <thead>
                        <tr id="tableHeaders">
                           <th>Date Paid</th>
                           <th>Type</th>
                           <th>Total(NIS)</th>
                           <th>Paid By</th>
                        </tr>
                     </thead>
                     <tbody id="report-body">
                        <tr>
                           <td>12/03</td>
                           <td>Gas</td>
                           <td>24</td>
                           <td>Nadia</td>
                        </tr>
                        <tr>
                           <td>12/03</td>
                           <td>Phone</td>
                           <td>100</td>
                           <td>Noy</td>
                        </tr>
                     </tbody>
                     <tfoot>
                        <tr>
                           <th>Date Paid</th>
                           <th>Type</th>
                           <th>Total</th>
                           <th>Paid By</th>
                        </tr>
                     </tfoot>
                  </table>
                  <button id="export">Export</button>
               </div>
            </div>
            <!--  end tab 2-->
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
