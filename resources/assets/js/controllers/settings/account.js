app.controller('SettingsAccountController', ['$http','$http', '$scope', '$location', 'Auth', 'User', 'toastr', 
	function ($http, $http, $scope, $location, Auth, User, toastr) {

	$scope.fields = {
		user : $scope.authenticatedUser
	}

	$scope.image_source = $scope.fields.user.avatar;

	$scope.change = function(){
		document.getElementById('formImage').click();
	}

	$scope.upload = function(element) {
      	$http({
		  method  : 'POST',
		  url     : '/api/v1/upload/avatar',
		  processData: false,
		  transformRequest: function (data) {
		      var formData = new FormData();
		      formData.append("avatar", element.files[0]);  
		      return formData;  
		  },  
		  headers: {
		        'Content-Type': undefined
		  }
	   }).then(function(data){
	        console.log(data);
	   });

    };

    $scope.uploaded = function(element) {
	    var reader = new FileReader();

	    reader.onload = function(event) {
	      	$scope.image_source = event.target.result
	    }
     	reader.readAsDataURL(element.files[0]);
     	$scope.upload(element);
	}

	$scope.update = function(){
		if($scope.fields.user.password && $scope.fields.user.password != $scope.fields.user.password2){
			toastr.warning('กรุณายืนยันรหัสผ่าน', 'User Settings');
			return;
		}
		User.update($scope.fields.user.id, $scope.fields, function(response){
			toastr.success('บันทึกข้อมูลสำเร็จ', 'User Settings');
		}, function(error){
			console.log('error',error);
		});
	}

	if(!Auth.checkIfLoggedIn()){
		$location.path('/auth/login');
	}

}]);