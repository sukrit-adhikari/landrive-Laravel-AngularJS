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
                                                                      $modal,
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


    $scope.isDriveSelected = function(){
        if($scope.driveName === undefined){
            return false;
        }
        return true;
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

        return BrowseState.getDownloadPath($scope.getDriveName(), path)

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

    $scope.split = function(path){
        return BrowseState.split(path);
    }

    $scope.reverseSplit = function(path){
        return BrowseState.reverseSplit(path);
    }

    $scope.cache = $cacheFactory('mainCache' + Math.random());

    $scope.browse = function(driveName,path){

        $scope.setDriveName(driveName);

        if($scope.driveName === undefined){
            $scope.topBrowseMessage = "Drive list.";
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
                $scope.pathArray = BrowseState.getPathArray($scope.path);
            });
        }else{
            $scope.data = cacheData;
        }

        $scope.path = path;



    }

    $scope.viewData = {};

    $scope.setViewData = function(driveName , path){
        var viewDataInstance = {driveName : driveName, path : path};
        $scope.viewData = viewDataInstance;
    }

    $scope.getViewData = function(){
        return $scope.viewData;
    }

    $scope.view = function(driveName , path ){
        $scope.setViewData(driveName, path);
        $scope.viewInModal();
    }

    $scope.viewInModal = function () {

        var modalInstance = $modal.open({
            templateUrl: 'mobile/angular/partials/view',
            controller: 'ViewModalCtrl',
            size: 'lg',
            resolve: {
                viewData: function () {
                    return $scope.getViewData();
                },
                fileList: function () {
                    return $scope.data.files;
                }
            }
        });

        modalInstance.result.then(function (selectedItem) {

        }, function () {
//            $log.info('Modal dismissed at: ' + new Date());
        });
    };

    $scope.browse($scope.driveName ,$scope.path) ; // FIRST Browse

});


angular.module('landriveBrowser').controller('ViewModalCtrl', function ($scope,
                                                                        $modalInstance,
                                                                        Drive,
                                                                        BrowseState,
                                                                        fileList,
                                                                        viewData) {

    $scope.viewData = viewData;

    $scope.browseIndex = fileList.indexOf($scope.viewData.path);

    $scope.viewNext = function(){
        $scope.viewData.path = fileList[($scope.browseIndex + 1)];
        $scope.gotInfo = false;
    }

    $scope.info = {};

    $scope.gotInfo = false;

    Drive.request.info({driveName: viewData.driveName , path: viewData.path},function(data){
        $scope.info =  data;
        $scope.gotInfo = true;
    });

    $scope.split = function(text,maxSize,ellipsis){
        return BrowseState.split(text,5,'');
    }

    $scope.getDownloadPath = function(){
        return BrowseState.getDownloadPath($scope.viewData.driveName, $scope.viewData.path);
    }

    $scope.getImageSrcPath = function(){
       return BrowseState.getImageSrcPath($scope.viewData.driveName, $scope.viewData.path);
    }

    $scope.timeConverter = function(UNIXTimestamp){
        return BrowseState.timeConverter(UNIXTimestamp);
    }

    $scope.ok = function () {
        $modalInstance.close();
    };

    $scope.isImage = function(){
        return BrowseState.isImage($scope.viewData.path);
    }

//    $scope.cancel = function () {
//        $modalInstance.dismiss('cancel');
//    };


});