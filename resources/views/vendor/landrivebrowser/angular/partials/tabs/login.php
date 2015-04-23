<?php
$tabTitle = 'Login';
$tabTitleIconClass = "fa-lock";
include('tabsheader.php');
?>


<form ng-submit="authenticateMe()">

  <div>

    <div class="row text-center">
      <h2>Log In</h2>
    </div>
    <div>
      <label for="firstname" class="col-md-2">
        Name
      </label>
      <div class="col-md-9">
        <input type="text" class="form-control" id="landriveusername" ng-model="landriveusername" placeholder="Landrive User name">
      </div>
    </div>

    <div>
      <label for="password" class="col-md-2">
        Password
      </label>
      <div class="col-md-9">
        <input type="password" class="form-control" id="password" ng-model="password" placeholder="Password">
        <p class="help-block">
          <input type="submit" class="btn btn-primary btn-sm" id="submit" value="Submit" />
        </p>
      </div>
    </div>
  </div>

</form>

