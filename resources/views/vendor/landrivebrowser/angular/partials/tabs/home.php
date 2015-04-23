<?php
$tabTitle = 'Home';
$tabTitleIconClass = "fa-home";
include('tabsheader.php');
?>

<div class="panel-body">
  <ul class="drive-list" >
<!--    <li>-->
      <div class="col-lg-8 text-center" ng-repeat="drive in drives">
          <div class="panel panel-default" ng-click="browseDrive(drive.name)" >
              <div class="panel-body">
                <span> {{drive.info}} </span>
              </div>
          </div>
      </div>
<!--    </li>-->
  </ul>
</div>


<?php
include('tabsfooter.php');
?>