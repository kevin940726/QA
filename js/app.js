var index = angular.module('index', ['ngRoute', 'ngFacebook']);

index.config(['$routeProvider', '$locationProvider', '$facebookProvider', function($routeProvider, $locationProvider, $facebookProvider) {	
	$routeProvider
		.when('/', {
			title: 'QA Title',
			templateUrl : 'partials/question.html',
			controller  : 'MainCtrl'
		})
		.when('/new', {
			title: 'QA - New quesiton',
			templateUrl	: 'partials/new.html',
			controller	: 'NewCtrl',  
		})
		.when('/:id', {
			title: 'QA Title',
			templateUrl : 'partials/question.html',
			controller  : 'MainCtrl'
		})
		.otherwise({
			redirectTo: '/'
		});
	$facebookProvider.setAppId('675227872583604');
  	//$locationProvider.html5Mode(true);
}]);

index.run(function ($rootScope) {
	// Load the SDK asynchronously
	(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
})

index.controller('MainCtrl', function($scope, $http, $location, $routeParams, $facebook) {

  //if (!$routeParams.id) $routeParams.id = "0";
  $http.get("getAns.php?qid="+$routeParams.id).success(function(data){
  	$scope.q = data;  	
  });
  $http.get("getChoice.php?qid="+$routeParams.id).success(function(data){
  	$scope.c = data;
  });
  $scope.submitAns = function(index){
  	$http.post("getAns.php?qid="+$routeParams.id, {ans: index}).success(function(data){
  		console.log(data);
  	})
  };

  $scope.deleteQues = function(){
  	$http.post("api/deleteQues.php?qid="+$routeParams.id, {Token: $facebook.getAuthResponse()['accessToken']}).success(function (data) {
  		console.log(data);
  		if (data == "Done"){
  			$location.path("/");
  		}
  	});
  };

  $scope.isLoggedIn = false;
  $scope.loginMsg = "Log in with Facebook";
  $scope.userid = "Unknown";
  $scope.login = function(isLoggedIn) {
  	if (!isLoggedIn){
  		$facebook.login().then(function() {
  			refresh();
  			console.log($facebook.getAuthResponse());
  			$http.post('api/userAuth.php', $facebook.getAuthResponse()).success(function (data) {
  				console.log(data); 				
  			});
  		});
  	}
  	else{
  		$facebook.logout().then(function() {
  		  refresh();
  		});
  	}  
  }
  function refresh() {
    $facebook.api("/me").then( 
      function(response) {
      	console.log(JSON.stringify(response));
        $scope.loginMsg = response.name;
        $scope.userid = response.id;
        $scope.isLoggedIn = true;
      },
      function(err) {
        $scope.loginMsg = "Log in with Facebook";
        $scope.userid = "Unknown";
      });
  }
});


index.controller('NewCtrl', function($scope, $http, $location) {
	$scope.formdata = {
		Question: "",
		Question_Des: "",
		Answer: "",
		User_Id: "",
		User_Name: ""
	};

	$scope.submitQues = function(){
		$scope.isSuccess = false;
		$scope.isWrong = false;
		$scope.formdata.User_Id = $scope.userid;
		$scope.formdata.User_Name = $scope.loginMsg;
		if ($scope.userid != "Unknown"){
			$http.post("api/submitQues.php", $scope.formdata).success(function(res) {
				if (res != "1"){
					$scope.isSuccess = true;
					$scope.isWrong = false;
					$location.path('/'+res);
				}
				else{
					$scope.isSuccess = false;
					$scope.errorMsg = "發生問題！請稍候再試。";
					$scope.isWrong = true;
				}
			});
		}
		else{
			$scope.errorMsg = "請先登入！";
			$scope.isWrong = true;
		}
		
	}
	console.log($scope.userid);
});

