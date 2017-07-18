app.controller('SeminarEditController', ['$routeParams', '$scope', '$location', 'Auth', 'Utils', 'Seminar', 'toastr', 
	function ($routeParams, $scope, $location, Auth, Utils, Seminar, toastr) {

	$scope.dataLists = {
		researches:[]
	};

	$scope.fields = {
		seminar: {}
	}

	$scope.remove = function(section){
		switch(section){
   			case 'seminar':
				delete $scope.fields.seminar_file
				delete $scope.fields.seminar.seminar_pdf_id;
   				break;
   			case 'knowledge':
				delete $scope.fields.knowledge_file;
				delete $scope.fields.seminar.knowledge_pdf_id;
   				break;
   		}
	}

	$scope.setSeminarFile = function(file){
		$scope.fields.seminar_file = file;
		$scope.fields.seminar.seminar_pdf_id = parseInt(file.id);
	}
	$scope.setKnowledgeFile = function(file){
		$scope.fields.knowledge_file = file;
		$scope.fields.seminar.knowledge_pdf_id = parseInt(file.id);
	}

	$scope.getSeminar = function(){
		var get = angular.fromJson(atob($routeParams.id));
		Seminar.getItem(get.seminar, function(response){
			$scope.fields.seminar = response;
    		$scope.fields.seminar.start = Utils.displayDate(response.start_date);
    		$scope.fields.seminar.end = Utils.displayDate(response.end_date);
			$scope.setSeminarFile(response.seminar);
			$scope.setKnowledgeFile(response.knowledge);
		}, function(error){
			console.log(error);
		});
	}

	$scope.update = function(){
		if($scope.fields.seminar.id && $scope.fields.seminar.seminar_pdf_id && $scope.fields.seminar.knowledge_pdf_id){
    		$scope.fields.seminar.start_date = Utils.saveDate($scope.fields.seminar.start);
    		$scope.fields.seminar.end_date = Utils.saveDate($scope.fields.seminar.end);
			Seminar.update($scope.fields.seminar.id, $scope.fields, function(response){
				toastr.success('บันทึกข้อมูลสำเร็จ', 'Seminar Update');
			}, function(error){
				console.log('error',error);
			});
    	}
    	else{
			toastr.warning('ยังไม่ได้แนบไฟล์', 'Seminar Update');
    	}
	}

	$scope.delete = function(){
		$('#deleteSeminarModal').modal('toggle');
	}

	$scope.removeSeminar = function(){
		$scope.fields.seminar.active = 0;
		Seminar.update($scope.fields.seminar.id, $scope.fields, function(response){
			$location.path('/seminar/lists/');
		}, function(error){
			console.log('error',error);
		});
		$('#deleteSeminarModal').modal('toggle');
	}

	if(!Auth.checkIfLoggedIn()){
		$location.path('/auth/login');
	}

	$scope.getSeminar();

}]);