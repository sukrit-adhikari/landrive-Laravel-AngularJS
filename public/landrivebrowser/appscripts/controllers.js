angular.module('landriveBrowser').controller('AuthenticationCtrlLogin', function ($scope ,
                                                                             $location ,
                                                                             $cookies,
                                                                             Authentication) {

    $scope.alerts = [];

    $scope.authenticateMe = function(){

       var landriveusername = $scope.landriveusername;
       var password = $scope.password;
       Authentication.getAccessToken( landriveusername , password)
                     .then(function(all){
                        var date = new Date();
                        var currentTime = date.getHours()+":"+date.getMinutes()+":"+date.getSeconds();
                        var message = currentTime+" | "+all.data.Message;

                        if(all.data.Status === 0){



                          var alert = {message: message};
                          $scope.alerts = [alert];

                        }else{

                          var alert = {message:message};
                          $scope.alerts = [alert];

                          $cookies.landriveaccesstoken = all.data.Token;
                          $cookies.landriveusername = landriveusername;

                          $scope.gotoBrowsePage();

                        }
                     });
    }

    $scope.gotoBrowsePage = function(){
        $location.path('/browse');
    }

});


angular.module('landriveBrowser').controller('AuthenticationCtrlLogout', function ($scope ,
                                                                                   $location ,
                                                                                   $cookieStore,
                                                                                   $cookies,
                                                                                   Authentication) {

    var alert = {message : 'Loggin Out'};
    $scope.alerts = [];

    $scope.revokeMe = function(){
        Authentication.revokeAccessToken()
            .then(function(all){
                var alert = {type:'danger' , message:all.data.Message};
                $scope.alerts = [alert];
                angular.forEach($cookies, function (v, k) {
                    $cookieStore.remove(k);
                });
            })
    }

    $scope.revokeMe();

});




angular.module('landriveBrowser').controller('HomeCtrl', function ($scope , $location  , Drive ) {

    $scope.browseDrives = function(){
        $location.path('/browse');
    }

});

angular.module('landriveBrowser').controller('BrowseCtrl',  function ($scope ,
                                                                      $location ,
                                                                      $cacheFactory ,
                                                                      Drive ,
                                                                      BrowseState) {

    var locationParams = $location.search();

    $scope.drives = Drive.request.index();

    $scope.path = '';

    $scope.driveName = locationParams.driveName;

    $scope.searchBarActive = false;

    $scope.showSearchBar = function(){
        $scope.searchBarActive = true;
    }

    $scope.hideSearchBar = function(){
        $scope.searchBarActive = false;
    }

    $scope.pathArray = [];

    $scope.getPathLength = function(){
        return $scope.pathArray.length;
    }

    $scope.getDriveName = function(){
        return $scope.driveName;
    };

    $scope.setDriveName = function(dName){
        $scope.driveName = dName;
    };

    $scope.getPath = function(){
        return $scope.path;
    }

    $scope.getDownloadPath = function(path){
        var downloadPath = 'api/drive/'+$scope.getDriveName()+'?path='+path+'&download=y';
        return downloadPath;
    }

    $scope.download = function(driveName,path){
        Drive.request.download({driveName: driveName , path: path});
    }

    $scope.isBrowsing = function(path){
        if($scope.browsingPath == path){
            return true;
        }
        return false;
    }

    $scope.gotoLogout = function(){
        BrowseState.gotoLogout();
    }

    $scope.splitPath = function(path){
        return BrowseState.splitPath(path);
    }

    $scope.reverseSplitPath = function(path){
        return BrowseState.reverseSplitPath(path);
    }

    $scope.cache = $cacheFactory('mainCache' + Math.random());

    $scope.browse = function(driveName,path){

        $scope.setDriveName(driveName);

        if($scope.driveName === undefined){
            $scope.topBrowseMessage = "No Drive Selected!";
            return;
        }else{
            $scope.topBrowseMessage = "Drive contents.";
        }

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

        $scope.pathArray = BrowseState.getPathArray($scope.path);

    }

    $scope.browse($scope.driveName ,$scope.path) ; // FIRST Browse

});

