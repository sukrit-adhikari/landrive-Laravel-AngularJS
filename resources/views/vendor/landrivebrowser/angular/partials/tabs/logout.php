<form ng-submit="authenticateMe()">

  <div>
    <div class="row text-center">
      <h2>Log Out</h2>

      <div>
        <h3 ng-repeat="alert in alerts">{{alert.message}}</h3>
      </div>
    </div>
  </div>

</form>

