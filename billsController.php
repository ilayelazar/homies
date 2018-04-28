<?php

 include_once("customMysqli.php");

if (is_ajax()) {
  if (isset($_POST["requestType"]) && !empty($_POST["requestType"])) { //Checks if action value exists
    $action = $_POST["requestType"];
    switch($action) { //Switch case for value of action

      case "loadBills": {
        $group_id= $_POST['groupId'];
        loadBills($group_id);
      } 
      break;
            case "saveAllOpenBills": {
        $json_data= $_POST['jsonData'];
        saveAllOpenBills($json_data);
      } 
      break;

      


      default:
       echo "false ajax";
    }
  }
}

//Function to check if the request is an AJAX request
function is_ajax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}


function loadBills($group_id){

  $mysqli=new customMysqli;
  $conn=false;
  $conn=$mysqli->createConnection($conn);

  $select_sql="SELECT * FROM `shopping_list` WHERE `familyid` ='1' ";   

  $rez=$mysqli->executeSQL($conn,$select_sql);

  $mysqli->closeConnection($conn);

  echo $rez;


}

function saveAllOpenBills($json_data){

  $mysqli=new customMysqli;
  $conn=false;
  $conn=$mysqli->createConnection($conn);

  $group_id =1;

  $delete_sql="DELETE FROM `bills` WHERE `familyid` ='"  .  $group_id  .  "'  AND `b_status`= 0  ";  
  $rez=$mysqli->executeSQL($conn,$delete_sql);

  
  $data_array=json_decode($json_data,true);

  $insert_sql="INSERT INTO `bills` ( `type`, `amount`, `group_id`, `date_added`, `due_date`, `paid_date`, `comments`, `b_status`)  ";   
  $insert_sql.=" VALUES ";

  foreach($data_array as $key=>$bills_arr){
          $insert_sql.=" ( '".$bills_arr['type']."', '".$bills_arr['amount']."', '1', '".$bills_arr['date_added']."', '".$bills_arr['due_date']."', '0000-00-00', '".$bills_arr['comments']."', '0')," ;
  }
  $insert_sql = rtrim($insert_sql, ',');
  $insert_sql.=";";

  $rez=$mysqli->executeSQL($conn,$insert_sql);
  

  $mysqli->closeConnection($conn);

  echo $insert_sql;

}




