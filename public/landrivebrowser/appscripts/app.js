angular.module('landriveBrowser', ['ngRoute' ,
                                   'ui.bootstrap',
                                   'landriveBrowser.Drive.REST',        // Dependency List
                                   'landriveBrowser.Authentication',
                                   'landriveBrowser.Browser.Services',
//                                   'landriveBrowser.RequestCache'
                                  ]
);