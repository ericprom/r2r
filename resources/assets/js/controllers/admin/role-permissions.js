app.controller('AdminRolePermissionController', ['$scope', '$location', 'Auth', 'Role', 'Permission', 'toastr', 
	function ($scope, $location, Auth, Role, Permission, toastr) {

	$scope.roles = [];
	$scope.permissions = [];

	$scope.currentRoleReset = function(){
		$scope.roleTitle = '';
		$scope.selected = {};

		Role.getItems(function(response){
			$scope.roles = response;
		}, function(error){
			console.log(error);
		});
	}

	$scope.currentPermissionReset = function(){
		$scope.permissionTitle = '';
		$scope.selected = {};

		Permission.getItems(function(response){
			$scope.permissions = response;
		}, function(error){
			console.log(error);
		});
	}

	$scope.Remove = function (list, item) {
	    var index = list.indexOf(item);
	    list.splice(index, 1);
	};

	$scope.saveRole = function(){
		if($scope.roleTitle){
			var name = $scope.roleTitle.split(":");
			Role.save({
				name:name[0].toLowerCase(),
				display_name:$scope.roleTitle
			},function(response){
				console.log(response);
			
			}, function(error){
				console.log(error);
			});

			$scope.currentRoleReset();
		}
		else{
			console.log('Role is empty');
		}
	}

	$scope.editRoleModal = function(role){
		$scope.selected = role;
		$('#editRoleModal').modal('toggle');
	}

	$scope.updateRole = function(){
		Role.update($scope.selected.id, $scope.selected, function(response){
			toastr.success('บันทึกข้อมูลสำเร็จ', 'Role Settings');
		}, function(error){
			console.log('error',error);
		});
		$('#editRoleModal').modal('toggle');
		$scope.currentRoleReset();
	}

	$scope.deleteRoleModal = function(role){
		$scope.selected = role;
		$('#deleteRoleModal').modal('toggle');
	}

	$scope.deleteRole = function(){
		$scope.Remove($scope.roles, $scope.selected);
		$('#deleteRoleModal').modal('toggle');
	}

	$scope.savePermission = function(){
		if($scope.permissionTitle){
			var name = $scope.permissionTitle.split(":");
			Permission.save({
				name:name[0].toLowerCase(),
				display_name:$scope.permissionTitle
			},function(response){
				console.log(response);
			
			}, function(error){
				console.log(error);
			});

			$scope.currentPermissionReset();
		}
		else{
			console.log('Permission is empty');
		}
	}

	$scope.editPermissionModal = function(permission){
		$scope.selected = permission;
		$('#editPermissionModal').modal('toggle');
	}

	$scope.updatePermission = function(){
		Permission.update($scope.selected.id, $scope.selected, function(response){
			toastr.success('บันทึกข้อมูลสำเร็จ', 'Permission Settings');
		}, function(error){
			console.log('error',error);
		});
		$('#editPermissionModal').modal('toggle');
		$scope.currentPermissionReset();
	}

	$scope.deletePermissionModal = function(role){
		$scope.selected = role;
		$('#deletePermissionModal').modal('toggle');
	}

	$scope.deletePermission = function(){
		$scope.Remove($scope.permissions, $scope.selected);
		$('#deletePermissionModal').modal('toggle');
	}

	if(!Auth.checkIfLoggedIn()){
		$location.path('/auth/login');
	}

	$scope.currentRoleReset();
	$scope.currentPermissionReset();

}]);