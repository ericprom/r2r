app.directive('format', ['$filter', function ($filter) {
    return {
        require: '?ngModel',
        link: function (scope, elem, attrs, ctrl) {
            if (!ctrl) return;

            ctrl.$formatters.unshift(function (a) {
            	return ctrl.$modelValue
            	if (attrs.format === 'currency'){
                	return $filter(attrs.format)(ctrl.$modelValue,'')
            	} else {
                	return $filter(attrs.format)(ctrl.$modelValue)
            	}
            });


            ctrl.$parsers.unshift(function (viewValue) {
                return viewValue
                var plainNumber = viewValue.replace(/[^\d|\-+|\.+]/g, '');
                if (attrs.format === 'currency'){
                	elem.val($filter(attrs.format)(plainNumber, ''));
            	} else {
                	elem.val($filter(attrs.format)(plainNumber));
            	}

                return plainNumber;
            });
        }
    };
}]);
