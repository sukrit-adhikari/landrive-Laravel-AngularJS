<div style= "margin-left: -35px;">

<ul class="directory-list">

<li class="list-group-item active">


    <button class="btn btn-primary" ng-click="browse(getDriveName(),'')">
          <i class="fa fa-bullseye"></i> {{getDriveName()}}
    </button>

    <div class="btn-group" dropdown >
      <button type="button" class="btn btn-primary dropdown-toggle" dropdown-toggle ng-disabled="disabled">
        <i class="fa fa-laptop"></i> {{getDriveName()}} <span class="caret"></span>
      </button>

      <ul class="dropdown-menu" role="menu">

        <li ng-repeat="drive in drives">
          <a href="" ng-click="browse(drive.name,'')" >{{drive.info}}</a>
        </li>

        <li class="divider"></li>
        <li><a href="#">Shared Drive by admin</a></li>
      </ul>
    </div>

    <div class="btn-group" dropdown >
      <button type="button" class="btn btn-primary dropdown-toggle" dropdown-toggle ng-disabled="disabled">
        <i class="fa fa-folder-open"></i> {{reverseSplitPath(getPath())}} <span class="caret"></span>
      </button>
      <ul class="dropdown-menu" role="menu">

        <li ng-repeat="path in pathArray">
          <a href="" ng-class="{'activepath' : isBrowsing(path.path)}" ng-click="browse(getDriveName(),path.path)">
            <i class="fa fa-caret-right"></i> {{(path.name)}}
          </a>
        </li>
      </ul>
    </div>




    </span>

    <span style="float: right;">





    </span>




  <div class="btn-group" dropdown>
    <button type="button" class="btn btn-primary dropdown-toggle" dropdown-toggle ng-disabled="disabled">
      <i class="fa fa-ellipsis-v"></i> <span class="caret"></span>
    </button>

    <ul class="dropdown-menu" role="menu" >

      <li>
        <a href=""><i class="fa fa-search"></i> Search</a>
      </li>

    </ul>
  </div>


<!--  <i class="fa fa-circle-arrow-left"></i>-->
<!--  <i class="fa fa-circle-arrow-right"></i>-->


  <form class="navbar-search" style="display: none;">
    <input class="form-control" ng-model="searchQuery" placeholder="Search">
  </form>




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