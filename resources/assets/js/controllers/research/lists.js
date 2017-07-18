app.controller('ResearchListsController', ['$scope', '$location', 'Auth', 'Utils', 'Research', 'toastr', 
	function ($scope, $location, Auth, Utils, Research, toastr) {

	$scope.currentPage = 1;
	$scope.numPerPage = 10;
	$scope.maxSize = 5;

	$scope.dataLists = {
		researches:[],
		types:[],
		levels:[]
	};

	$scope.dataLists.types = [{
		id:1,
		name:'วิจัย'
	},{
		id:2,
		name:'ผลงานสร้างสรรค์'
	},{
		id:3,
		name:'บทความ'
	},{
		id:4,
		name:'เอกสาร'
	}];

	$scope.dataLists.levels = [{
		id:1,
		name:'ระดับชาติ'
	},{
		id:2,
		name:'ระดับนานาชาติ'
	}];

	$scope.fields = {};

	$scope.getTypeDetail = function(item_id){
		if(item_id){
			var item_detail = _($scope.dataLists.types).find({id: item_id}) || {};
			return item_detail;
		}
	}
	$scope.getLevelDetail = function(item_id){
		if(item_id){
			var item_detail = _($scope.dataLists.levels).find({id: item_id}) || {};
			return item_detail;
		}
	}


	$scope.keyword = '';
	$scope.loadData = function(){
		$scope.fields = {}
		$scope.$watch('currentPage + numPerPage', function() {
			var begin = (($scope.currentPage - 1) * $scope.numPerPage);
			var end = $scope.numPerPage;
			var criteria = {skip:begin, limit:end, keyword:$scope.keyword};
			Research.getItems(criteria, function(response){
				$scope.dataLists.researches = response;
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
			research: item.id
		}
		var url_encoded = Utils.Base64EncodeUrl(btoa(angular.toJson(data)));
		$location.path('/research/edit/'+url_encoded);
	}

	if(!Auth.checkIfLoggedIn()){
		$location.path('/auth/login');
	}

	$scope.search();

}]);