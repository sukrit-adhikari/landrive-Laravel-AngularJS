angular.module('landriveBrowser', ['ngRoute' ,
                                   'ui.bootstrap',
                                   'landriveBrowser.Drive.REST',        // Dependency List
                                   'landriveBrowser.Authentication',
                                   'landriveBrowser.Browser.Services',
                                   'ngCookies'
                                  ]
)
.directive('animateClick', function() {
    return function(scope, element, attrs) {
        scope.$watch(attrs.animateMe, function() {
            element.show(300).delay(900).hide(300);
        })
    }
})
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
            if(config.data.Code === 500){
               alert('Server encounterd the following error: \n '+config.data.Message);
            }

            if(config.data.Code === 401){
                $location.path('/login');
            }
            return config;
        }
    };
});