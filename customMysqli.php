<?php

class customMysqli {

	CONST SERVER_NAME = "zebra.mtacloud.co.il";
	CONST USER_NAME = "ilayel";
	CONST PASSWORD = "homies123";
	CONST DB_NAME = "ilayel_homies";
    

    function createConnection($conn){

    $conn = new mysqli(self::SERVER_NAME,self::USER_NAME, self::PASSWORD, self::DB_NAME);

    // Check connection
    if ($conn->connect_error) {
         return false;
    } 
    else{
      return $conn;
    }
    }
    
    function closeConnection($conn){

		$conn->close();
    }

    function executeSQL($conn,$sql){

            $result = $conn->query($sql);

            if( is_array($result) ){// option of INSERT
                $row = $result->fetch_array(MYSQLI_ASSOC);
                return json_encode($row); 
            } elseif (is_a($result, 'mysqli_result')  ){// option of SELECT from mysql
                $rez_array =array();
                if (mysqli_num_rows($result) > 0) {//
                    while($row = mysqli_fetch_assoc($result)) {
                      $rez_array[]=$row;
                    }
                    return json_encode($rez_array); 
                }  

             }else {//DELETE option
                     return $result;
                    }
    }
}

?>