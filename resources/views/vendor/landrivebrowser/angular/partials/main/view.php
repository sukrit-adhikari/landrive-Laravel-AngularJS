<div class="modal-header">



  <p class="modal-title">
    <span><i class="fa fa-cloud"></i> {{viewData.driveName}}
          <i class="fa fa-terminal"></i> {{reverseSplit(viewData.path,32,'..')}}
          <span ng-if="!gotInfo">
            <i class="fa fa-spinner fa-spin"></i>
          </span>
    </span>
  </p>


  <div>


    <span>
    <span class="" ng-click="viewPrevious()" style="margin-right: 15px;"><i class="fa fa-3x fa-chevron-circle-left"></i></span>

    <span class="" ng-click="viewNext()"><i class="fa fa-3x fa-chevron-circle-right"></i></span>

    <span ng-if="isAudio()" style="margin-left: 15px;">

      <span class="dropdown" dropdown>
      <a href class="dropdown-toggle" dropdown-toggle>
        <i class="fa fa-3x fa-rss"></i>
      </a>
      <ul class="dropdown-menu">
        <li>
          <a href>Play</a>
          <a href>Play Next</a>
          <a href>Add to playlist</a>
        </li>
      </ul>
    </span>

    </span>

    </span>

    <span style="float: right;" class="" ng-click="ok()" ><i class="fa fa-3x fa-check-circle"></i></span>

  </div>


</div>

  <div class="modal-body">

  <div ng-if="isText()">
    <pre>{{fileContent}}</pre>
  </div>

  <center>
        <div ng-if="isImage()">
           <center><img ng-src="{{imagePath}}" /></center>
        </div>

<!--        <div>-->
<!--          <i class="fa fa-spinner fa-spin fa-3x"></i>-->
<!--        <div>-->


<!--    <video controls autoplay="autoplay">-->
<!--      <source ng-src="{{downloadPath}}" type="video/mpeg">-->
<!--      Your browser does not support the audio element.-->
<!--    </video>-->

        <span ng-if="isAudio()">
          <audio id="view-audio" controls >
            <source src="{{downloadPath}}" type="audio/mpeg">
            Your browser does not support the audio element.
          </audio>
        </span>
  </center>
  </div>


  <div class="modal-footer">

    <div ng-if="gotInfo">
      <div><i class="fa fa-calendar"></i> <span>{{timeConverter(info.LastModified)}}</span></div>
      <div>
        <a href="" ng-href="{{getDownloadPath()}}" >
          <i class="fa fa-2x fa-download"></i>
        </a>
        <span>{{( (info.Size / 1000) / 1000 )}} MB</span>
      </div>
    </div>
    <div ng-if="!gotInfo">
      <i class="fa fa-spinner fa-spin fa-2x"></i>
    </div>


<!--  <button class="btn btn-warning" ng-click="cancel()">Cancel</button>-->
  </div>
