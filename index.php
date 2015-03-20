<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Project QA Title</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/app.css" rel="stylesheet">

    <?php
      define('FACEBOOK_SDK_V4_SRC_DIR', 'Facebook/');
      require __DIR__ . '/autoload.php';
      use Facebook\FacebookSession;
      use Facebook\FacebookRequest;
      use Facebook\GraphUser;
      use Facebook\FacebookRequestException;
      use Facebook\FacebookRedirectLoginHelper;

      FacebookSession::setDefaultApplication('675227872583604','a6b552cbefe030fd422d1826524b1f3f');

      $helper = new FacebookRedirectLoginHelper('http://localhost/QA');
      $session = null;    

      $dbhost = 'localhost';
      $dbuser = 'root';
      $dbpass = '';
      $dbname = 'QA';

      $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
      mysql_query("SET NAMES utf8");
      mysql_select_db($dbname);
      $sql = "SELECT * FROM GENERAL WHERE 'Q_Id'=0";
      $result = mysql_query($sql) or die('MySQL query error');
      $q = mysql_fetch_array($result);
    ?>
  </head>

  <body>
    <?php
      try {
        $session = $helper->getSessionFromRedirect();
      } catch(FacebookRequestException $ex) {
        //
      } catch(\Exception $ex) {
        //
      }

      if ($session) {
        $me = (new FacebookRequest(
          $session, 'GET', '/me'
        ))->execute()->getGraphObject(GraphUser::className());
        $logoutUrl = $helper->getLogoutUrl($session, "http://localhost/QA/");
      }
      else{
        $loginUrl = $helper->getLoginUrl(); 
      }
      
    ?>

    <div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project Q</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">隨機題目</a></li>
              <li><a href="#">投稿題目</a></li>
              <li><a href="#">關於我們</a></li>
              <?php if($session):?>
              <li><a href="<?=$logoutUrl?>">登出</a></li>
              <?php else:?>
              <li><a href="<?=$loginUrl?>">以Facebook登入</a></li>
              <?php endif;?>
            </ul>
            
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="primary">
        <div class="question-content">
          <h1 class="text-center"><strong><span class="label label-default">Q</span> <?=$q['Question']?></strong></h1>
          <p class="lead text-justify"><?=$q['Question_Des']?></p>
          <footer class="text-right">- From User <?=$q['User_Name']?></footer>
        </div>
        <br></br>
        <div class="questions list-group">
          <?php
            $alpha = array(
              1 => 'A',
              2 => 'B',
              3 => 'C',
              4 => 'D',
            );
            for ($i = 0; $i < $q['Answer_Num']; $i++):?>
              <a class="list-group-item" href="#" id="Answer_<?=($i+1)?>"><div class="row">
              <div class="col-md-2 col-xs-2 vcenter">
              <h3><?=$alpha[$i+1]?></h3>
              </div><!--
              --><div class="col-md-10 col-xs-10 vcenter">
              <h3 class="text-left"><?=$q['Answer_'.($i+1)]?></h3></div></div></a>
          <?php endfor;?>
        </div>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>var qid = <?=$q['Q_Id']?></script>
    <script src="js/app.js"></script>
  </body>
</html>
