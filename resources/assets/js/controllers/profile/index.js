app.controller('ProfileController', ['$http', '$scope', '$location', 'Auth', 'Utils', 'User', 'toastr', 
	function ($http, $scope, $location, Auth, Utils, User, toastr) {
	
	$scope.dataLists = {
		status:[],
		genders:[]
	}
	
	$scope.fields = {}

	User.getItem($scope.authenticatedUser.id, function(response){
		$scope.fields.user = response;
		$scope.fields.info = response.info;
		$scope.fields.work = response.work;
		$scope.fields.edu = response.edu;
		$scope.image_source = response.avatar;
	}, function(error){
		console.log('error',error);
	});

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

	$scope.dataLists.status = [{
		id:0,
		name:'โสด'
	},{
		id:1,
		name:'แต่งงาน'
	},{
		id:2,
		name:'หย่าร้าง'
	}];

	$scope.dataLists.genders = [{
		id:0,
		name:'หญิง'
	},{
		id:1,
		name:'ชาย'
	}];

	$scope.getStatus = function(data){
		var status = 'ไม่ระบุ';
		switch(data){
			case 0:
				status = 'โสด';
				break;
			case 1:
				status = 'แต่งงาน';
				break;
			case 2:
				status = 'หย่าร้าง';
				break;
		}
		return status;
	}
	$scope.getGender = function(data){
		var status = 'ไม่ระบุ';
		switch(data){
			case 0:
				status = 'หญิง';
				break;
			case 1:
				status = 'ชาย';
				break;
		}
		return status;
	}

	$scope.editWork = function(data){
		console.log(data);
		$scope.fields.work.date = Utils.displayDate(data.start_date);
		$('#workModal').modal('toggle');
	}
	$scope.editInfo = function(data){
		$('#infoModal').modal('toggle');
	}
	$scope.editEdu = function(data){
		$('#eduModal').modal('toggle');
	}

	$('#startDate').datepicker();
	$scope.updateWork = function(){
		$scope.fields.work.start_date = Utils.saveDate($scope.fields.work.date);
		$scope.fields.action = 'update_work';
		User.update($scope.fields.user.id, $scope.fields, function(response){
			toastr.success('บันทึกข้อมูลสำเร็จ', 'User Settings');
		}, function(error){
			console.log('error',error);
		});
		$('#workModal').modal('toggle');
	}
	$scope.updateInfo = function(){
		$scope.fields.action = 'update_info';
		User.update($scope.fields.user.id, $scope.fields, function(response){
			toastr.success('บันทึกข้อมูลสำเร็จ', 'User Settings');
		}, function(error){
			console.log('error',error);
		});
		$('#infoModal').modal('toggle');
	}
	$scope.updateEdu = function(){
		$scope.fields.action = 'update_edu';
		User.update($scope.fields.user.id, $scope.fields, function(response){
			toastr.success('บันทึกข้อมูลสำเร็จ', 'User Settings');
		}, function(error){
			console.log('error',error);
		});
		$('#eduModal').modal('toggle');
	}
	
	if(!Auth.checkIfLoggedIn()){
		$location.path('/auth/login');
	}

}]);