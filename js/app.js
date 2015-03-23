var index = angular.module('index', ['ngRoute']);

index.config(['$routeProvider', '$locationProvider', function($routeProvider, $locationProvider) {	
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
  	//$locationProvider.html5Mode(true);
}]);


index.controller('MainCtrl', function($scope, $http, $location, $routeParams) {

  if (!$routeParams.id) $routeParams.id = "0";
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
});


index.controller('NewCtrl', function($scope, $http) {
	if (checkLoginState()){
		console.log("yes");
	}
	else{
		console.log("no");
	}
});


function statusChangeCallback(response) {
	console.log('statusChangeCallback');
	console.log(response);
	if (response.status === 'connected') {
	  return true;
	}
	else{
	  return false;
	}
};

function checkLoginState() {
	FB.getLoginStatus(function(response) {
	  statusChangeCallback(response);
	});
};

window.fbAsyncInit = function() {
  FB.init({
    appId      : '675227872583604',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.2' // use version 2.2
  });

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
};

// Load the SDK asynchronously
(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/sdk.js";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Here we run a very simple test of the Graph API after login is
// successful.  See statusChangeCallback() for when this call is made.
function testAPI() {
console.log('Welcome!  Fetching your information.... ');
FB.api('/me', function(response) {
  console.log(JSON.stringify(response));
});
};

