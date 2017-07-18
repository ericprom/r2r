<div ng-controller="AdminUsersController">
  <section class="content-header">
    <h1>
      Users
      <small>รายชื่อผู้ใช้งาน</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="/admin">Admin</a></li>
      <li class="active">Users</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title"><i class="fa fa-user-circle-o"></i> รายชื่อผู้ใช้งาน</h3>
            <div class="box-tools">
              <div class="input-group input-group-sm" style="width: 200px;">
                <input type="text" name="table_search" class="form-control pull-right" ng-model="searchKeyword">

                <div class="input-group-btn">
                  <button type="button" class="btn btn-default" ng-click="search(searchKeyword)"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="box-body table-responsive no-padding">
            <div set-box-height>
              <table class="table table-hover table-list">
                <tr>
                  <th width="20%">ชื่อ-สกุล</th>
                  <th width="70%">สิทธิ์</th>
                  <th width="10%">&nbsp;</th>
                </tr>
                <tr ng-hide="dataLists.users.length>0">
                  <td colspan="4" class="text-vertical-center text-center"><h3>ไม่มีข้อมูลผู้ใช้งาน</h3></td>
                </tr>
                <tr ng-repeat="user in dataLists.users">
                  <td class="text-vertical-center">
                    <div ng-class="(user.active==1)?'null':'strikethrough'">{{user.name}}</div>
                  </td>
                  <td class="text-vertical-center">
                    <span ng-repeat="role in user.roles">
                      <span class="label label-primary">
                        <span class="text-capitalize">{{role.name}}</span>
                      </span>
                    </span>
                  </td>
                  <td>
                    <div class="pull-right manage-link">
                      <button type="button" class="btn btn-box-tool" ng-click="edit(user)" ng-show="user.id!=1">
                        <i class="fa fa-edit" style="font-size: 18px;"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <div class="box-footer clearfix">
            <button type="submit" class="btn btn-primary" ng-click="add()"><i class="fa fa-plus"></i> เพิ่มผู้ใช้งาน</button>
           <span ng-hide="dataLists.stores==''">
              <pagination ng-model="currentPage" total-items="total" max-size="maxSize" boundary-links="true"></pagination>
            </span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="modal fade" id="manageUserModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">ข้อมูลผู้ใช้งาน</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal">
            <div class="form-group">
              <label for="userRole" class="col-sm-2 col-md-3 control-label">สิทธิ์</label>
              <div class="col-sm-8 col-md-6">
                <ui-select multiple data-ng-model="fields.roles" class="form-control" id="userRole" >
                  <ui-select-match>{{$item.display_name}}</ui-select-match>
                  <ui-select-choices repeat="role.id as role in dataLists.roles| filter : {name : $select.search}">
                    <div ng-bind-html="role.display_name | highlight: $select.search"></div>
                  </ui-select-choices>
                </ui-select>
              </div>
            </div>
            <div class="form-group">
              <label for="userName" class="col-sm-2 col-md-3 control-label">ชื่อ-สกุล</label>
              <div class="col-sm-8 col-md-6">
                <input type="text" class="form-control" id="userName" placeholder="" ng-model="fields.user.name">
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
              <label for="userEmail" class="col-sm-2 col-md-3 control-label">อีเมล์ (ชื่อผู้ใช้ระบบ)</label>
              <div class="col-sm-8 col-md-6">
                <input type="text" class="form-control" id="userEmail" placeholder="" ng-model="fields.user.email">
              </div>
            </div>
            <div class="form-group">
              <label for="userPassword" class="col-sm-2 col-md-3 control-label">รหัสผ่าน</label>
              <div class="col-sm-8 col-md-6">
                <input type="password" class="form-control" id="userPassword" placeholder="" ng-model="fields.user.password">
              </div>
            </div>
            <div class="form-group" ng-show="fields.user.id">
              <label for="userActive" class="col-sm-2 col-md-3 control-label">&nbsp;</label>
              <div class="col-sm-8 col-md-6">
                <span class="cursor-pointer" ng-click="toggleStatus(fields.user)">
                  <i class="fa" ng-class="(fields.user.active)?' fa-check-square-o':' fa-square-o'"></i> 
                    <span ng-show="fields.user.active">เปิด</span><span ng-show="!fields.user.active">ปิด</span>ใช้งาน
                </span>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" ng-click="save()">บันทึกข้อมูล</button>
        </div>
      </div>
    </div>
  </div>
</div>