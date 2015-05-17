<div style= "margin-left: -35px;">

<ul class="directory-list">

<li class="list-group-item active ">

    <!--    ShortCut to current Drive-->
    <button class="btn btn-primary" ng-click="browse(getDriveName(),'')">
          <i class="fa fa-bullseye"></i> {{getDriveName()}}
    </button>

    <!--    Drive List-->
    <div class="btn-group" dropdown >
      <button type="button" class="btn btn-primary dropdown-toggle" dropdown-toggle ng-disabled="disabled">
        <i class="fa fa-laptop"></i> {{getDriveName()}} <span class="caret"></span>
      </button>

      <ul class="dropdown-menu" role="menu">

        <li ng-repeat="drive in drives">
          <a href="" ng-click="browse(drive.name,'')" class="fa-2x"><i class="fa fa-caret-right"></i> {{drive.info}}</a>
        </li>

<!--        <li class="divider"></li>-->
<!--        <li><a href="#">Shared Drive by admin</a></li>-->
      </ul>
    </div>
    </span>

  <!--  Menu List-->
  <div class="btn-group" dropdown >
  <button type="button" class="btn btn-primary dropdown-toggle" dropdown-toggle ng-disabled="disabled">
    <i class="fa fa-ellipsis-v"></i>
  </button>

    <ul class="dropdown-menu" role="menu" >
      <li ng-click="toggleSearchBar()">
        <a href=""><i class="fa fa-search"></i> Search</a>
      </li>
      <li ng-click="gotoLogout()">
        <a href=""><i class="fa fa-unlock"></i> Logout</a>
      </li>
    </ul>
  </div>

  <form class="navbar-search" ng-class="{'hidden' : !searchBarActive}">
    <input class="form-control" ng-model="searchQuery" placeholder="Search">
  </form>


</li>
</ul>

<div>
<ul>
  <!--  PathList-->
  <li class="list-group-item">
    <div class="btn-group" dropdown ng-class="{'hidden' : getPath() == ''}">
      <button type="button" class="btn btn-primary dropdown-toggle" dropdown-toggle ng-disabled="disabled">
        <i class="fa fa-folder-open"></i> {{reverseSplit(getPath(),30)}} <span class="caret"></span>
        <span class="badge">{{getListLength()}}</span>
      </button>
      <ul class="dropdown-menu" role="menu" >
        <li ng-repeat="path in pathArray">
          <a href="" ng-class="{'activepath' : isBrowsing(path.path)}" ng-click="browse(getDriveName(),path.path)">
            <span class="fa-2x"><i class="fa fa-caret-right"></i> {{split(path.name,18)}}</span>
          </a>
        </li>
      </ul>
    </div>
    <div ng-class="{'hidden' : getPath() != ''}">
      <button type="button" class="btn btn-primary"  ng-disabled="disabled">
        <i class="fa fa-chevron-circle-down"></i> {{topBrowseMessage}}
      </button>
    </div>

  </li>
</ul>
</div>


<div>
<ul>



  <li ng-click="browse(drive.name,'')" class="list-group-item" ng-repeat="drive in drives" ng-if="!isDriveSelected()">
    <span><i class="fa fa-cloud"></i> {{drive.info}}</span>
  </li>

  <!--  Directory List-->
  <li  ng-click="browse(getDriveName(),directory)" ng-class="{'active' : isBrowsing(directory)}" class="list-group-item" ng-repeat="directory in data.directories | filter:searchQuery">
    <span>
    <i class="fa fa-folder"></i>
    <span ng-class="{'browsing' : isBrowsing(directory)}">{{split(directory)}}</span>
    <i ng-class="{'fa fa-spinner fa-spin' : isBrowsing(directory)}"></i>
<!--    <i class="fa fa-ellipsis-v" style="float: right;"></i>-->
    </span>
  </li>
  <!--  File List-->
  <li ng-click="view(getDriveName(),file)" class="list-group-item" ng-repeat="file in data.files | filter:searchQuery">
    <span>
    <i class="fa fa-file"></i>
      <a href="">
      <span> {{ split(file)}} </span>
      </a>
    </span>

    <span style="float: right;">


<!--    <a ng-click="view(getDriveName(),file)" >-->
<!--      <i class="fa fa-eye"></i>-->
<!--    </a>-->

    </span>

  </li>
</ul>
</div>


</div>

<div style="position: fixed; bottom:10px; opacity: 0.5; ">
  <span><i class="fa fa-4x fa-chevron-circle-left"></i></span>
</div>

<div style="position: fixed; bottom:10px; right: 2px; opacity: 0.5; ">
<span><i class="fa fa-4x fa-chevron-circle-right"></i></span>
</div>

<script>
//  jQuery("body > div > div > div").slimscroll({height:'450px'});
  </script>