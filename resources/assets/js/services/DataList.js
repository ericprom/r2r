app.factory('DataList', ['Restangular', 'Auth', function(Restangular, Auth) {

  function products(onSuccess, onError){
    Restangular.all('products').getList().then(function(response){

      onSuccess(response);
    
    }, function(response){

      onError(response);

    });
  }

  Restangular.setDefaultHeaders({ 'Authorization' : 'Bearer ' + Auth.getCurrentToken() });

  return {
    products:products
  }

}]);
