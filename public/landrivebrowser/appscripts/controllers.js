var landriveBrowser = angular.module('landriveBrowser', []);

landriveBrowser.controller('DriveListCtrl', function ($scope , $http) {
    $http.get('/drive').success(function(data) {
        $scope.drives = data;
    });
});