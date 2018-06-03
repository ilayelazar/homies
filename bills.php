<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Homies - Bills</title>
      <link href="https://fonts.googleapis.com/css?family=Mina:700" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Heebo" rel="stylesheet">
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/b-1.5.1/datatables.min.css"/>

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
      <script type="text/javascript"  src="script/dataTables.buttons.min.js"></script>



      <!-- Excel Plugin-->
      <script type="text/javascript" src="script/jquery.table2excel.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/b-1.5.1/datatables.min.js"></script>

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
      <link rel="stylesheet" type="text/css" href="css/buttons.dataTables.min.css">


   </head>
   <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->
   <body>

<!-- VALIDATE PERMISSION - IF(child)-> redirect to warning page -->
<?php
  session_start();
  if($_SESSION['permission'] == 0){
    echo "<script> alert('You have child permissions. User with parent permission can change yours from Homies admin panel.');window.location = 'homepage.php'; </script>";
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
<div class="dropdown pull-right" style='margin-top:6px'>
  <button style="vertical-align: top;display:inline-block" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" data-hover="dropdown">
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
      <main>
        <br><br>
         <div class="box" >
         <div class="panel-heading tabs" id="syllabus">
     
            <div class="tabbable">
               <ul class="nav nav-tabs" id="myTabs">
                   <span class="moduleHeader">Bills </span>
                  <li class="active"><a href="#p1" id="first_nav" data-toggle="tab"><strong>unpaid bills</strong></a></li>
                  <li><a href="#p2" id="second_nav" data-toggle="tab" class="font_heading"><strong>bills history</strong></a></li>
               </ul>
            </div>
         </div>
         <div class="panel-body">
         <div class="tab-content">
            <!--  ------- tab 1 ------- -->
            <div class="tab-pane fade in active" id="p1">
               <div id="pg1">
         
          <h3 class="bills_header">Manage your current house bills:</h3>
                  <div class="payments" align=center>
          
                     <br>
                     <div class=" functional_buttons">
                     <button type="button" id="addRow" class="btn btn-info">Add</button>
                     <button type="button" id="saveAllBills" class="btn btn-info"><b>Save</b></button>
                   </div>
           
                     <div id="wrraper">
                        <div class="row">
                           <div class="col-md-12">
                              <table id="pay_bills" class="cell-border row-border hover ">
                                 <thead>
                                    <tr class="tableHeaders">
                                       <th class="date">Date Added</th>
                                       <th class="type">Type</th>
                                       <th class="sum">Total</th>
                                       <th class="due_d">Due date</th>
                                       <th class="comments">Comments</th>
                                       <th class="no-sort"></th>
                                       <th class="no-sort"></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="row dataTables_wrapper not print pagination-style">

                              <div id="count-record" class="col-sm-12 col-md-6">
                                     <span id="initial-display">Displayed</span> 
                                     <span id="from-record"></span> - <span id="to-record">
                                     </span> of <span id="total-records"></span>
                              </div>
                              <div id="main-pagination" class="col-sm-12 text-sm-center col-md-6 dataTables_paginate paging_simple_numbers">

                              </div>


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
         
          <h3>Export bills history report:</h3>
        
                  <div class=row>
                    <div class="col-md-3">
                        <div class="form-group">
                           <label>   </label>
               <p>month:</p>
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
               <p>year:</p>
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
                           <p>type:</p>
          
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
           <div class="bills_buttons">
                      <div class="col-md-1 col-sm-4 col-xs-4">
                        <button id="search_bills" type="button" class="btn btn-success">Go</button>
                     </div>
                    <div class="col-md-2 col-sm-6 col-xs-6">
                           <div id="export" class="button-default datatable-csv"><img id="excel_pic" style="height: 40px;" src="img/excel_logo.png"> 
                           <span>Export to Excel</span>
                          </div>
                  </div>
                  </div>


                  </div>
 
                </div>
                  <table id="pay_report" class="cell-border row-border hover order-column homiesTables">
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
