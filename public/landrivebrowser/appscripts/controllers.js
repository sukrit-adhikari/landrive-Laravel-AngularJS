var landriveBrowser = angular.module('landriveBrowser', ['ngResource']);

//angular.module('landriveBrowser.services').factory('Drive', function($resource) {
//    return $resource('/api/entries/:id'); // Note the full endpoint address
//});


landriveBrowser.controller('BrowseCtrl', function ($scope , $http , $resource) {

    // Initialization Variables
    $scope.selectedDrive = "Drives";
    $scope.directories = [];
    $scope.files = [];
    $scope.isHome = true;

    $scope.home = function(){
        $scope.isHome = true;
        $http.get('api/drive').success(function(data) {
            $scope.drives = data;
        });
        $scope.selectedDrive = "Drives";
    }

    $scope.browseDrive = function(drivename){
        $scope.isHome = false;
        $scope.selectedDrive = drivename;
        $scope.drives = [];
    }

    $scope.browseDirectory = function(){

    }

});