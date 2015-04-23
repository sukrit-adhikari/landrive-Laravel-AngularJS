// Factories



// Services


angular.module('landriveBrowser.RESTService', ['ngResource']).factory('Drive', function($resource) {

    return $resource('/api/drive', {}, {
        query: { method:'GET' , isArray:false}
    });

//    return $resource('/api/drive');

});

angular.module('landriveBrowser.AuthenticationService', []).factory('Authentication', function($http) {
    return {
         getAccessToken: function(landriveusername , password){
          response =   $http({
                            method: 'POST',
                            url: "/api/token/new",
                            params: {'landriveusername' : landriveusername , 'password' : password},
                            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8'}
                        });
          return response;
        }
    };
});

