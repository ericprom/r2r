app.controller('SeminarListsController', ['$scope', '$location', 'Auth', 'Utils', 'Seminar', 'toastr', 
	function ($scope, $location, Auth, Utils, Seminar, toastr) {

	$scope.currentPage = 1;
	$scope.numPerPage = 10;
	$scope.maxSize = 5;

	$scope.dataLists = {
		seminars:[]
	};

	$scope.fields = {};

	$scope.keyword = '';
	$scope.loadData = function(){
		$scope.fields = {}
		$scope.$watch('currentPage + numPerPage', function() {
			var begin = (($scope.currentPage - 1) * $scope.numPerPage);
			var end = $scope.numPerPage;
			var criteria = {skip:begin, limit:end, keyword:$scope.keyword};
			Seminar.getItems(criteria, function(response){
				$scope.dataLists.seminars = response;
				$scope.total = response.resultmeta.total;
			}, function(error){
				console.log(error);
			});
		});
	}

  	$scope.numPages = function () {
    	return Math.ceil($scope.total / $scope.numPerPage);
  	};

  	$scope.search = function(keyword){
		$scope.keyword = keyword;
		$scope.loadData();
	}

	
	$scope.edit = function(item){
		var data = {
			seminar: item.id
		}
		var url_encoded = Utils.Base64EncodeUrl(btoa(angular.toJson(data)));
		$location.path('/seminar/edit/'+url_encoded);
	}

	if(!Auth.checkIfLoggedIn()){
		$location.path('/auth/login');
	}

	$scope.search();

}]);