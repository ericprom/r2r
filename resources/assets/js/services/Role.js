app.factory('Role', ['Restangular', 'Auth', function(Restangular, Auth) {
  
  function getItems(onSuccess, onError){
    Restangular.all('roles').getList().then(function(response){

      onSuccess(response);
    
    }, function(response){

      onError(response);

    });
  }

  function getItem(itemId, onSuccess, onError){

    Restangular.one('roles', itemId).get().then(function(response){

      onSuccess(response);

    }, function(response){

      onError(response);

    });

  }

  function save(data, onSuccess, onError){

    Restangular.all('roles').post(data).then(function(response){

      onSuccess(response);
    
    }, function(response){
      
      onError(response);
    
    });

  }

  function update(itemId, data, onSuccess, onError){

    Restangular.one("roles").customPUT(data, itemId).then(function(response) {
        
        onSuccess(response);

      }, function(response){
        
        onError(response);
      
      }
    );

  }

  Restangular.setDefaultHeaders({ 'Authorization' : 'Bearer ' + Auth.getCurrentToken() });

  return {
    getItems: getItems,
    getItem:getItem,
    save:save,
    update:update
  }

}]);