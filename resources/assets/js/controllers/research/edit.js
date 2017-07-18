app.controller('ResearchEditController', ['$routeParams', '$scope', '$location', 'Auth', 'Research', 'toastr', 
	function ($routeParams, $scope, $location, Auth, Research, toastr) {

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

	$scope.fields = {
		research: {}
	}

	$scope.currentResearchReset = function(){
		$scope.fields = {
			research: {}
		}
	}

	$scope.remove = function(section){
		delete $scope.fields.file;
		delete $scope.fields.research.research_pdf_id;
	}

	$scope.setSource = function(file){
		$scope.fields.file = file;
		$scope.fields.research.research_pdf_id = parseInt(file.id);
	}

	$scope.getResearch = function(){
		var get = angular.fromJson(atob($routeParams.id));
		Research.getItem(get.research, function(response){
			$scope.fields.research = response;
			$scope.setSource(response.research);
		}, function(error){
			console.log(error);
		});
	}

	$scope.update = function(){
		if($scope.fields.research.id && $scope.fields.research.research_pdf_id){
			Research.update($scope.fields.research.id, $scope.fields, function(response){
				toastr.success('บันทึกข้อมูลสำเร็จ', 'Research Update');
			}, function(error){
				console.log('error',error);
			});
    	}
    	else{
			toastr.warning('ยังไม่ได้แนบไฟล์', 'Research Update');
    	}
	}

	$scope.delete = function(){
		$('#deleteResearchModal').modal('toggle');
	}

	$scope.deleteReseach = function(){
		$scope.fields.research.active = 0;
		Research.update($scope.fields.research.id, $scope.fields, function(response){
			$location.path('/research/lists/');
		}, function(error){
			console.log('error',error);
		});
		$('#deleteResearchModal').modal('toggle');
	}

	if(!Auth.checkIfLoggedIn()){
		$location.path('/auth/login');
	}

	$scope.getResearch();

}]);