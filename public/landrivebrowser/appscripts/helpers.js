// Factories

angular.module('landriveBrowser.Drive.REST', ['ngResource']).service('Drive', function($resource , $cacheFactory) {
    this.request = $resource('/api/drive/:driveName', {driveName:'@driveName'}, {
        index:  {method:'GET' , actions:{cache:true}},
        query:  {method:'GET' , params:{path: '@path'}, actions:{cache:$cacheFactory} , isArray:false},
        info:   {method:'GET' , params:{path: '@path', info:'y'}, actions:{cache:$cacheFactory} , isArray:false},
        post:   {method:'POST'},
        update: {method:'PUT'},
        remove: {method:'DELETE'},
        download: {method:'GET' , params:{path: '@path' , download: 'y'} , isArray:false}
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
            })
            return response;
        },

        revokeAccessToken: function(){
            response =   $http({
                method: 'POST',
                url: "/api/token/revoke"
            })
            return response;
        }
    };
});




// Services
// are singletons


angular.module('landriveBrowser.Browser.Services', []).service('BrowseState', function($location){

        this.reverseSplitPath = function(path){

            var maxsize = 32;

            if(path.length > maxsize){

                var start = (path.length-1) - maxsize;
                var end = path.length ;

                return '..' + path.substring(start,end);

            }else{
                return path;
            }
        }

        this.splitPath = function(path){
            var pathArray = path.split('\\');
            var name = pathArray[(pathArray.length -1 )];

            var maxSize = 32;

            if(name.length > maxSize){
                name = name.substring(0, maxSize)+"..";
            }

            return name;
        }

        this.getDownloadPath = function(driveName,path){
            var downloadPath = 'api/drive/'+driveName+'?path='+path+'&download=y';
            return downloadPath;
        }

        this.getPathArray = function(path){

            var points = path.split("\\");

            var k = 0;

            var pathsArray = new Array();

            for(i = 0 ; i < points.length ; i++){
                string = "";
                for(j = 0 ; j <= i ; j ++){
                    if(j == i){
                        string+=points[j];
                    }else{
                        string+=points[j]+"\\";
                    }
                }
                var path = {'name' : points[i] , 'path' : string};
                pathsArray.push(path);
            }

            return pathsArray;
        }

        this.gotoLogout = function(){
            $location.path('/logout');
        }

});


