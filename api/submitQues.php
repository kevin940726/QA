<?php
	$dbhost = 'localhost';
  	$dbuser = 'root';
  	$dbpass = '';
  	$dbname = 'QA';

  	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Error with MySQL connection');
  	mysqli_query($conn, "SET NAMES utf8");

  	$params = json_decode(file_get_contents('php://input'),true); 
    if (isset($params['Question']) && isset($params['Question_Des']) && isset($params['Answer']) && isset($params['User_Id']) && isset($params['User_Name'])){

      if ($sql = mysqli_prepare($conn, "INSERT INTO `GENERAL`(`Question`, `Question_Des`, `Answer`, `User_Id`) VALUES (?,?,?,?);")){
        mysqli_stmt_bind_param($sql, "ssss", $params['Question'], $params['Question_Des'], $params['Answer'], $params['User_Id']);
        mysqli_stmt_execute($sql);
        $result = mysqli_query($conn, "SELECT LAST_INSERT_ID();") or die('MySQL query error');
        $index = mysqli_fetch_array($result)[0];
        if ($sql = mysqli_prepare($conn, "INSERT INTO `USER`(`User_Id`, `User_Name`) VALUES (?,?)")){
          mysqli_stmt_bind_param($sql, "ss", $params['User_Id'], $params['User_Name']);
          mysqli_stmt_execute($sql);
          echo $index;
        }
      }
    }
  	else{
  		echo "0";
  	}

?>