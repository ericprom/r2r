<div  ng-controller="SettingsAccountController">
<section class="content-header">
  <h1>
    Account Setting
    <small>ตั้งค่าบัญชี</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Settings</li>
    <li class="active">Account</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-cog"></i> ตั้งค่าบัญชี</h3>
            </div>
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-2 col-md-4"></div>
                    <div class="col-sm-8 col-md-4">
                      <center>
                      <form name="form" role="form">
                        <input type="file" name="avatar" accept="image/*" class="hidden" id="formImage" 
                          ng-model="form.avatar" 
                          onchange="angular.element(this).scope().uploaded(this)">
                          <img ng-src="{{ image_source}}" class="profile-user-img img-responsive img-circle" alt="{{fields.user.name}}" style="width: 150px;" ng-click="change()"/>
                      </form>
                      </center>
                    </div>
                    <div class="col-sm-2 col-md-4"></div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="userName" class="col-sm-2 col-md-4 control-label">ชื่อ-สกุล</label>

                  <div class="col-sm-8 col-md-4">
                    <input type="text" class="form-control" id="userName" ng-model="fields.user.name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="userEmail" class="col-sm-2 col-md-4 control-label">อีเมล์</label>

                  <div class="col-sm-8 col-md-4">
                    <input type="text" class="form-control" id="userEmail" ng-model="fields.user.email" disabled>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-1 col-md-2"></div>
                  <div class="col-sm-10 col-md-8">
                    <hr>
                  </div>
                  <div class="col-sm-1 col-md-2"></div>
                </div>
                <div class="form-group">
                  <label for="userPassword" class="col-sm-2 col-md-4 control-label">รหัสผ่าน</label>

                  <div class="col-sm-8 col-md-4">
                    <input type="password" class="form-control" id="userPassword" ng-model="fields.user.password">
                  </div>
                </div>
                <div class="form-group">
                  <label for="userPasswordConfirm" class="col-sm-2 col-md-4 control-label">ยืนยันรหัสผ่าน</label>

                  <div class="col-sm-8 col-md-4">
                    <input type="password" class="form-control" id="userPasswordConfirm" ng-model="fields.user.password2">
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-info" ng-click="update()">บันทึกข้อมูล</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>