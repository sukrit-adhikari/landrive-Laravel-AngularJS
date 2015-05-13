var landriveBrowserApp = angular.module('landriveBrowser');

landriveBrowserApp.config(function($routeProvider , $locationProvider) {
    $routeProvider
//        .when('/', {
//            templateUrl: 'mobile/angular/partials/home',
//            controller: 'HomeCtrl'
//        })
        .when('/browse', { //.when('/browse', {
            templateUrl: 'mobile/angular/partials/browse',
            controller: 'BrowseCtrl'
        })
        .when('/', {
            templateUrl: 'mobile/angular/partials/browse',
            controller: 'BrowseCtrl'
        })
//        .when('/drives/:drive/view/:path/file', {
//            templateUrl: 'mobile/angular/partials/view',
//            controller: ''
//        })
        .when('/login', {
            templateUrl: 'mobile/angular/partials/login',
            controller: 'AuthenticationCtrlLogin'
        })
        .when('/logout', {
            templateUrl: 'mobile/angular/partials/logout',
            controller: 'AuthenticationCtrlLogout'
        })

    // use the HTML5 History API
//    $locationProvider.html5Mode(true);

});