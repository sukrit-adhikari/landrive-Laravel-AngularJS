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

        this.reverseSplit = function(path ,maximumSize ){

            if(maximumSize === undefined){
                var maxSize = 32;
            }else{
                var maxSize = maximumSize;
            }

            if(path.length > maxSize){

                var start = (path.length-1) - maxSize;
                var end = path.length ;

                return '..' + path.substring(start,end);

            }else{
                return path;
            }
        }

        this.split = function(path , maximumSize, ellipsis){
            var pathArray = path.split('\\');
            var name = pathArray[(pathArray.length -1 )];
            if(maximumSize === undefined){
                var maxSize = 32;
            }else{
                var maxSize = maximumSize;
            }

            var elpsis = '';
            if(ellipsis === undefined){
                elpsis = "..";
            }

            if(name.length > maxSize){
                name = name.substring(0, maxSize)+elpsis;
            }

            return name;
        }

        this.getDownloadPath = function(driveName,path){
            var downloadPath = 'api/drive/'+driveName+'?path='+path+'&download=y';
            return downloadPath;
        }

        this.isImage = function(filePath){
            var extensionList = filePath.split(".");
            var lastExtension = extensionList[(extensionList.length - 1)];

            var imageExtensionList = ['jpg' , 'jpeg' , 'png', 'gif'];
            var musicExtensionList = ['mp3'];

            if(imageExtensionList.indexOf(lastExtension.toLowerCase())  != -1){
                return true;
            }

            return false;

        }

        this.getImageSrcPath = function(driveName,path){
            var imageSrcPath = 'api/drive/'+driveName+'?path='+path+'&image=y';
            return imageSrcPath;
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

        this.getDownloadPath = function(driveName , path){
            var downloadPath = 'api/drive/'+driveName+'?path='+path+'&download=y';
            return downloadPath;
        }

        this.timeConverter = function(UNIX_timestamp){
            var a = new Date(UNIX_timestamp*1000);
            var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            var year = a.getFullYear();
            var month = months[a.getMonth()];
            var date = a.getDate();
            var hour = a.getHours();
            var min = a.getMinutes();
            var sec = a.getSeconds();
            var time = date + ',' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec ;
            return time;
        }

});


