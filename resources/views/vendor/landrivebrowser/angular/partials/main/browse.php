hahahah
<div class="panel-body">
  <ul class="browse-list" >

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