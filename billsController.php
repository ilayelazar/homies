<?php
session_start();

CONST BILLSTYPE = array('Gas','Electricity','Water Charges','Municipal Taxes');

 include_once("customMysqli.php");

if (is_ajax()) {
  if (isset($_POST["requestType"]) && !empty($_POST["requestType"])) { //Checks if action value exists
    $action = $_POST["requestType"];
    switch($action) { //Switch case for value of action

    case "loadBills": { //server options
            $group_id= 1;
            loadBills();
      } 
      break;

    case "saveAllOpenBills": {
            $jsonDataNew= $_POST['jsonDataNew'];
            saveAllOpenBills($jsonDataNew);
    } 
    break;

    case "payBill": {
          $jsonData= $_POST['jsonData'];
          $rowType= $_POST['rowType'];
          $rowId= $_POST['rowId'];
          payBill($rowId,$rowType,$jsonData);
    } 
    break;

    case "getBillsHistoryWithFilters": {

          $bill_month= $_POST['month'];
          $bill_year= $_POST['year'];
          $bill_type= $_POST['bill_type'];

          getBillsHistoryWithFilters($bill_month,$bill_year,$bill_type);
    } 
    break;

    default:
    echo "1";
    }
  }
}

//Function to check if the request is an AJAX request
function is_ajax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}


function findGroupID(){
  $mysqli=new customMysqli;
  $conn=false;
  $conn=$mysqli->createConnection($conn);
  
  $select_sql="SELECT familyid FROM `users` WHERE `username`='".$_SESSION["user"]."';";   
  $familyid=$mysqli->executeSQL($conn,$select_sql);
  $mysqli->closeConnection($conn);
  $familyid= json_decode($familyid,true)[0]["familyid"];
  return intval ($familyid);

}


function loadBills(){

  $mysqli=new customMysqli;
  $conn=false;
  $conn=$mysqli->createConnection($conn);

  $familyid= findGroupID();

  $select_sql="SELECT * FROM `bills` WHERE `group_id` ='"  .  $familyid  .  "' AND `b_status` = '0' ";   
  $rez=$mysqli->executeSQL($conn,$select_sql);
  $mysqli->closeConnection($conn);


  $data_array= json_decode($rez,true);

  if (is_array ($data_array)){

        foreach($data_array as $key=>$bills_arr){

          $type=$bills_arr['type'];

          if (in_array($type,BILLSTYPE)){
            $data_array[$key]['other']=0;
           }
          else{
           $data_array[$key]['other']=1;
          }
        }

  }

   $data_array= json_encode($data_array,true);

  echo  $data_array;


}



function saveAllOpenBills($json_data){
  $familyid= findGroupID();
  $mysqli=new customMysqli;
  $conn=false;
  $conn=$mysqli->createConnection($conn);


    
  $delete_sql="DELETE FROM `bills` WHERE `group_id` ='"  .  $familyid  .  "'  AND `b_status`= 0  ";  
  $rez=$mysqli->executeSQL($conn,$delete_sql);

  
  $data_array=json_decode($json_data,true);

  $insert_sql="INSERT INTO `bills` ( `type`, `amount`, `group_id`, `date_added`, `due_date`, `paid_date`, `comments`, `b_status`)  ";   
  $insert_sql.=" VALUES ";

  foreach($data_array as $key=>$bills_arr){
          $insert_sql.=" ( '".$bills_arr['type']."', '".$bills_arr['amount']."', '".$familyid  ."', '".$bills_arr['date_added']."', '".$bills_arr['due_date']."', '0000-00-00', '".$bills_arr['comments']."', '0')," ;
  }
  $insert_sql = rtrim($insert_sql, ',');
  $insert_sql.=";";

  $rez=$mysqli->executeSQL($conn,$insert_sql);
  

  $mysqli->closeConnection($conn);
  echo $familyid;
}


function payBill($rowId,$rowType,$jsonData){
  $mysqli=new customMysqli;
  $conn=false;
  $conn=$mysqli->createConnection($conn);




  if($rowType=='new_'){
 
      $bills_arr=json_decode($jsonData,true); 
      $bills_arr=$bills_arr[0];

      $insert_sql="INSERT INTO `bills` ( `type`, `amount`, `group_id`, `date_added`, `due_date`, `paid_date`, `comments`, `b_status`)";
      $insert_sql.=" VALUES ";
      $insert_sql.=" ( '".$bills_arr['type']."', '".$bills_arr['amount']."', '1', '".$bills_arr['date_added']."','".$bills_arr['due_date']."', NOW(), '".$bills_arr['comments']."', '1');" ;
      $rez=$mysqli->executeSQL($conn, $insert_sql);

  }
  else{
      $select_sql="UPDATE `bills` SET `b_status` = '1', `paid_date`=NOW() WHERE `bills`.`bill_id` = ".intval($rowId);   
      $rez=$mysqli->executeSQL($conn,$select_sql);
  }


  
  $mysqli->closeConnection($conn);

  //return $rez;

}




function getBillsHistoryWithFilters($bill_month,$bill_year,$bill_type){

  $mysqli=new customMysqli;
  $conn=false;
  $conn=$mysqli->createConnection($conn);

  $familyid= findGroupID();


    $typestring="";


    switch($bill_type) { //Switch case for value of action

    case "Other": {
    $typestring=" AND type NOT IN ('".implode("','",BILLSTYPE)."')";
    } 
    break;

    case  (in_array($bill_type,BILLSTYPE)) : {
    $typestring=" AND type = '".$bill_type."' ";
    } 
    break;

    default:

    }



  If($bill_year=="All"){
    $cur_bill_year=$bill_year;
    $bill_year=date("Y");

  }

    If($bill_month=="All"){
    $cur_bill_month=$bill_month;
    $bill_month=date("m");
  }

  $from_date=$bill_year."-".$bill_month."-"."01";


  $from_date= date("Y-m-d", strtotime($from_date) );
  $end_date= date("Y-m-t", strtotime($from_date)); 


  if( $cur_bill_month!="All" && $cur_bill_year!="All"){
      $select_sql="SELECT * FROM `bills` WHERE `group_id` ='"  .  $familyid  .  "' AND b_status=1 ".$typestring." AND paid_date BETWEEN '". $from_date."' AND '".$end_date."' "; 
  }


  if( $cur_bill_month=="All" && $cur_bill_year!="All"){
    $from_date=$cur_bill_year."-01-"."01";
      $select_sql="SELECT * FROM `bills` WHERE `group_id` ='"  .  $familyid  .  "' AND b_status=1 ".$typestring." AND paid_date BETWEEN '". $from_date."' AND '".$end_date."' "; 
  }

    if( $cur_bill_month=="All" && $cur_bill_year=="All"){
    $from_date=date("Y-m-d", strtotime("This is the start of the linux") );
      $select_sql="SELECT * FROM `bills` WHERE `group_id` ='"  .  $familyid  .  "' AND b_status=1 ".$typestring." AND paid_date BETWEEN '". $from_date."' AND '".$end_date."' "; 
  }


      if( $cur_bill_month!="All" && $cur_bill_year=="All"){

      $from_date="1969-".$bill_month."-"."01";  
      $select_sql="SELECT * FROM `bills` WHERE `group_id` ='"  .  $familyid  .  "' AND b_status=1  ".$typestring." HAVING  MONTH(paid_date)=MONTH('". $from_date."') "; 
  }




 

  //AND `b_status` = '0' 
  $rez=$mysqli->executeSQL($conn,$select_sql);
  $mysqli->closeConnection($conn);


  echo $rez;

}



?>