<?php
  	$dbhost = 'localhost';
  	$dbuser = 'root';
  	$dbpass = '';
  	$dbname = 'QA';

  	$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
  	mysql_query("SET NAMES utf8");
  	mysql_select_db($dbname);
  	
	$id = $_GET['qid'];
	$ans = $_POST['ans'];
	$sql = "SELECT * FROM GENERAL WHERE 'Q_Id'=".$id;
  	$result = mysql_query($sql) or die('MySQL query error');
  	$q = mysql_fetch_array($result);
  	if ($ans == $q['Answer']){
  		echo "1";
  	}
  	else{
  		echo "0";
  	}
?>
