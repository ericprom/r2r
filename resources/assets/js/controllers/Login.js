app.controller('LoginController', ['$scope', '$localStorage', '$location', 'Auth',
  function ($scope, $localStorage, $location, Auth) {
    $scope.login = function () {
      Auth.login(
        this.email, this.password,
        function(response){
          $scope.getAuthenticatedUser();
          $location.path('/');
        },
        function(err){
          console.log(err);
        }
      );
    };

    if (Auth.checkIfLoggedIn()) {
      $location.path('/');
    }
  }
]);
