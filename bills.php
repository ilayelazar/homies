<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Homie - Bills</title>
      <link href="https://fonts.googleapis.com/css?family=Mina:700" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Heebo" rel="stylesheet">
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
      <link rel="icon" href="img/family-logo.png">


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
      <!-- datepicker Plugin-->
      <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
      <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.css">
      <!-- dolar-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <!-- data table responsive-->
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css">
      <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>


    
      <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
      <link rel="stylesheet" type="text/css" href="css/bills.css">


   </head>
   <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->
   <body>

<!-- VALIDATE PERMISSION - IF(child)-> redirect to warning page -->
<?php
  session_start();
  if($_SESSION['permission'] == 0){
    echo "<script> alert(".$_SESSION['permission'].");window.location = 'myprofile.php'; </script>";
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
                      
                    <a class="navbar-brand" href="homepage.php">Homies<span class="dot"></span></a>
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
        
         <div class="box" style="width:75%">
         <div class="panel-heading tabs" id="syllabus">
            <div class="tabbable">
               <ul class="nav nav-tabs" id="myTabs">
                   <span class="moduleHeader">Bills </span>
                  <li class="active"><a href="#p1" data-toggle="tab"><strong>Add bill</strong></a></li>
                  <li><a href="#p2" data-toggle="tab"><strong>Bills History</strong></a></li>
               </ul>
            </div>
         </div>
         <div class="panel-body">
         <div class="tab-content">
            <!--  ------- tab 1 ------- -->
            <div class="tab-pane fade in active" id="p1">
               <div id="pg1">
                  <div class="payments" align=center>
                     <h4> *you can add here your new payments. only <b>unpaid payments  </b> will be shown. paid payments will be shown in bills history.</h4>
                     <br>
                     <div class="functional_buttons">
                     <button type="button" id="addRow" class="btn btn-info">Add</button>
                     <button type="button" id="saveAllBills" class="btn btn-info"><b>Save</b></button>
                   </div>
                     <div id="wrraper">
                        <div class="row">
                           <div class="col-md-12">
                              <table id="pay_bills" class="cell-border row-border hover">
                                 <thead>
                                    <tr class="tableHeaders">
                                       <th class="date">Date Added </th>
                                       <th class="type">Type</th>
                                       <th class="sum">Total</th>
                                       <th class="due_d">Due date</th>
                                       <th class="comments">Comments</th>
                                       <th class="no-sort"></th>
                                       <th class="no-sort"></th>
                                    </tr>
                                 </thead>
                                 <tbody>
<?php
//                session_start();
//             //--------dblogin---------
//         $servername = "zebra.mtacloud.co.il";
//         $username = "ilayel";
//         $password = "homies123";
//         $dbname = "ilayel_homies";

//         // Create connection
//         $conn = new mysqli($servername, $username, $password, $dbname);
//         // Check connection
//         if ($conn->connect_error) {
//              die("Connection failed: " . $conn->connect_error);
//           echo "<script>console.log('DB Connection failed');</script>";
            
//         } 
//         else{
//           echo "<script>console.log('DB Connection succeded');</script>";
//         }
        

// $select_sql="SELECT familyid FROM `users` WHERE `username`='".$_SESSION["user"]."'";   
// //  $familyid=$mysqli->executeSQL($conn,$select_sql);
// $result = $conn->query($select_sql);
// $row = $result->fetch_assoc();
// $familyid= $row['familyid'];

// $q_bills = "SELECT * from bills where b_status='0' AND group_id='".$familyid."'";
// $result = $conn->query($q_bills);
// $msg = '';

// if ($result->num_rows > 0) {
//     while($row = $result->fetch_assoc()){
//     $msg= $msg . "<tr rolw='row'>";
//       $msg = $msg. "<td> ".$row['date_added']."</td>";
//       $msg = $msg. "<td> ".$row['type']."</td>";
//       $msg = $msg. "<td> ".$row['amount']."</td>";
//       $msg = $msg. "<td> ".$row['due_date']."</td>";
//       $msg = $msg. "<td> ".$row['comments']."</td>";
//     $msg = $msg. "</tr>";
//     echo $msg;
//     }
// }

// echo "<tr> <td> test</td> </tr>";
?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="col-md-3 dataTables_wrapper not print pagination-style">
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
                  </div>
               </div>
            </div>
            <!--  end tab 1-->
            <!--  ------- tab 2 ------- -->
            <div class="tab-pane fade " id="p2">
               <div id="pg2">
                  <div class=row>
                    <div class="col-md-3">
                        <div class="form-group">
                           <label>   </label>
                           <select  id="bill_his_month" class="form-control">
                             <option value="All"> All</option>
                             <option value="1"> January</option>
                             <option value="2"> February</option>
                             <option value="3"> March</option>
                             <option value="4"> April</option>
                             <option value="5"> May</option>
                             <option value="6"> June</option>
                             <option value="7"> July </option>
                             <option value="8"> August</option>
                             <option value="9"> September</option>
                             <option value="10"> October</option>
                             <option value="11"> November</option>
                             <option value="12"> December</option>
                           </select>
                        </div>
                     </div>

                     <div class="col-md-2">
                          <div class="form-group">
                           <label>   </label>
                           <select  id="bill_his_year" class="form-control">
                            <option value="All"> All</option>
                            <option value="<?php echo date('Y',strtotime("+1 year")); ?>"> <?php echo date('Y',strtotime("+1 year")); ?></option>
                             <option value="<?php echo date('Y'); ?>" selected="selected"> <?php echo date('Y'); ?></option>
                             <option value="<?php echo date('Y',strtotime("-1 year")); ?>"> <?php echo date('Y',strtotime("-1 year")); ?></option>
                              <option value="<?php echo date('Y',strtotime("-2 year")); ?>"> <?php echo date('Y',strtotime("-2 year")); ?></option>
                             <option value="<?php echo date('Y',strtotime("-3 year")); ?>"> <?php echo date('Y',strtotime("-3 year")); ?></option>
                           </select>
                        </div>
                     </div>

                     <div class="col-md-3">
                        <div class="form-group">
                           <label>   </label>
                           <select  id="bill_his_type" class="form-control">
                              <option value="All"> All</option>
                              <option value="Gas">Gas</option>
                              <option value="Electricity">Electricity</option>
                              <option value="Water Charges">Water Charges</option>
                              <option value="Municipal Taxes">Municipal Taxes</option>
                              <option value="Other">Other</option></select>
                           </select>
                        </div>
                     </div>
                      <div class="col-md-2">
                        <button id="search_bills" type="button" class="btn btn-success">Go</button>
                     </div>
                  </div>
                  <div class="col-md-2">
                           <div id="export"><img id="excel_pic" style="height: 40px;" src="img/excel_logo.png"> 
                           <span>Export to Excel</span>
                          </div>
                  </div>
                  <table id="pay_report" class="cell-border row-border hover order-column">
                     <thead>
                        <tr class="tableHeaders1">
                           <th>Date Paid</th>
                           <th>Type</th>
                           <th>Total</th>
                           <th>Due Date</th>
                        </tr>
                     </thead>
                     <tbody id="report_body">

                     </tbody>
                  </table>
               </div>
            </div>
            <!--  end tab 2-->
         </div>
      </main>
      <footer>

      </footer>
   </body>
</html>
