// Factories

angular.module('landriveBrowser.Drive.REST', ['ngResource']).service('Drive', function($resource , $cacheFactory) {
    this.request = $resource('/api/drive/:driveName', {driveName:'@driveName'}, {
        index:  {method:'GET' , actions:{cache:true}},
        query:  {method:'GET' , params:{path: '@path'}, actions:{cache:$cacheFactory} , isArray:false},
        post:   {method:'POST'},
        update: {method:'PUT'},
        remove: {method:'DELETE'}
    });
});

angular.module('landriveBrowser.Authentication', []).factory('Authentication', function($http) {
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


//angular.module('landriveBrowser.RequestCache', []).factory('RequestCache', function ($cacheFactory) {
//    return $cacheFactory('requestCache');
//});


// Services
// are singletons


angular.module('landriveBrowser.Browser.Services', []).service('BrowseState', function(){

        var drive = 'D';
        var path = '';

        this.getDrive = function(){
            return drive;
        }

        this.setDrive = function(newDrive){
            drive = newDrive;
        }

        this.getPath = function(){
            return path;
        }

        this.setPath = function(newPath){
            path = newPath;
        }


        this.getPathArray = function(path){

        }

});


