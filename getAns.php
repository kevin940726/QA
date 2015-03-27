<?php
  	$dbhost = 'localhost';
  	$dbuser = 'root';
  	$dbpass = '';
  	$dbname = 'QA';

  	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Error with MySQL connection');
  	mysqli_query($conn, "SET NAMES utf8");
  	
    $params = json_decode(file_get_contents('php://input'),true); 
    $id = $_GET['qid'];
    $sql = "SELECT * FROM GENERAL WHERE `Q_Id`=".$id;
    $result = mysqli_query($conn, $sql) or die('MySQL query error');
    $q = mysqli_fetch_array($result);
    if (isset($params['ans'])){
      $ans = $params['ans'];   
      if ($ans == $q['Answer']){
        echo "1";
      }
      else{
        echo "0";
      }
    }
    else{
      $q['Answer'] = null;
      echo json_encode($q);
    }
	
?>
