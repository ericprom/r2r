app.factory('User', ['Restangular', 'Auth', function(Restangular, Auth) {
  
  function getItems(criteria, onSuccess, onError){
    Restangular.all('users').getList(criteria).then(function(response){

      onSuccess(response);
    
    }, function(response){

      onError(response);

    });
  }

  function getItem(itemId, onSuccess, onError){

    Restangular.one('users', itemId).get().then(function(response){

      onSuccess(response);

    }, function(response){

      onError(response);

    });

  }

  function save(data, onSuccess, onError){

    Restangular.all('users').post(data).then(function(response){

      onSuccess(response);
    
    }, function(response){
      
      onError(response);
    
    });

  }

  function update(itemId, data, onSuccess, onError){

    Restangular.one("users").customPUT(data, itemId).then(function(response) {
        
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