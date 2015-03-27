<?php
	$dbhost = 'localhost';
  	$dbuser = 'root';
  	$dbpass = '';
  	$dbname = 'QA';

  	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Error with MySQL connection');
  	mysqli_query($conn, "SET NAMES utf8");

  	$params = json_decode(file_get_contents('php://input'),true);
  	if (isset($params['accessToken'])){
 		if ($sql = mysqli_prepare($conn, "SELECT `User_Id` FROM `USER` WHERE `User_Id` = ?")){
 			mysqli_stmt_bind_param($sql, "s", $params['userID']);
 			mysqli_stmt_execute($sql);
 			mysqli_stmt_store_result($sql);

 			if (mysqli_stmt_num_rows($sql) > 0){
 				if ($sql = mysqli_prepare($conn, "UPDATE `USER` SET `Token`=? WHERE `User_Id`=?")){
 					mysqli_stmt_bind_param($sql, "ss", $params['accessToken'], $params['userID']);
 					mysqli_stmt_execute($sql);
 				}
 				echo "0";
 			}
 			else{
 				if ($sql = mysqli_prepare($conn, "INSERT INTO `USER`(`User_Id`, `Token`) VALUES (?,?)")){
 					mysqli_stmt_bind_param($sql, "ss", $params['userID'], $params['accessToken']);
 					mysqli_stmt_execute($sql);
 				}
 				echo "1";
 			}
 		}
  	}
?>