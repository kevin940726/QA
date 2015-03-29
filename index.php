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
    <!--<link href="css/bootstrap.min.css" rel="stylesheet">-->
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
    <link href="css/app.css" rel="stylesheet">
  </head>

  <body ng-controller="MainCtrl">
    <div id="fb-root"></div>
    
    <div class="contain-to-grid fixed">
    <nav class="top-bar" data-topbar role="navigation"> 
      <ul class="title-area">
        <li class="name"> <h1><a href="#/">JustQA</a></h1> </li>
        <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone --> 
        <li class="toggle-topbar menu-icon"><a href=""><span>Menu</span></a></li> 
      </ul> 
      <section class="top-bar-section">
       <!-- Right Nav Section --> 
      <ul class="right">
        <li class="active"><a href="#" ng-click="login(isLoggedIn)" ng-bind="loginMsg">Login with Facebook</a></li>
        <li class="has-dropdown"> <a href="#">Category</a>
          <ul class="dropdown"> 
            <li><a href="#">First link in dropdown</a></li>
            <li class="active"><a href="#">Active link in dropdown</a></li>
          </ul>
        </li>
      </ul> <!-- Left Nav Section --> 
      <ul class="left">
        <li><a href="#">隨機題目</a></li>
        <li><a href="#/new">投稿題目</a></li>
        <li><a href="#">關於我們</a></li>
      </ul>
      </section>
    </nav>
    </div>

    <div ng-view></div>

      


    <!--================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/angular.js"></script>
    <script src="js/ngFacebook.js"></script>
    <script src="http://code.angularjs.org/1.2.0-rc.2/angular-route.min.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
    <script src="js/app.js"></script>
  </body>
</html>
