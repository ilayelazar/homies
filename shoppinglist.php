<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Homie - Shopping list</title>
      <link href="https://fonts.googleapis.com/css?family=Heebo" rel="stylesheet">
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="icon" href="img/family-logo.png">


      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
      

      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <!-- Latest compiled JavaScript -->

      <script type="text/javascript"  src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>


      <script type="text/javascript"  src="script/paging.js"></script>
      <script type="text/javascript"  src="script/shoppinglist.js"></script>
      <script type="text/javascript"  src="script/shoppingAjax.js"></script>
      <script type="text/javascript"  src="script/script.js"></script>
      <link href="https://fonts.googleapis.com/css?family=Mina:700" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="css/responsive.bootstrap.min.css">

      <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
      <link rel="stylesheet" type="text/css" href="css/shoppinglist.css">
      <script type="text/javascript"></script>


   </head>
   <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->
   <body>
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

      <main>
        
         <div class="box" style="width:75%">
         <div class="panel-heading tabs" id="syllabus">
            <div class="tabbable">
               <ul class="nav nav-tabs" id="myTabs">
                <span class="moduleHeader">Shopping </span>
                  <li class="active"><a class="font_heading" href="#p1" data-toggle="tab"><strong>Grocery List</strong></a></li>
                  <li><a class="font_heading" href="#p2" data-toggle="tab"><strong>Recipe Search</strong></a></li>
               </ul>
            </div>
         </div>
         <div class="panel-body">
         <div class="tab-content">
            <!--  ------- tab 1 ------- -->
            <div class="tab-pane fade in active" id="p1">
               <div id="pg1">
                  <div class="grocery_list" align=center>
                     <div id="wrraper">
                        <div class="row">
                           <div class="col-md-12">
                          <div class="input-group col-md-9">
                           <div class="saved_alert" id="alert">
                           </div>
                            </div>
                              <table id="grocery_list" class="hover order-column">
                                    <div class="buttons_table">
                                      <button  id="addRow"  class="btn btn-info">Add</button>
                                      <button id="saveAllRows" class="btn btn-info"><b>Save</b></button>
                                    </div>
                                 <thead>
                                    <tr class="tableHeaders">
                                          <th id="item">item</th>
                                          <th id= "amount">amount</th>
                                          <th id="unit">unit</th>
                                          <th class="no-sort"></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                              </table>
                              </div>
                           </div>
                           <div class="col-md-10 dataTables_wrapper not print">
                              <div id="main-pagination" class="dataTables_paginate paging_simple_numbers">
                              </div>
                           </div>
                          <div id="count-record" class="col-md-3 not-print">
                          <!--<span>Displayed</span> <span id="from-record"></span> - <span id="to-record"></span> of <span id="total-records"></span>-->
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
                     <div  class="row navbar-left">
                        <div class="input-group col-md-3">
                           <input id='Search' type="Search" placeholder="Search here you recipe..." class="form-control" />
                           <div class="search-btn input-group-btn">
                              <button class="btn btn-info">
                              <span class="glyphicon glyphicon-search"></span>
                              </button>
                           </div>
                        </div>
                        <div class="input-group col-md-9">
                           <div class="customized_alert" id="my_alert">
                           </div>
                        </div>
                     </div>
                     <div class="has_results">
                      <img src="img/loader.gif" id="gif" style="display:none">
                     </div>
                     <!--  end tab 2-->
                  </div>
               </div>
            </div>
         </div>
      </main>
   </body>
</html>