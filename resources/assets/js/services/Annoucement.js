app.factory('Annoucement', ['Restangular', 'Auth', function(Restangular, Auth) {
  
  function getItems(criteria, onSuccess, onError){
    Restangular.all('annoucements').getList(criteria).then(function(response){

      onSuccess(response);
    
    }, function(response){

      onError(response);

    });
  }

  function getItem(itemId, onSuccess, onError){

    Restangular.one('annoucements', itemId).get().then(function(response){

      onSuccess(response);

    }, function(response){

      onError(response);

    });

  }

  function save(data, onSuccess, onError){

    Restangular.all('annoucements').post(data).then(function(response){

      onSuccess(response);
    
    }, function(response){
      
      onError(response);
    
    });

  }

  function update(itemId, data, onSuccess, onError){

    Restangular.one("annoucements").customPUT(data, itemId).then(function(response) {
        
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