<?php

 include_once("customMysqli.php");

if (is_ajax()) {
  if (isset($_POST["requestType"]) && !empty($_POST["requestType"])) { //Checks if action value exists
    $action = $_POST["requestType"];
    switch($action) { //Switch case for value of action
      case "getRecipe": getLiveDataFromApi(); 
      break;
      case "saveRecipeIngredient": {
        $group_id= $_POST['groupId'];
        $json_data= $_POST['jsonData'];
        saveRecipeIngredient($group_id,$json_data);
      } 
      break;
      case "loadGroceryList": {
        $group_id= $_POST['groupId'];
        loadGroceryList($group_id);
      } 
      break;
            case "saveGroceryListToDb": {
        $group_id= $_POST['groupId'];
        $json_data= $_POST['jsonData'];
        saveGroceryListToDb($group_id,$json_data);
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

function getLiveDataFromApi(){

  $query=$_POST['searchQuery'];
  $app_key="3a2d57f1c138ff1b6eb7f0b1db299a60";
  $app_id="aec085d3";

  $uri = 'https://api.edamam.com/search';
  $url= 'https://api.edamam.com/search?q='.$query.'&app_id=aec085d3&app_key=3a2d57f1c138ff1b6eb7f0b1db299a60';

  // Create map with request parameters
  $params =  array('q' => $query, 'app_key' => $app_key, 'app_id' => $app_id);

   /*
  // Build Http query using params
  $query = http_build_query ($params);
   
  // Create Http context details
  $contextData = array ( 
                  'method' => 'POST',
                  'header' => "Content-Encoding: gzip\r\n".
                              "Content-Length: ".strlen($query)."\r\n",
                  'content'=> $query );
   
  // Create context resource for our request
  $context = stream_context_create (array ( 'https' => $contextData ));
   
  // Read page rendered as result of your POST request
  $result =  file_get_contents ($uri, false, $context);
   
  // Server response is now stored in $result variable so you can process it

*/

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,$url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($params) );
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Encoding: gzip'));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $server_output = curl_exec ($ch);
  curl_close ($ch);


  echo $server_output;
}

function saveRecipeIngredient($group_id,$json_data){

  $mysqli=new customMysqli;
  $conn=false;
  $conn=$mysqli->createConnection($conn);

  $data_array=json_decode($json_data,true);

  $insert_sql="INSERT INTO `shopping_list` (`familyid`,`ingrediantname`,`amount`,`unit`) ";   
  $insert_sql.=" VALUES ";

  foreach($data_array as $key=>$ing_arr){
          $insert_sql.="('1','".$ing_arr["text"]."','".$ing_arr["weight"]."','gram')," ;
  }
  $insert_sql = rtrim($insert_sql, ',');

  $insert_sql.=" ON DUPLICATE KEY UPDATE amount=amount+VALUES(amount); ";

  $rez=$mysqli->executeSQL($conn,$insert_sql);

  $mysqli->closeConnection($conn);
  
  echo $rez;
}

function loadGroceryList($group_id){

  $mysqli=new customMysqli;
  $conn=false;
  $conn=$mysqli->createConnection($conn);

  $select_sql="SELECT * FROM `shopping_list` WHERE `familyid` ='1' ";   

  $rez=$mysqli->executeSQL($conn,$select_sql);

  $mysqli->closeConnection($conn);

  echo $rez;


}

function saveGroceryListToDb($group_id,$json_data){
  
  $mysqli=new customMysqli;
  $conn=false;
  $conn=$mysqli->createConnection($conn);

  $delete_sql="DELETE FROM `shopping_list` WHERE `familyid` ='"  .  $group_id  .  "' ";  
  $rez=$mysqli->executeSQL($conn,$delete_sql);

  
  $data_array=json_decode($json_data,true);

  $insert_sql="INSERT INTO `shopping_list` (`familyid`,`ingrediantname`,`amount`,`unit`) ";   
  $insert_sql.=" VALUES ";

  foreach($data_array as $key=>$ing_arr){
          $insert_sql.="(".$group_id.",'".$ing_arr["ingrediantname"]."','".$ing_arr["amount"]."','".$ing_arr["unit"]."')," ;
  }

  $insert_sql = rtrim($insert_sql, ',');

  $insert_sql.=" ON DUPLICATE KEY UPDATE amount=amount+VALUES(amount); ";

  $rez=$mysqli->executeSQL($conn,$insert_sql);
  

  $mysqli->closeConnection($conn);

  echo $insert_sql;

}




