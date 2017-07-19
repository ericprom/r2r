app.controller('AnnoucementsController', ['$scope', '$location', 'Auth', 'Utils', 'Annoucement', 'toastr', 
	function ($scope, $location, Auth, Utils, Annoucement, toastr) {

	$scope.currentPage = 1;
	$scope.numPerPage = 10;
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

  	$scope.toggleStatus = function(item){
		if(item.active){
			item.active = false;
		}
		else{
			item.active = true;
		}
	}

  	$scope.search = function(keyword){
		$scope.keyword = keyword;
		$scope.loadData();
	}

	
	$scope.Remove = function (list, item) {
	    var index = list.indexOf(item);
	    list.splice(index, 1);
	};

	$scope.add = function(){
		$scope.fields = {};
		$('#manageAnnoucementModal').modal('toggle');
	}
	
	$scope.edit = function(item){
		$scope.fields.annoucement = item;
		$('#manageAnnoucementModal').modal('toggle');
	}

	$scope.save = function(){
		if($scope.fields.annoucement.id){
			Annoucement.update($scope.fields.annoucement.id, $scope.fields, function(response){
				toastr.success('บันทึกข้อมูลสำเร็จ', 'Annoucement Update');
				$scope.loadData();
			}, function(error){
				console.log('error',error);
			});
		}
		else{
			Annoucement.save($scope.fields, function(response){
				toastr.success('บันทึกข้อมูลสำเร็จ', 'Annoucement Settings');
				$scope.loadData();
			}, function(error){
				console.log(error);
			});
		}

		$('#manageAnnoucementModal').modal('toggle');
	}

	if(!Auth.checkIfLoggedIn()){
		$location.path('/auth/login');
	}

	$scope.search();

}]);