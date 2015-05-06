<div style= "margin-left: -35px;">

<ul class="directory-list">

<li class="list-group-item active">
<h3>
      <span ng-click="browse(getDriveName(),'')">
        <i class="fa fa-cloud"></i> {{getDriveName()}}
      </span>

      <span>
        <i class="fa fa-terminal"></i> {{getPath()}}
      </span>

    <span style="float: right;">
       <span>
<!--          <i class="fa fa-search"></i>-->
          <i class="fa fa-refresh" ></i>
       </span>

    </span>

    <form class="navbar-search" style="display: none;">
      <input class="form-control" ng-model="searchQuery" placeholder="Search">
    </form>
</h3>
</li>

  <li ng-click="browse(getDriveName(),directory)" class="list-group-item" ng-repeat="directory in data.directories | filter:searchQuery">
    <span>
    <i class="fa fa-folder"></i>
    <span>{{directory}}</span>
    </span>
  </li>

  <li class="list-group-item" ng-repeat="file in data.files | filter:searchQuery">
    <span ng-href="download(file)">
    <i class="fa fa-file"></i>
    <span> {{file}} </span>

    </span>
  </li>

<!--  <li class="list-group-item" ng-repeat="message in data.messages">-->
<!--    <span ng-click="browse(getDriveName(),file)">-->
<!--    <i class="fa fa-file"></i>-->
<!--    <span> {{message}} </span>-->
<!--    </span>-->
<!--  </li>-->

</ul>


</div>