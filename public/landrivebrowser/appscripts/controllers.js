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

    var alert = {message : 'Logging Out'};
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
                                                                      MusicPlayer,
                                                                      RemoteMusicPlayer,
                                                                      BrowseState) {

    var locationParams = $location.search();

    $scope.drives = Drive.request.index();

    $scope.path = '';

    $scope.browsingPath = '';

    $scope.driveName = locationParams.driveName;

    $scope.searchBarActive = false;

    $scope.toggleSearchBar = function(){
        $scope.searchBarActive = !$scope.searchBarActive;
        if(!$scope.searchBarActive){
            $scope.searchQuery = '';
        }
    }

    $scope.pathArray = [];

    $scope.getListLength = function(){
        if($scope.data === undefined){
            return "...";
        }
        return ($scope.data.files.length+$scope.data.directories.length);
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

    $scope.split = function(path , maxSize){
        return BrowseState.split(path, maxSize);
    }

    $scope.reverseSplit = function(path,maxSize){
        return BrowseState.reverseSplit(path,maxSize);
    }

    $scope.cache = $cacheFactory('mainCache' + Math.random());

    $scope.clearCache = function(){
        $scope.cache = $cacheFactory('mainCache'+ Math.random() + Math.random());
        alert('Browse Cache cleared.\nPlease reload to clear all cache.')
    }

    $scope.leftBrowse = function(){
        for(i = 0 ; i< $scope.pathArray.length ; i++){

            if($scope.isBrowsing($scope.pathArray[i].path)){
                if(i === 0 ){
                    // Reached the Left End .. Do nothing
                    $scope.browse($scope.getDriveName() , '')
                    break;
                }else{
                    $scope.browse($scope.getDriveName() , $scope.pathArray[(i-1)].path)
                    break;
                }
            }
        }
    }

    $scope.rightBrowse = function(){
        for(i = 0 ; i< $scope.pathArray.length ; i++){
            if($scope.isBrowsing($scope.pathArray[i].path)){
                if(i === ($scope.pathArray.length - 1) ){
                    // Reached the Right End .. Do nothing
                }else{
                    $scope.browse($scope.getDriveName() , $scope.pathArray[(i+1)].path)
                    break;
                }
            }else if($scope.isBrowsing('') && $scope.pathArray.length > 0 ){
                    $scope.browse($scope.getDriveName() , $scope.pathArray[0].path)
            }
        }
    }

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

            });
        }else{
            $scope.data = cacheData;
        }


        if($scope.path.indexOf(path) === -1 && path !== ''){
            $scope.pathArray = BrowseState.getPathArray(path);

            $scope.path = path;
        }

    }

    $scope.playRemoteMusicPlayer = function(){
        RemoteMusicPlayer.play();
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


    $scope.addData = {};

    $scope.setAddData = function(driveNameArg , pathArg){
        var addDataInstance = {driveName : driveNameArg, path : pathArg};
        $scope.addData = addDataInstance;
    }

    $scope.getAddData = function(){
        return $scope.addData;
    }

    $scope.add = function(driveNameArg , pathArg ){
        $scope.setAddData(driveNameArg, pathArg);
        $scope.addInModal();
    }

    $scope.addInModal = function () {

        var modalInstance = $modal.open({
            templateUrl: 'mobile/angular/partials/add',
            controller: 'AddModalCtrl',
            size: 'lg',
            resolve: {
                addData: function () {
                    return $scope.getAddData();
                }
            }
        });

        modalInstance.result.then(function (selectedItem) {

        }, function () {
//            $log.info('Modal dismissed at: ' + new Date());
        });
    };


    $scope.remoteControlRemoteMusicPlayer = function(){
        $scope.remoteControlInModal();
    }

    $scope.remoteControlInModal = function () {

        var modalInstance = $modal.open({
            templateUrl: 'mobile/angular/partials/remote',
            controller: 'RemoteModalCtrl',
            size: 'lg'
//            resolve: {
//                addData: function () {
//                    return $scope.getAddData();
//                }
//            }
        });

        modalInstance.result.then(function (selectedItem) {

        }, function () {
//            $log.info('Modal dismissed at: ' + new Date());
        });
    };

    $scope.browse($scope.driveName ,$scope.path) ; // FIRST Browse

});


angular.module('landriveBrowser').controller('RemoteModalCtrl', function ($scope,
                                                                          $modalInstance
                                                                         ){



});



angular.module('landriveBrowser').controller('ViewModalCtrl', function ($scope,
                                                                        $modalInstance,
                                                                        Drive,
                                                                        $cacheFactory,
                                                                        BrowseState,
                                                                        fileList,
                                                                        viewData) {

    $scope.viewData = viewData;

    if(fileList.length === 1){
        $scope.leftEnd = true;
        $scope.rightEnd = true;
    }else{
        $scope.leftEnd = false;
        $scope.rightEnd = false;
    }

    $scope.viewNext = function(){
//        if(fileList.length != $scope.browseIndex ){
//
//        }

        if($scope.browseIndex === (fileList.length-1)){
            $scope.rightEnd = true;
            return;
        }else{
            $scope.rightEnd = false;
        }

        $scope.viewData.path = fileList[($scope.browseIndex + 1)];

        $scope.refresh();

    }

    $scope.viewPrevious = function(){

        if($scope.browseIndex === 0){
            $scope.leftEnd = true;
            return;
        }else{
            $scope.leftEnd = false;
        }

        $scope.viewData.path = fileList[($scope.browseIndex - 1)];

        $scope.refresh();
    }



    $scope.info = {};


    $scope.split = function(text,maxSize,ellipsis){
        return BrowseState.split(text,maxSize,ellipsis);
    }

    $scope.reverseSplit = function(text,maxSize,ellipsis){
        return BrowseState.reverseSplit(text,maxSize,ellipsis);
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

    $scope.isText = function(){
        return BrowseState.isText($scope.viewData.path);
    }

    $scope.isAudio = function(){
        return BrowseState.isAudio($scope.viewData.path);
    }

    $scope.cache = $cacheFactory('infoCache' + Math.random());

    $scope.refresh = function(){

        $scope.fileContent =  '<Landrive>\nLoading...\nPlease Wait\n</Landrive>';

        $scope.downloadPath = $scope.getDownloadPath();

        var cacheKey = viewData.driveName+viewData.path+"info";

        var cacheData = $scope.cache.get(cacheKey);

        if (cacheData === undefined) {

            $scope.gotInfo = false;

            Drive.request.info({driveName: viewData.driveName , path: viewData.path},function(data){

                $scope.cache.put(cacheKey, data);
                $scope.info =  data;
                $scope.gotInfo = true;
            });

        }else{
            $scope.info = cacheData;
        }


        if(BrowseState.isImage($scope.viewData.path)){
            $scope.imagePath = $scope.getImageSrcPath();
        }

        if(BrowseState.isText($scope.viewData.path)){
            Drive.request.content({driveName: viewData.driveName , path: viewData.path},function(data){
                $scope.fileContent =  data.Content;
            });
        }else{
            $scope.fileContent =  '';
        }


        $scope.browseIndex = fileList.indexOf($scope.viewData.path);

    }


//    $scope.cancel = function () {
//        $modalInstance.dismiss('cancel');
//    };

    $scope.refresh();
});




angular.module('landriveBrowser').controller('AddModalCtrl', function ($scope,
                                                                       $modalInstance,
                                                                       Drive,
                                                                       $cacheFactory,
                                                                       BrowseState,
                                                                       addData) {

    $scope.addData = addData;


    $scope.split = function(text,maxSize,ellipsis){
        return BrowseState.split(text,maxSize,ellipsis);
    }

    $scope.reverseSplit = function(text,maxSize,ellipsis){
        return BrowseState.reverseSplit(text,maxSize,ellipsis);
    }

    $scope.ok = function () {
        $modalInstance.close();
    };



//    $scope.cancel = function () {
//        $modalInstance.dismiss('cancel');
//    };

});