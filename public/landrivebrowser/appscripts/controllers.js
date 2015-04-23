angular.module('landriveBrowser').controller('AuthenticationCtrl', function ($scope , $location , Authentication) {

    $scope.authenticateMe = function(){
       Authentication.getAccessToken($scope.landriveusernam , $scope.password)
                     .then(function(all){

                     });
    }

});

angular.module('landriveBrowser').controller('HomeCtrl', function ($scope , $location  , Drive ) {

    $scope.drives = Drive.index();

    $scope.refresh = function(){
        $scope.drives = Drive.index();
    }

    $scope.browseDrive = function(drivename){
        $location.path('/browse/'+drivename+'/').search({driveName: drivename});;
    }

});

angular.module('landriveBrowser').controller('BrowseCtrl',  function ($scope , $location , Drive , BrowseState) {

    // On First Load

    var locationParams = $location.search();

    $scope.driveName = locationParams.driveName;
    $scope.path = '';

    $scope.getDriveName = function(){
        return $scope.driveName;
    };

    $scope.getPath = function(){
        return $scope.path;
    }

    Drive.query({driveName: $scope.driveName , path: $scope.path},function(data){
        $scope.data =  data[$scope.driveName];
    });

    //
    $scope.browse = function(driveName,path){
//        $location.search("history",(Math.random()*10000))
        $scope.path = path;

        Drive.query({driveName: driveName , path: path},function(data){
            $scope.data =  data[driveName];
        });

    }

});