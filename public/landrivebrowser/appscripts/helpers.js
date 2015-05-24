// Factories

angular.module('landriveBrowser.Drive.REST', ['ngResource']).service('Drive', function($resource , $cacheFactory) {
    this.request = $resource('/api/drive/:driveName', {driveName:'@driveName'}, {
        index:  {method:'GET' , actions:{cache:true}},
        query:  {method:'GET' , params:{path: '@path'}, actions:{cache:$cacheFactory} , isArray:false},
        info:   {method:'GET' , params:{path: '@path', info:'y'}, actions:{cache:$cacheFactory} , isArray:false},
        content:{method:'GET' , params:{path: '@path', content:'y'}, actions:{cache:$cacheFactory} , isArray:false},
        createFolder:{method:'{POST' , params:{path: '@path', type:'@directory' , name:'@name'}, actions:{cache:$cacheFactory} , isArray:false},
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

            if(imageExtensionList.indexOf(lastExtension.toLowerCase())  != -1){
                return true;
            }

            return false;

        }

        this.isText = function(filePath){
            var extensionList = filePath.split(".");
            var lastExtension = extensionList[(extensionList.length - 1)];

            var textExtensionList = [   'bat',
                                        'conf',
                                        'css',
                                        'html',
                                        'ini',
                                        'java',
                                        'js',
                                        'json',
                                        'log',
                                        'txt',
                                        'php',
                                        'sql',
                                        'svg',
                                        'xml'
                                    ];

            if(textExtensionList.indexOf(lastExtension.toLowerCase())  != -1){
                return true;
            }

            return false;

        }

        this.isAudio = function(filePath){
            var extensionList = filePath.split(".");
            var lastExtension = extensionList[(extensionList.length - 1)];

            var textExtensionList = ['mp3'];

            if(textExtensionList.indexOf(lastExtension.toLowerCase())  != -1){
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

        this.getStreamPath = function(driveName , path){
            return this.getDownloadPath(driveName,path);
        }

        this.timeConverter = function(UNIX_timestamp){
            if(UNIX_timestamp === undefined){
                UNIX_timestamp = 4100720399;
            }

            var a = new Date(UNIX_timestamp*1000);
            var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            var year = a.getFullYear();
            var month = months[a.getMonth()];
            var date = a.getDate();
            var hour = a.getHours();
            var min = a.getMinutes();
            var sec = a.getSeconds();
            var time = date + ' , ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec ;
            return time;
        }

});

// Define a simple audio service
angular.module('landriveBrowser.Music.Services', [])
    .service('MusicPlayer',function ($document) {
        var audioElement = $document[0].createElement('audio'); // <-- Magic trick here
        return {
            audioElement: audioElement,

            play: function(path) {
                audioElement.src = path;
                audioElement.play();     //  <-- Thats all you need
            }
            // Exersise for the reader - extend this service to include other functions
            // like pausing, etc, etc.
        }
    })
    .service('RemoteMusicPlayerData',function ($http , BrowseState) {

    })
    .service('Remote',function ($http) {
        var volume = 1;
        var playposition = 0 ;
        var seekposition = 0;
        var playlistArray = [];

        $http.get('/api/remotemusicplayer').
            success(function(data, status, headers, config) {
                // this callback will be called asynchronously
                // when the response is available

                var musicURL = [];
                var remotemusicplayer = data.remotemusicplayer;
                if(remotemusicplayer.length === 0){
                    // There is not data in server
                }else{

                }

            }).
            error(function(data, status, headers, config) {
                // called asynchronously if an error occurs
                // or server returns response with an error status.
            });

        this.increaseVolume = function(){
            if(volume < 1){
                volume = volume + 1;
            }

            return volume;
        }

        this.decreaseVolume = function(){
            if(volume > 0){
                volume = volume - 1;
            }

            return volume;
        }

        this.addToPlaylist = function(driveName , path){
            var newItem = {drive:driveName , path: path};
            playlistArray.push(newItem);
        }


    })
    .service('RemoteMusicPlayer',function ($http , $interval , MusicPlayer , RemoteMusicPlayerData , BrowseState) {
        // This function is used by LISTENER

        var on = false;

        this.play = function(){
            $interval(function(){
                $http.get('/api/remotemusicplayer').
                    success(function(data, status, headers, config) {
                        // this callback will be called asynchronously
                        // when the response is available

                        var musicURL = [];
                        var remotemusicplayer = data.remotemusicplayer;
                        for(i = 0 ; i < remotemusicplayer.length ; i ++){
                            playlist = JSON.parse(remotemusicplayer[i].playlist);
                            for(j = 0 ; j < playlist.length ; j++){
                                musicURL.push(BrowseState.getStreamPath(playlist[j].drive , playlist[j].path))
                            }
                            break;
                        }
                        MusicPlayer.play(musicURL[0])
                    }).
                    error(function(data, status, headers, config) {
                        // called asynchronously if an error occurs
                        // or server returns response with an error status.
                    });
            }, 2000 , 1 )
        }

    });