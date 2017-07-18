app.controller('SeminarNewController', ['$http','$http', '$scope', '$location', 'Auth', 'Utils', 'Seminar', 'toastr', 
	function ($http, $http, $scope, $location, Auth, Utils, Seminar, toastr) {

	$scope.fields = {
		seminar : {
			start: Utils.displayDate(moment()),
			end: Utils.displayDate(moment())
		} 
	}

	$scope.currentSeminarReset = function(){
		$scope.fields = {
			seminar : {
				start: Utils.displayDate(moment()),
				end: Utils.displayDate(moment())
			} 
		}
	}


	$('#seminarStartDate', '#seminarEndDate').datepicker();

	$scope.change = function(section){
		switch(section){
			case 'seminar':
				document.getElementById('formSeminar').click();
				break;
			case 'knowledge':
				document.getElementById('formKnowledge').click();
				break;
		}
	}

	$scope.remove = function(section){
		switch(section){
   			case 'seminar':
				delete $scope.fields.seminar_file
				delete $scope.fields.research.seminar_pdf_id;
   				break;
   			case 'knowledge':
				delete $scope.fields.knowledge_file;
				delete $scope.fields.research.knowledge_pdf_id;
   				break;
   		}
	}

	$scope.uploaded = function(section,element) {
		var file = element.files[0];
		switch(section){
   			case 'seminar':
				$scope.fields.seminar_file = file;
   				break;
   			case 'knowledge':
				$scope.fields.knowledge_file = file;
   				break;
   		}
     	$scope.upload(section,file);
	}

	$scope.upload = function(section,file) {

      	$http({
		  method  : 'POST',
		  url     : '/api/v1/upload/pdf',
		  processData: false,
		  transformRequest: function (data) {
		      var formData = new FormData();
		      formData.append('file', file);  
		      formData.append('section', section); 
		      return formData;  
		  },  
		  headers: {
		        'Content-Type': undefined
		  }
	   }).then(function(response){
	   		switch(response.data.section){
	   			case 'seminar':
	   				$scope.fields.seminar.seminar_pdf_id = parseInt(response.data.id);
	   				break;
	   			case 'knowledge':
	   				$scope.fields.seminar.knowledge_pdf_id = parseInt(response.data.id);
	   				break;
	   		}
	        console.log($scope.fields);
	   });

    };

    $scope.add = function() {
		if($scope.fields.seminar.seminar_pdf_id && $scope.fields.seminar.knowledge_pdf_id){
    		$scope.fields.seminar.start_date = Utils.saveDate($scope.fields.seminar.start);
    		$scope.fields.seminar.end_date = Utils.saveDate($scope.fields.seminar.end);
    		Seminar.save($scope.fields, function(response){
				toastr.success('บันทึกข้อมูลสำเร็จ', 'Seminar Upload');
				$scope.currentSeminarReset();
			}, function(error){
				console.log(error);
				toastr.warning('เกิดข้อผิดไม่สามารถบันทึกข้อมูลได้', 'Research Upload');
			});
		}
		else{
			toastr.warning('ยังไม่ได้แนบไฟล์', 'Research Upload');
		}
	}

	if(!Auth.checkIfLoggedIn()){
		$location.path('/auth/login');
	}

	$scope.currentSeminarReset();

}]);