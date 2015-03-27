<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en" ng-app="index">
  <head>
    <base href="/QA/">
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

      $dbhost = 'localhost';
      $dbuser = 'root';
      $dbpass = '';
      $dbname = 'QA';

      $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Error with MySQL connection');
      //mysql_query("SET NAMES utf8");
      $sql = "SELECT * FROM GENERAL WHERE 'Q_Id'=1";
      $result = mysqli_query($conn, $sql) or die('MySQL query error');
      $q = mysqli_fetch_assoc($result);
    ?>
    
  </head>

  <body ng-controller="MainCtrl">
    <button ng-click="deleteQues()">Click me</button>
    <div id="fb-root"></div>

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
            <a class="navbar-brand" href="#/">Project Q</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">隨機題目</a></li>
              <li><a href="#/new">投稿題目</a></li>
              <li><a href="#">關於我們</a></li>
              <li><a href="" ng-click="login(isLoggedIn)" ng-bind="loginMsg"></a></li>
            </ul>
            
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

      <div ng-view></div>

      


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/angular.js"></script>
    <script src="js/ngFacebook.js"></script>
    <script src="http://code.angularjs.org/1.2.0-rc.2/angular-route.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
      var qid = <?=$q['Q_Id']?>;
      window.myPostData = <?php echo empty($me) ? 'false' : $data; ?>;
    </script>
    <script src="js/app.js"></script>
  </body>
</html>
