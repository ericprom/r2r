app.controller('AdminAreaController', ['$scope', '$location', 'Auth', 
	function ($scope, $location, Auth) {

	if(!Auth.checkIfLoggedIn()){
		$location.path('/auth/login');
	}

}]);