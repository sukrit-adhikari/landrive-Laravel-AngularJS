<div class="modal-header">
  <p class="modal-title">{{viewData.driveName}} : {{viewData.path}}</p>

  <div ng-if="gotInfo">
    <div><span>{{timeConverter(info.LastModified)}}</span></div>
    <div>
      <span>{{( (info.Size / 1000) / 1000 )}} MB</span>
      <a href="" ng-href="{{getDownloadPath()}}" >
        <i class="fa fa-download"></i>
      </a>
    </div>
  </div>


</div>

  <div class="modal-body">
        <span ng-if="isImage()">
           <img ng-src="{{getImageSrcPath()}}" />
        </span>

<!--        <span ng-if="isMusic()">-->
<!--          <audio controls>-->
<!--            <source src="horse.ogg" type="audio/ogg">-->
<!--            <source src="horse.mp3" type="audio/mpeg">-->
<!--            Your browser does not support the audio element.-->
<!--          </audio>-->
<!--        </span>-->
  </div>




  <div class="modal-footer">
    <button class="btn btn-primary" ng-click="viewNext()"><i class="fa fa-chevron-circle-right"></i></button>

    <button class="btn btn-primary" ng-click="ok()"><i class="fa fa-check-circle"></i></button>
<!--  <button class="btn btn-warning" ng-click="cancel()">Cancel</button>-->
  </div>
