app.controller('ReportResearchesController', ['$scope', '$location', 'Auth', 'Utils', 'Report' ,'toastr', 
	function ($scope, $location, Auth, Utils, Report, toastr) {
		
	$scope.currentPage = 1;
	$scope.numPerPage = 10;
	$scope.maxSize = 5;

	$scope.dataLists = {
		researches:[],
		timers: [
	        { id: 'yesterday', name: 'Yesterday' },
	        { id: 'today', name: 'Today' },
	        { id: 'custom', name: 'Custom' }
	    ],
	    types: [
	    	{ id:1, name:'วิจัย' },
	    	{ id:2, name:'ผลงานสร้างสรรค์' },
	    	{ id:3, name:'บทความ' },
	    	{ id:4, name:'เอกสาร' }
	    ],
	    levels:[
	    	{ id:1, name:'ระดับชาติ' },
	    	{ id:2, name:'ระดับนานาชาติ' }
	    ]
	};
	
	$scope.fields = {
		timer: $scope.dataLists.timers[1],
		start: Utils.displayDate(moment().startOf('day')),
		end: Utils.displayDate(moment().endOf('day'))
	}

	$scope.getTypeDetail = function(item_id){
		if(item_id){
			var item_detail = _($scope.dataLists.types).find({id: item_id}) || {};
			return item_detail;
		}
	}
	$scope.getLevelDetail = function(item_id){
		if(item_id){
			var item_detail = _($scope.dataLists.levels).find({id: item_id}) || {};
			return item_detail;
		}
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
			Report.researches(criteria, function(response){
				$scope.dataLists.researches = response;
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

	$scope.loadData();

	if(!Auth.checkIfLoggedIn()){
		$location.path('/auth/login');
	}

}]);