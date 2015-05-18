<div class="modal-header">
  <p class="modal-title">
    <span><i class="fa fa-cloud"></i> {{addData.driveName}}
          <i class="fa fa-terminal"></i> {{addData.path}}
<!--          <span>-->
<!--            <i class="fa fa-spinner fa-spin"></i>-->
<!--          <div>-->
    </span>
  </p>


  <div>


    <span>

    <span class="" ng-click="upload()" style="margin-right: 15px;"><i class="fa fa-3x fa-plus"></i></span>

    <span class="" ng-click="createFolder()" style="margin-right: 15px;"><i class="fa fa-3x fa-folder"></i></span>

    <span class="" ng-click="createFile()" style="margin-right: 15px;"><i class="fa fa-3x fa-file"></i></span>

    </span>


  </div>


</div>

  <div class="modal-body">


    <div class="form-group">
      <label>File Name</label>
      <input class="form-control">
    </div>

    <div class="form-group">
      <label>File Content</label>
      <textarea class="form-control" rows="3"></textarea>
    </div>

    <div class="form-group">
      <label>Folder Name</label>
      <input class="form-control">
    </div>

    <div class="form-group">
      <label>File input</label>
      <input type="file">
    </div>

  </div>


  <div class="modal-footer">
    <span style="float: right;" class="" ng-click="ok()" ><i class="fa fa-3x fa-check-circle"></i></span>
  </div>
