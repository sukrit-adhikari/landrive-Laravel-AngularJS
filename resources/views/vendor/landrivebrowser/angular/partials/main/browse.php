<div style= "margin-left: -35px;">

<ul class="directory-list">

<li class="list-group-item active ">

    <!--    ShortCut to current Drive-->
    <button class="btn btn-primary" ng-click="browse(getDriveName(),'')" ng-if="isDriveSelected()">
          <i class="fa fa-bullseye"></i> {{getDriveName()}}
    </button>

    <!--    Drive List-->
    <div class="btn-group" dropdown >
      <button type="button" class="btn btn-primary dropdown-toggle" dropdown-toggle >
        <i class="fa fa-laptop"></i> {{getDriveName()}} <span class="caret"></span>
      </button>

      <ul class="dropdown-menu" role="menu">

        <li ng-repeat="drive in drives" ng-class="{'active' : getDriveName() == drive.name}">
          <a href=""  ng-click="browse(drive.name,'')" class="fa-2x"><i class="fa fa-caret-right"></i> {{drive.info}}</a>
        </li>

<!--        <li class="divider"></li>-->
<!--        <li><a href="#">Shared Drive by admin</a></li>-->
      </ul>
    </div>
    </span>

  <!--  Menu List-->
  <div class="btn-group" dropdown >
  <button type="button" class="btn btn-primary dropdown-toggle" dropdown-toggle>
    <i class="fa fa-ellipsis-v"></i>&nbsp;
  </button>

    <ul class="dropdown-menu" role="menu" >
      <li ng-click="toggleSearchBar()" ng-class="{'active' : searchBarActive }" >
        <a href="" class="fa-2x"><i class="fa fa-search"></i> Search</a>
      </li>

      <li ng-click="playRemoteMusicPlayer()">
        <a href="" class="fa-2x"><i class="fa fa-bullhorn"></i> Remote Player</a>
      </li>

      <li ng-click="remoteControlRemoteMusicPlayer()">
        <a href="" class="fa-2x"><i class="fa fa-bullhorn"></i> Remote</a>
      </li>

      <li ng-click="clearCache()">
        <a href="" class="fa-2x"><i class="fa fa-remove "></i> Clear Cache</a>
      </li>

      <li ng-click="gotoLogout()">
        <a href="" class="fa-2x"><i class="fa fa-unlock"></i> Logout</a>
      </li>
    </ul>
  </div>
</li>
</ul>

<div>
<ul>
  <!--  PathList-->
  <li class="list-group-item">
    <div class="btn-group" dropdown ng-class="{'hidden' : browsingPath == ''}">
      <button type="button" class="btn btn-primary dropdown-toggle" dropdown-toggle >
        <i class="fa fa-folder-open"></i> {{reverseSplit(browsingPath,30)}} <span class="caret"></span>
        <span class="badge">{{getListLength()}}</span>
      </button>
      <ul class="dropdown-menu" role="menu" >
        <li ng-repeat="path in pathArray" ng-class="{'active' : isBrowsing(path.path)}" >
          <a href="" ng-click="browse(getDriveName(),path.path)">
            <span class="fa-2x"><i class="fa fa-caret-right"></i> {{split(path.name,18)}}</span>
          </a>
        </li>
      </ul>
    </div>
    <div ng-class="{'hidden' : browsingPath != ''}">
      <button type="button" class="btn btn-primary btn-notify">
        <i class="fa fa-chevron-circle-down"></i> {{topBrowseMessage}}
      </button>
    </div>

  </li>
</ul>
</div>

  <div ng-class="{'hidden' : !searchBarActive}">
    <ul>

      <li class="list-group-item">
        <form >
          <input class="form-control" ng-model="searchQuery" placeholder="Search">
        </form>
      </li>
    </ul>
  </div>

<!--  ng-class="{'hidden' : !musicPlayerActive}"-->
  <div style="display: none;">
    <ul>
      <li class="list-group-item">
        <i class="fa fa-2x fa-step-backward"></i>
        <i class="fa fa-2x fa-pause"></i>
        <i class="fa fa-2x fa-step-forward "></i>

      </li>
    </ul>
  </div>

<div>
<ul>



  <li ng-click="browse(drive.name,'')" class="list-group-item" ng-repeat="drive in drives | filter:searchQuery" ng-if="!isDriveSelected()">
    <span><i class="fa fa-cloud"></i> {{drive.info}}</span>
  </li>

  <!--  Directory List-->
  <li  ng-click="browse(getDriveName(),directory)" ng-class="{'active' : isBrowsing(directory)}" class="animate list-group-item" ng-repeat="directory in data.directories | filter:searchQuery">
    <span>
    <i class="fa fa-folder"></i>
    <span ng-class="{'browsing' : isBrowsing(directory)}">{{split(directory)}}</span>
    <i ng-class="{'fa fa-spinner fa-spin' : isBrowsing(directory)}"></i>
<!--    <i class="fa fa-ellipsis-v" style="float: right;"></i>-->
    </span>
  </li>
  <!--  File List-->
  <li class="list-group-item" ng-repeat="file in data.files | filter:searchQuery">
    <span ng-click="view(getDriveName(),file)">
    <i class="fa fa-file"></i>
      <a href="">
      <span> {{ split(file,40)}} </span>
      </a>
    </span>


  </li>
</ul>
</div>


</div>


<div ng-if="isDriveSelected()">

<div style="position: fixed; bottom:20px; right: 70px; opacity: 0.5; ">
  <span><i ng-click="leftBrowse()" class="fa fa-4x fa-chevron-circle-left browse-navigator"></i></span>
</div>

<div style="position: fixed; bottom:20px; right: 10px; opacity: 0.5; ">
<span><i ng-click="rightBrowse()" class="fa fa-4x fa-chevron-circle-right browse-navigator"></i></span>
</div>

<div style="position: fixed; bottom:85px; right: 10px; opacity: 0.5; ">
  <span><i ng-click="add(getDriveName(),browsingPath)" class="fa fa-4x fa-plus-circle browse-navigator"></i></span>
</div>

<div style="position: fixed; bottom:150px; right: 10px; opacity: 0.5; ">
  <span><i ng-click="toggleSearchBar()" class="fa fa-4x fa-search browse-navigator"></i></span>
</div>

</div>


<script>
//  jQuery("body > div > div > div").slimscroll({height:'450px'});
  </script>