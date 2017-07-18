app.factory('Auth', ['$timeout', '$http', '$localStorage', 'Restangular', function($timeout, $http, $localStorage, Restangular) {

	function checkIfLoggedIn() {

    $timeout(function(){
      $(window).trigger('resize');
    });

		if (typeof $localStorage.token === 'undefined') {
    	return false;
  	}
  	else{
  		return true;
  	}
    
	}

  function login(email, password, onSuccess, onError){

    $http.post('/api/v1/auth/login', 
    {
      email: email,
      password: password
    }).
    then(function(response) {
      $localStorage.token = response.data.token;
      onSuccess(response);

    }, function(response) {

      onError(response);

    });

  }

	function logout(){
		delete $localStorage.token;
  }

  function getCurrentToken(){
    return $localStorage.token;
  }

  function getByToken(onSuccess, onError){

    Restangular.one('auth/getByToken').get().then(function(response){

      onSuccess(response);

    }, function(response){

      onError(response);

    });

  }

	return {
		checkIfLoggedIn: checkIfLoggedIn,
    login:login,
		logout: logout,
    getCurrentToken: getCurrentToken,
    getByToken:getByToken
	}

}]);