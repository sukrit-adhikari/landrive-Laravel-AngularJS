<html lang="en" ng-app="landriveBrowser">

<head>
  <meta charset="utf-8">
<!--  <base href="/mobile">-->

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Landrive | Mobile</title>

  <link rel="stylesheet" type="text/css" href="landrivebrowser/bootstrap/css/bootstrap.min.css" />

  <link rel="stylesheet" type="text/css" href="landrivebrowser/font-awesome/css/font-awesome.min.css" />

  <link rel="stylesheet" type="text/css" href="landrivebrowser/css/local.css" />

  <script type="text/javascript" src="landrivebrowser/js/jquery-1.10.2.min.js"></script>
  <script type="text/javascript" src="landrivebrowser/js/jquery.slimscroll.min.js"></script>

  <script type="text/javascript" src="landrivebrowser/angular/angular.js"></script>
  <script type="text/javascript" src="landrivebrowser/angular/angular-resource.js"></script>
  <script type="text/javascript" src="landrivebrowser/angular/angular-route.js"></script>
  <script type="text/javascript" src="landrivebrowser/angular/angular-cookies.js"></script>

  <script type="text/javascript" src="landrivebrowser/appscripts/app.js"></script>
  <script type="text/javascript" src="landrivebrowser/appscripts/routes.js"></script>
  <script type="text/javascript" src="landrivebrowser/appscripts/controllers.js"></script>
  <script type="text/javascript" src="landrivebrowser/appscripts/helpers.js"></script>

  <script type="text/javascript" src="landrivebrowser/js/ui-bootstrap-0.13.0.js"></script>

  <script type="text/javascript" src="landrivebrowser/bootstrap/js/bootstrap.min.js"></script>

</head>
<body>

<!--<div id="wrapper">-->
<!---->
<!--  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">-->
<!--    <div class="navbar-header">-->
<!--      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">-->
<!--        <span class="sr-only">Toggle navigation</span>-->
<!--        <span class="icon-bar"></span>-->
<!--        <span class="icon-bar"></span>-->
<!--        <span class="icon-bar"></span>-->
<!--      </button>-->
<!--      <a class="navbar-brand" href="#">Landrive</a>-->
<!--    </div>-->
<!---->
<!--    <div class="collapse navbar-collapse navbar-ex1-collapse">-->
<!--      <ul id="active" class="nav navbar-nav side-nav">-->
<!--        <li class="selected"><a href="/mobile"><i class="fa fa-bullseye"></i> Home</a></li>-->
<!--        <li><a href="#"><i class="fa fa-tasks"></i> Logout </a></li>-->
<!--        <li><a href="#"><i class="fa fa-globe"></i> About Server </a></li>-->
<!--      </ul>-->
<!--    </div>-->
<!--  </nav>-->
<!---->
<!--</div>-->


<div ng-view></div> <!-- Main Content Display -->

</body>
</html>
