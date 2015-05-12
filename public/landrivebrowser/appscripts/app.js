angular.module('landriveBrowser', ['ngRoute' ,
                                   'ui.bootstrap',
                                   'landriveBrowser.Drive.REST',        // Dependency List
                                   'landriveBrowser.Authentication',
                                   'landriveBrowser.Browser.Services',
                                   'ngCookies',
//                                   'landriveBrowser.RequestCache'
                                  ]
);