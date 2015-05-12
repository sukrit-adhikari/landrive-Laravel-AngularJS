angular.module('landriveBrowser', ['ngRoute' ,
                                   'ui.bootstrap',
                                   'landriveBrowser.Drive.REST',        // Dependency List
                                   'landriveBrowser.Authentication',
                                   'landriveBrowser.Browser.Services',
                                   'ngCookies',
                                  ]
)
.config(function ($routeProvider, $locationProvider, $httpProvider) {
    $httpProvider.interceptors.push('authInterceptor');
})
.factory('authInterceptor', function ($rootScope, $q, $cookieStore, $location) {
    return {
        request: function (config) {
            return config;
        },

        // Tasks:
        // *Intercept 401s and redirect you to login
        response: function(config) {
            if(config.data.Code === 401){
                $location.path('/login');
            }
            return config;
        }
    };
});