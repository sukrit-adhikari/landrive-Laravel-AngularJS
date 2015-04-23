angular.module('landriveBrowser').controller('HomeCtrl', function ($scope , $location , Drive) {


    $scope.drives = Drive.query();

    $scope.browseDrive = function(drivename){
        $location.url('/browse');
    }


});

angular.module('landriveBrowser').controller('AuthenticationCtrl', function ($scope , $location , Authentication) {

    $scope.authenticateMe = function(){
       Authentication.getAccessToken($scope.landriveusernam , $scope.password)
                     .then(function(all){

                     });

    }

});