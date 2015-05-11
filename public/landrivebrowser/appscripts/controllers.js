angular.module('landriveBrowser').controller('AuthenticationCtrl', function ($scope , $location , Authentication) {

    $scope.authenticateMe = function(){
       Authentication.getAccessToken($scope.landriveusernam , $scope.password)
                     .then(function(all){

                     });
    }

});

angular.module('landriveBrowser').controller('HomeCtrl', function ($scope , $location  , Drive ) {

    $scope.refresh = function(){
        $scope.drives = Drive.request.index();
    }

    $scope.refresh(); // Refresh to load First Content

    $scope.browseDrive = function(drivename){
        $location.path('/browse').search({driveName: drivename});;
    }

});

angular.module('landriveBrowser').controller('BrowseCtrl',  function ($scope ,
                                                                      $location ,
                                                                      $cacheFactory ,
                                                                      Drive ,
                                                                      BrowseState) {

    var locationParams = $location.search();

    $scope.drives = Drive.request.index();

    $scope.driveName = locationParams.driveName;
    $scope.path = '';

    $scope.pathArray = [];

    $scope.getDriveName = function(){
        return $scope.driveName;
    };

    $scope.setDriveName = function(dName){
        $scope.driveName = dName;
    };


    $scope.getPath = function(){
        return $scope.path;
    }

    $scope.getDownloadPath = function(filePath){
        var downloadPath = 'api/drive/'+$scope.getDriveName()+'?path='+filePath+'&download=y';
        return downloadPath;
    }

    $scope.isBrowsing = function(path){
        if($scope.browsingPath == path){

//            alert(path)
            return true;
        }
        return false;
    }


    $scope.splitPath = function(path){
        var pathArray = path.split('\\');
        var name = pathArray[(pathArray.length -1 )];

        var maxSize = 32;

        if(name.length > maxSize){
            name = name.substring(0, maxSize)+"...";
        }

        return name;
    }

    $scope.reverseSplitPath = function(path){

        var maxsize = 5;

        if(path.length > maxsize){

            var start = (path.length-1) - maxsize;
            var end = path.length ;

            return '...' + path.substring(start,end);

        }else{
            return path;
        }


    }




    $scope.cache = $cacheFactory('mainCache');

    $scope.browse = function(driveName,path){

        $scope.setDriveName(driveName);

        $scope.browsingPath = path;

        var cacheKey = driveName+path+"data";

        var cacheData = $scope.cache.get(cacheKey);

        if (cacheData === undefined) {
            Drive.request.query({driveName: driveName , path: path},function(data){
                $scope.data =  data;
                $scope.cache.put(cacheKey, $scope.data === undefined ? null : $scope.data);
            });
        }else{
            $scope.data = cacheData;
        }

        $scope.path = path;


        var points = $scope.path.split("\\");

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

        if(points.length > 0 ){
            $scope.pathArray = pathsArray;
        }
    }

    $scope.browse($scope.driveName ,$scope.path) ; // FIRST Browse

});