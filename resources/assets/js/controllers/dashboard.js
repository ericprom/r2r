app.controller('DashboardController', ['$scope', '$location', 'Auth', 'Utils', 'Annoucement', 'toastr', 
	function ($scope, $location, Auth, Utils, Annoucement, toastr) {

	$scope.currentPage = 1;
	$scope.numPerPage = 3;
	$scope.maxSize = 5;

	$scope.dataLists = {
		annoucements:[]
	};

	$scope.fields = {};

	$scope.keyword = '';
	$scope.loadData = function(){
		$scope.fields = {}
		$scope.$watch('currentPage + numPerPage', function() {
			var begin = (($scope.currentPage - 1) * $scope.numPerPage);
			var end = $scope.numPerPage;
			var criteria = {skip:begin, limit:end, keyword:$scope.keyword};
			Annoucement.getItems(criteria, function(response){
				$scope.dataLists.annoucements = response;
				$scope.total = response.resultmeta.total;
			}, function(error){
				console.log(error);
			});
		});
	}

  	$scope.numPages = function () {
    	return Math.ceil($scope.total / $scope.numPerPage);
  	};

	if(!Auth.checkIfLoggedIn()){
		$location.path('/auth/login');
	}

	$scope.loadData();

}]);