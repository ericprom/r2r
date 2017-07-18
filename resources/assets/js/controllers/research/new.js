app.controller('ResearchNewController', ['$http','$http', '$scope', '$location', 'Auth', 'Research', 'toastr', 
	function ($http, $http, $scope, $location, Auth, Research, toastr) {

	$scope.dataLists = {
		types:[],
		levels:[]
	}

	$scope.fields = {
		research : {
		}
	}

	$scope.currentResearchReset = function(){
		$scope.fields = {
			research : {
			}
		}
	}

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

	$scope.change = function(section){
		document.getElementById('formResearch').click();
	}

	$scope.remove = function(section){
		delete $scope.fields.file;
		delete $scope.fields.research.research_pdf_id;
	}

	$scope.uploaded = function(section,element) {
		var file = element.files[0];
		$scope.fields.file = file;
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
	   		$scope.fields.research.research_pdf_id = parseInt(response.data.id);
	   });

    };

	$scope.add = function() {
		if($scope.fields.research.research_pdf_id){
			Research.save($scope.fields, function(response){
				toastr.success('บันทึกข้อมูลสำเร็จ', 'Research Upload');
				$scope.currentResearchReset();
			}, function(error){
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

	$scope.currentResearchReset();

}]);