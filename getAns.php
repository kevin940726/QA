<?php
  	$dbhost = 'localhost';
  	$dbuser = 'root';
  	$dbpass = '';
  	$dbname = 'QA';

  	$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
  	mysql_query("SET NAMES utf8");
  	mysql_select_db($dbname);
  	
  $params = json_decode(file_get_contents('php://input'),true); 
	$id = $_GET['qid'];
  $sql = "SELECT * FROM GENERAL WHERE 'Q_Id'=".$id;
  $result = mysql_query($sql) or die('MySQL query error');
  $q = mysql_fetch_array($result);
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
