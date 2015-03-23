<?php
	$dbhost = 'localhost';
  	$dbuser = 'root';
  	$dbpass = '';
  	$dbname = 'QA';

  	$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
  	mysql_query("SET NAMES utf8");
  	mysql_select_db($dbname);
  	
  	if (isset($_GET['qid'])){
		$id = $_GET['qid'];
		$sql = "SELECT * FROM CHOICE WHERE 'Q_Id'=".$id;
		$result = mysql_query($sql) or die('MySQL query error');
		while ($a = mysql_fetch_array($result)){
		  $c[$a['Choice_Id']] = $a['Choice_Des'];
		}
		echo json_encode($c);
	}
?>