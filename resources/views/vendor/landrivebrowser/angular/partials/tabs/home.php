<?php
$tabTitle = 'Home';
$tabTitleIconClass = "fa-home";
include('tabsheader.php');
?>

<div class="panel-body">
  <ul class="drive-list" >

    <div class="well " ng-repeat="drive in drives">
    <span ng-click="browseDrive(drive.name)">
      <span> {{drive.info}} </span>
    </span>
    </div>


<!--      <div class="col-lg-8 text-center" ng-repeat="drive in drives">-->
<!--          <div class="panel panel-default" ng-click="browseDrive(drive.name)" >-->
<!--              <div class="panel-body">-->
<!--                <span> {{drive.info}} </span>-->
<!--              </div>-->
<!--          </div>-->
<!--      </div>-->

  </ul>
</div>


<?php
include('tabsfooter.php');
?>