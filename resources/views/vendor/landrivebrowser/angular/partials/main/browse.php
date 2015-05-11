<div style= "margin-left: -35px;">

<ul class="directory-list">

<li class="list-group-item active">
<h3>
      <span ng-click="browse(getDriveName(),'')">
        <i class="fa fa-cloud"></i> {{getDriveName()}}
      </span>

      <span>
        <i class="fa fa-terminal"></i>

        <span ng-repeat="path in pathArray">

          <span ng-class="{'activepath' : isBrowsing(path.path)}" ng-click="browse(getDriveName(),path.path)">
            {{(path.name)}}
          </span>

      </span>
<!--        {{getPath()}}-->

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

  <li  ng-click="browse(getDriveName(),directory)" class="list-group-item" ng-repeat="directory in data.directories | filter:searchQuery">
    <span>
    <i class="fa fa-folder"></i>
    <span ng-class="{'browsing' : isBrowsing(directory)}">{{splitPath(directory)}}</span>
    </span>
  </li>

  <li class="list-group-item" ng-repeat="file in data.files | filter:searchQuery">

<!--    tooltip-placement="right" tooltip="On the Left!"-->
    <span>
    <i class="fa fa-file"></i>
    <span> {{

      splitPath(file)

      }} </span>
    </span>

    <a ng-href="{{getDownloadPath(file)}}" style="float: right;">
    <i class="fa fa-download"></i>
    </a>

<!--    -->

  </li>

  <li class="list-group-item" ng-repeat="message in data.messages">
    <span ng-click="browse(getDriveName(),file)">
    <i class="fa fa-file"></i>
    <span> {{message}} </span>
    </span>
  </li>

</ul>


</div>