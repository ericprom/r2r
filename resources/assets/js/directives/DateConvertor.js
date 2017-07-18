app.filter('dateonly', function(){
	return function(input){
		
		if(!input){
			return;
		}
		
		var date = moment(input);
		var date_fragment = [];
		date_fragment.push(date.format('DD'));
		date_fragment.push(date.format('MM'));
		date_fragment.push(date.format('YYYY'));
		return date_fragment.join('/');
		
	}
})