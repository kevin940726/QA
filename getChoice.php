<?php
	$dbhost = 'localhost';
  	$dbuser = 'root';
  	$dbpass = '';
  	$dbname = 'QA';

  	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Error with MySQL connection');
  	mysqli_query($conn, "SET NAMES utf8");
  	
  	if (isset($_GET['qid'])){
		$id = $_GET['qid'];
		$sql = "SELECT * FROM CHOICE WHERE `Q_Id`=".$id;
		$result = mysqli_query($conn, $sql) or die('MySQL query error');
		while ($a = mysqli_fetch_array($result)){
		  $c[$a['Choice_Id']] = $a['Choice_Des'];
		}
		echo json_encode($c);
	}
?>