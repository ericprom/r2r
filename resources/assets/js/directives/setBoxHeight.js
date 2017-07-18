app.directive('setBoxHeight', ['$window', function($window){
  return{
    link: function(scope, element, attrs){
      var height = $window.innerHeight-250;
      element.css('height', height + 'px');
      element.css('overflow-y', 'scroll');
    }
  }
}]);