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

angular.module('landriveBrowser').controller('BrowseCtrl',  function ($scope , $location , $cacheFactory ,Drive , BrowseState) {

    var locationParams = $location.search();

    $scope.driveName = locationParams.driveName;
    $scope.path = '';

    $scope.getDriveName = function(){
        return $scope.driveName;
    };

    $scope.getPath = function(){
        return $scope.path;
    }

    $scope.getDownloadPath = function(filePath){
        var downloadPath = 'api/drive/'+$scope.getDriveName()+'?path='+$scope.getPath()+'&download=y';
        return downloadPath;
    }

    $scope.cache = $cacheFactory('mainCache');

    $scope.browse = function(driveName,path){

        $scope.path = path;

        var cacheKey = driveName+path;

        var cacheData = $scope.cache.get(cacheKey);

        if (cacheData === undefined) {
            $scope.data = {'files' : [] , 'directories' : []};
//            $scope.keys.push(cacheKey);
            Drive.request.query({driveName: driveName , path: path},function(data){
                $scope.data =  data[driveName];
                $scope.cache.put(cacheKey, $scope.data === undefined ? null : $scope.data);
            });
        }else{
            $scope.data = cacheData;
        }

    }

    $scope.browse($scope.driveName ,$scope.path) ; // FIRST Browse

});