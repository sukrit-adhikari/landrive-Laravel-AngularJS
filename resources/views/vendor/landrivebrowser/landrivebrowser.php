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
      <a class="navbar-brand" href="index.html">Landrive</a>
    </div>

    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul id="active" class="nav navbar-nav side-nav">
        <li class="selected"><a href="/mobile"><i class="fa fa-bullseye"></i> Home</a></li>
        <li><a href="#"><i class="fa fa-tasks"></i> Logout</a></li>
        <li><a href="#"><i class="fa fa-globe"></i> About Server</a></li>
<!--        <li><a href="signup.html"><i class="fa fa-list-ol"></i> SignUp</a></li>-->
<!--        <li><a href="register.html"><i class="fa fa-font"></i> Register</a></li>-->
<!--        <li><a href="timeline.html"><i class="fa fa-font"></i> Timeline</a></li>-->
<!--        <li><a href="forms.html"><i class="fa fa-list-ol"></i> Forms</a></li>-->
<!--        <li><a href="typography.html"><i class="fa fa-font"></i> Typography</a></li>-->
<!--        <li><a href="bootstrap-elements.html"><i class="fa fa-list-ul"></i> Bootstrap Elements</a></li>-->
<!--        <li><a href="bootstrap-grid.html"><i class="fa fa-table"></i> Bootstrap Grid</a></li>-->
      </ul>

      <!--<ul class="nav navbar-nav navbar-right navbar-user">-->
      <!--<li class="dropdown messages-dropdown">-->
      <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Messages <span class="badge">2</span> <b class="caret"></b></a>-->
      <!--<ul class="dropdown-menu">-->
      <!--<li class="dropdown-header">2 New Messages</li>-->
      <!--<li class="message-preview">-->
      <!--<a href="#">-->
      <!--<span class="avatar"><i class="fa fa-bell"></i></span>-->
      <!--<span class="message">Security alert</span>-->
      <!--</a>-->
      <!--</li>-->
      <!--<li class="divider"></li>-->
      <!--<li class="message-preview">-->
      <!--<a href="#">-->
      <!--<span class="avatar"><i class="fa fa-bell"></i></span>-->
      <!--<span class="message">Security alert</span>-->
      <!--</a>-->
      <!--</li>-->
      <!--<li class="divider"></li>-->
      <!--<li><a href="#">Go to Inbox <span class="badge">2</span></a></li>-->
      <!--</ul>-->
      <!--</li>-->
      <!--<li class="dropdown user-dropdown">-->
      <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Steve Miller<b class="caret"></b></a>-->
      <!--<ul class="dropdown-menu">-->
      <!--<li><a href="#"><i class="fa fa-user"></i> Profile</a></li>-->
      <!--<li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>-->
      <!--<li class="divider"></li>-->
      <!--<li><a href="#"><i class="fa fa-power-off"></i> Log Out</a></li>-->

      <!--</ul>-->
      <!--</li>-->
      <!--<li class="divider-vertical hidden"></li>-->
      <!--<li class="hidden">-->
      <!--<form class="navbar-search">-->
      <!--<input type="text" placeholder="Search" class="form-control">-->
      <!--</form>-->
      <!--</li>-->
      <!--</ul>-->
    </div>
  </nav>

  <div id="page-wrapper">

    <div class="row">

    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-cloud"></i> Drives </h3>
          </div>
          <div class="panel-body">
            <ul class="server-stats" ng-controller="DriveListCtrl">
              <!--<li>-->



              <div class="col-lg-8 text-center" ng-repeat="drive in drives">
                <div class="panel panel-default">
                  <div class="panel-body">
                    {{drive.name}}
                  </div>
                </div>
              </div>


              <!--<div class="key pull-right">LAN</div>-->
              <!--<div class="stat">-->
              <!--<div class="info">6 Mb/s <i class="fa fa-caret-down"></i>&nbsp; 3 Mb/s <i class="fa fa-caret-up"></i></div>-->
              <!--<div class="progress progress-small">-->
              <!--<div style="width: 48%;" class="progress-bar progress-bar-inverse"></div>-->
              <!--</div>-->
              <!--</div>-->
              <!--</li>-->


            </ul>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>
</body>
</html>
