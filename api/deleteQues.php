<?php
	session_start();

	define('FACEBOOK_SDK_V4_SRC_DIR', '../Facebook/');
	require __DIR__ . '/../autoload.php';

	use Facebook\FacebookSession;
	use Facebook\FacebookRequest;
	use Facebook\GraphUser;
	use Facebook\FacebookRequestException;
	use Facebook\FacebookJavaScriptLoginHelper;

	FacebookSession::setDefaultApplication('675227872583604','secret-key');

	$params = json_decode(file_get_contents('php://input'),true);
	$session = new FacebookSession($params['Token']);
	
	if ($session) {
	  	$me = (new FacebookRequest(
	    	$session, 'GET', '/me'
	  	))->execute()->getGraphObject(GraphUser::className());
	  	//echo $me->getName();
	}
	else{
		echo "NO";
	}



	$dbhost = 'localhost';
  	$dbuser = 'root';
  	$dbpass = '';
  	$dbname = 'QA';

  	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Error with MySQL connection');
  	mysqli_query($conn, "SET NAMES utf8");

  	if (isset($_GET['qid'])){
  		if ($sql = mysqli_prepare($conn, "SELECT `User_Id` FROM `GENERAL` WHERE `Q_Id`=?")){
  			mysqli_stmt_bind_param($sql, "s", $_GET['qid']);
  			mysqli_stmt_execute($sql);
 			mysqli_stmt_bind_result($sql, $id);
 			mysqli_stmt_fetch($sql);
 			mysqli_stmt_close($sql);
 			if ($id == $me->getId()){
 				if ($sql = mysqli_prepare($conn, "DELETE FROM `GENERAL` WHERE `Q_Id`=?")){
 					mysqli_stmt_bind_param($sql, "s", $_GET['qid']);
 					mysqli_stmt_execute($sql);
 					echo "Done";
 				}
 			}
 			else{
 				echo "False";
 			}		
  		}
  	}
  	mysqli_close($conn);


?>