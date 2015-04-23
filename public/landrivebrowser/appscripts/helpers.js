// Factories

angular.module('landriveBrowser.Drive.REST', ['ngResource']).factory('Drive', function($resource) {
    return $resource('/api/drive/:driveName', {driveName:'@driveName'}, {
        index:  {method:'GET'},
        query:  {method:'GET' , params:{path: '@path'}, isArray:false},
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


// Services
// are singletons


angular.module('landriveBrowser.Browser.Services', []).service('BrowseState', function(){

        var drive = 'D';
        var path = '';

        this.getDrive = function(){
            return drive;
        }

        this.setDrive = function(newDrive){
            console.log("New Drive Set : " +newDrive);
            drive = newDrive;
        }

        this.getPath = function(){
            return path;
        }

        this.setPath = function(newPath){
            path = newPath;
        }

});