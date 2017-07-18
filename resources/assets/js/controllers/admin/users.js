app.controller('AdminUsersController', ['$scope', '$location', 'Auth', 'Role', 'User', 'toastr', 
	function ($scope, $location, Auth, Role, User, toastr) {

	$scope.currentPage = 1;
	$scope.numPerPage = 10;
	$scope.maxSize = 5;

	$scope.dataLists = {
		users:[],
		roles:[]
	};

	$scope.fields = {};

	Role.getItems(function(response){
		$scope.dataLists.roles = response;
	}, function(error){
		console.log(error);
	});

	$scope.keyword = '';
	$scope.loadData = function(){
		$scope.fields = {}
		$scope.$watch('currentPage + numPerPage', function() {
			var begin = (($scope.currentPage - 1) * $scope.numPerPage);
			var end = $scope.numPerPage;
			var criteria = {skip:begin, limit:end, keyword:$scope.keyword};
			User.getItems(criteria, function(response){
				$scope.dataLists.users = response;
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
	
	$scope.toggleStatus = function(item){
		if(item.active){
			item.active = false;
		}
		else{
			item.active = true;
		}
	}

	$scope.Remove = function (list, item) {
	    var index = list.indexOf(item);
	    list.splice(index, 1);
	};

	$scope.add = function(){
		$scope.fields = {};
		$('#manageUserModal').modal('toggle');
	}

	$scope.edit = function(user){
		$scope.fields.user = user;
		$scope.fields.roles = user.roles.map(function(item) {
		    return item['id'];
		});
		$('#manageUserModal').modal('toggle');
	}

	$scope.save = function(){
		if($scope.fields.user.id){
			$scope.fields.action = 'update_user';
			User.update($scope.fields.user.id, $scope.fields, function(response){
				toastr.success('บันทึกข้อมูลสำเร็จ', 'User Settings');
			}, function(error){
				console.log('error',error);
			});
		}
		else{
			User.save($scope.fields, function(response){
				toastr.success('บันทึกข้อมูลสำเร็จ', 'User Settings');
				$scope.loadData();
			}, function(error){
				console.log(error);
			});
		}

		$('#manageUserModal').modal('toggle');
		$scope.loadData();
	}

	if(!Auth.checkIfLoggedIn()){
		$location.path('/auth/login');
	}

	$scope.search();

}]);