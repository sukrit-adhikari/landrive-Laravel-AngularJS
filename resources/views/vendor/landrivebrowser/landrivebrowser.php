<html lang="en" ng-app="landriveBrowser">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landrive Browser</title>

  <link rel="stylesheet" type="text/css" href="landrivebrowser/bootstrap/css/bootstrap.min.css" />

  <link rel="stylesheet" type="text/css" href="landrivebrowser/font-awesome/css/font-awesome.min.css" />

  <link rel="stylesheet" type="text/css" href="landrivebrowser/css/local.css" />

  <script type="text/javascript" src="landrivebrowser/js/jquery-1.10.2.min.js"></script>

  <script type="text/javascript" src="landrivebrowser/angular/angular.js"></script>
  <script type="text/javascript" src="landrivebrowser/angular/angular-resource.js"></script>

  <script type="text/javascript" src="landrivebrowser/appscripts/controllers.js"></script>

  <script type="text/javascript" src="landrivebrowser/bootstrap/js/bootstrap.min.js"></script>

</head>
<body>

<div id="wrapper">

  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Landrive</a>
    </div>

    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul id="active" class="nav navbar-nav side-nav">
        <li class="selected"><a href="/mobile"><i class="fa fa-bullseye"></i> Home</a></li>
        <li><a href="#"><i class="fa fa-tasks"></i> Logout </a></li>
        <li><a href="#"><i class="fa fa-globe"></i> About Server </a></li>
      </ul>
    </div>
  </nav>

  <div id="page-wrapper" ng-controller="BrowseCtrl">

    <div class="row">

      <div class="col-lg-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
<!--            <h3 class="panel-title">-->
              <span ng-click="home()"> <i class="fa fa-home"></i> Home </span>
              <span ng-hide="isHome"><i class="fa fa-cloud" ></i> {{selectedDrive}}</span>
<!--            </h3>-->
            <span style="float:right;">
            <i class="fa fa-arrow-left"></i>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <i class="fa fa-arrow-right"></i>
            </span>
          </div>
          <div class="panel-body">
            <ul class="drive-list" >

              <div class="col-lg-8 text-center" ng-repeat="drive in drives">
                <div class="panel panel-default" ng-click="browseDrive(drive.name)">
                  <div class="panel-body">
                   <span> {{drive.info}} </span>
                  </div>
                </div>
              </div>

              <div class="col-lg-8 text-center" ng-repeat="directory in directories">
                <div class="panel panel-default" ng-click="browseDirectory(drive.name)">
                  <div class="panel-body">
                    <span> {{directory}} </span>
                  </div>
                </div>
              </div>

              <div class="col-lg-8 text-center" ng-repeat="file in files">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <span> {{file}} </span>
                  </div>
                </div>
              </div>


            </ul>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>
</body>
</html>
