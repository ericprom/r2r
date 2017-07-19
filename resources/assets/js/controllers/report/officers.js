app.controller('ReportOfficersController', ['$scope', '$location', 'Auth', 'Utils', 'Report' ,'toastr', 
	function ($scope, $location, Auth, Utils, Report, toastr) {
		
	$scope.currentPage = 1;
	$scope.numPerPage = 10;
	$scope.maxSize = 5;

	$scope.dataLists = {
		officers:[],
		timers: [
	        { id: 'yesterday', name: 'Yesterday' },
	        { id: 'today', name: 'Today' },
	        { id: 'custom', name: 'Custom' }
	    ],
	    status: [
		    { id:0, name:'โสด' },
			{ id:1, name:'แต่งงาน' },
			{ id:2, name:'หย่าร้าง' }
		],
		genders:[
			{ id:0, name:'หญิง' },
			{ id:1, name:'ชาย' }
		]
	};
	
	$scope.fields = {
		officer:{},
		timer: $scope.dataLists.timers[1],
		start: Utils.displayDate(moment().startOf('day')),
		end: Utils.displayDate(moment().endOf('day'))
	}

	$scope.loadData = function(){

		$scope.$watch('currentPage + numPerPage', function() {
			var begin = (($scope.currentPage - 1) * $scope.numPerPage);
			var end = $scope.numPerPage;
			var criteria = {
				skip: begin, 
				limit: end, 
				from: Utils.saveDate($scope.fields.start)+' 00:00:00', 
				to: Utils.saveDate($scope.fields.end)+' 23:59:59'
			};
			Report.officers(criteria, function(response){
				$scope.dataLists.officers = response;
				$scope.total = response.resultmeta.total;
			}, function(error){
				console.log(error);
			});
		});
	}
	
	$scope.numPages = function () {
    	return Math.ceil($scope.total / $scope.numPerPage);
  	};

	$scope.changeTime = function() {

        if($scope.fields.timer !== 'custom') {
            var filter = Utils.dateFilter($scope.fields.timer.id);
            $scope.fields.start = filter.start;
            $scope.fields.end = filter.end;
        }

    };

	$scope.updateFilter = function () {
        
        $scope.fields.timer = { id: 'custom', name: 'Custom' };

    };

	$scope.search = function(){
		$scope.loadData();
	}

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

	$scope.view = function(item){
		$scope.fields.officer.user = item;
		$scope.fields.officer.info = item.info;
		$scope.fields.officer.work = item.work;
		$scope.fields.officer.edu = item.edu;
		$('#viewOfficerModal').modal('toggle');
	}

	if(!Auth.checkIfLoggedIn()){
		$location.path('/auth/login');
	}

	$scope.loadData();

}]);