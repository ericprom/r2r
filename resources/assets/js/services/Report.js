app.factory('Report', ['Restangular', 'Auth', function(Restangular, Auth) {

  function researches(criteria, onSuccess, onError){
    Restangular.all('report/researches').getList(criteria).then(function(response){

      onSuccess(response);
    
    }, function(response){

      onError(response);

    });
  }

  function seminars(criteria, onSuccess, onError){
    Restangular.all('report/seminars').getList(criteria).then(function(response){

      onSuccess(response);
    
    }, function(response){

      onError(response);

    });
  }

  function officers(criteria, onSuccess, onError){
    Restangular.all('report/officers').getList(criteria).then(function(response){

      onSuccess(response);
    
    }, function(response){

      onError(response);

    });
  }

  Restangular.setDefaultHeaders({ 'Authorization' : 'Bearer ' + Auth.getCurrentToken() });

  return {
    researches:researches,
    seminars:seminars,
    officers:officers
  }

}]);
