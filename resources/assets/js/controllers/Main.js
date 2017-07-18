app.controller('MainController', ['$timeout', '$scope', '$location', '$localStorage','Auth',
  function ($timeout, $scope, $location, $localStorage,Auth) {
  
    $timeout(function(){
      $(window).trigger('resize');
    });

    $scope.isActive = function (route) {
      return route === $location.path();
    };

    $scope.getAuthenticatedUser = function () {
      if (Auth.checkIfLoggedIn()) {
        Auth.getByToken(function(response){
          $scope.authenticatedUser = response;
        }, function(error){
          $location.path('/auth/login');
        });
      }
      else{
        $location.path('/auth/login');
      }
    };

    $scope.logout = function(){
      Auth.logout();
      $scope.authenticatedUser = null;
      $location.path('/auth/login');
    }

    $scope.getInclude = function(section){
      if($scope.authenticatedUser!=null){
        return "layouts/"+section;
      }
    }


  }
]);
