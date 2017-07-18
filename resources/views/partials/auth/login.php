<div class="container" ng-controller="LoginController">
<div class="login-box">
  <div class="login-logo">
    Routine<b>2</b>Research
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Routine<b>2</b>Research Management System</p>
    <form name="loginForm" novalidate  ng-submit="login()">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" ng-model="email">
        <span class="fa fa-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" ng-model="password">
        <span class="fa fa-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>
  </div>
</div>
</div>