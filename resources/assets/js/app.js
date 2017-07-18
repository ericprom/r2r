var app = angular.module('adminApp', ['angular-underscore','angularMoment', 'ngRoute', 'ngStorage', 'ui.bootstrap', 'ui.select', 'ngSanitize', 'restangular', 'toastr']);

app.config(['uiSelectConfig', function(uiSelectConfig) {
    uiSelectConfig.theme = 'bootstrap';
}]);

app.config(['$qProvider', function ($qProvider) {
    $qProvider.errorOnUnhandledRejections(false);
}]);

app.config(['RestangularProvider', function (RestangularProvider) {
    RestangularProvider.setBaseUrl('/api/v1/');
    RestangularProvider.addResponseInterceptor(function(data, operation) {
      var response = data;
      if (operation === "getList") {
        response = data.result;
        response.resultmeta = {
          "total": data.total
        }
      } else {
        response = data.result;
      }
      return response;
    });
}]);

app.config(['$routeProvider', '$locationProvider', '$httpProvider',
  function ($routeProvider, $locationProvider, $httpProvider) {
    
    $routeProvider
      .when('/', {
        templateUrl: '/partials/index'
      })
      .when('/:category/:action?/:id?', {
        templateUrl: function (params) {
          var allowedParams = ['category', 'action', 'id'];
          var paramVals = [];
          for (var key in params) {
            if (allowedParams.indexOf(key) !== -1) {
              paramVals.push(params[key]);
            }
          }
          return '/partials/' + paramVals.join('/');
        }
      })
      .otherwise({
        redirectTo: '/'
      });
    
    $locationProvider.html5Mode(true);
    $httpProvider.interceptors.push(['$rootScope', '$q', '$localStorage',
      function ($rootScope, $q, $localStorage) {
        return {
          request: function (config) {
            config.headers = config.headers || {};
            if ($localStorage.token) {
              config.headers.Authorization = 'Bearer ' + $localStorage.token;
            }
            return config;
          },
          response: function (res) {
            if (res.status === 401) {
              // Handle unauthenticated user.
            }
            return res || $q.when(res);
          }
        };
      }
    ]);
  }
]);