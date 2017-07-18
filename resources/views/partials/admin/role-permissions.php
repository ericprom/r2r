<div ng-controller="AdminRolePermissionController">
  <section class="content-header">
    <h1>
      Role Permission
      <small>ตำแหน่งและหน้าที่</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="/admin">Admin</a></li>
      <li class="active">Role Permission</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-id-badge"></i> ตำแหน่ง</h3>

            <div class="box-tools pull-right">
              <span data-toggle="tooltip" title="มีทั้งหมด {{roles.length}} ยี่ห้อ" class="badge bg-light-blue">{{roles.length}}</span>
            </div>
          </div>
          <div class="box-body no-padding">
            <div set-box-height>
              <table class="table table-hover">
                <tr ng-hide="roles.length>0">
                  <td colspan="2" class="text-vertical-center text-center"><h3>ยังไม่มีข้อมูลที่จะแสดง</h3></td>
                </tr>
                <tr ng-repeat="role in roles">
                  <td class="text-vertical-center">
                      {{role.display_name}}
                  </td>
                  <td>
                    <div class="pull-right manage-link">
                      <button type="button" class="btn btn-box-tool" ng-click="editRoleModal(role)">
                        <i class="fa fa-edit" style="font-size: 18px;"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" ng-click="deleteRoleModal(role)">
                        <i class="fa fa-trash" style="font-size: 18px;"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <div class="box-footer">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="NAME : ชื่อตำแหน่ง" ng-model="roleTitle">
              <span class="input-group-btn">
                <button type="button" class="btn btn-primary" ng-click="saveRole()" ng-disabled="!roleTitle">
                  <i class="fa fa-save"></i> Save
                </button>
              </span>
            </div>
          </div>
        </div>
        <p>* กรุณากรอกตามรูปแบบที่ถูกต้อง เช่น "USER : สามารถใช้พื้นฐานในระบบได้เท่านั้น"</p>
      </div>

      <div class="col-md-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-magic"></i> หน้าที่</h3>

            <div class="box-tools pull-right">
              <span data-toggle="tooltip" title="มีทั้งหมด {{permissions.length}} ยี่ห้อ" class="badge bg-light-blue">{{permissions.length}}</span>
            </div>
          </div>
          <div class="box-body no-padding">
            <div set-box-height>
              <table class="table table-hover">
                <tr ng-hide="permissions.length>0">
                  <td colspan="2" class="text-vertical-center text-center"><h3>ยังไม่มีข้อมูลที่จะแสดง</h3></td>
                </tr>
                <tr ng-repeat="permission in permissions">
                  <td class="text-vertical-center">
                      {{permission.display_name}}
                  </td>
                  <td>
                    <div class="pull-right manage-link">
                      <button type="button" class="btn btn-box-tool" ng-click="editPermissionModal(permission)">
                        <i class="fa fa-edit" style="font-size: 18px;"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" ng-click="deletePermissionModal(permission)">
                        <i class="fa fa-trash" style="font-size: 18px;"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <div class="box-footer">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="NAME : ชื่อหน้าที่" ng-model="permissionTitle">
              <span class="input-group-btn">
                <button type="button" class="btn btn-primary" ng-click="savePermission()" ng-disabled="!permissionTitle">
                  <i class="fa fa-save"></i> Save
                </button>
              </span>
            </div>
          </div>
        </div>
        <p>* กรุณากรอกตามรูปแบบที่ถูกต้อง เช่น "CREATE : สามารถบันทึกข้อมูลในระบบได้"</p>
      </div>
    </div>
  </section>

  <div class="modal fade" id="editRoleModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">แก้ไขข้อมูลตำแหน่ง</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal">
            <div class="form-group">

              <label for="roleName" class="col-sm-2 col-md-3 control-label">คีย์</label>
              <div class="col-sm-8 col-md-6">
                <input type="text" class="form-control" id="roleName" ng-model="selected.name">
              </div>

            </div>
            <div class="form-group">

              <label for="roleDisplayname" class="col-sm-2 col-md-3 control-label">ชื่อตำแหน่ง</label>
              <div class="col-sm-8 col-md-6">
                <input type="text" class="form-control" id="roleDisplayname" ng-model="selected.display_name">
              </div>
              
            </div>
            <div class="form-group">

              <label for="roleDesc" class="col-sm-2 col-md-3 control-label">คำอธิบาย</label>
              <div class="col-sm-8 col-md-6">
                <textarea class="form-control" id="roleDesc" rows="3" ng-model="selected.description"></textarea>
              </div>

            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" ng-click="updateRole()">Update</button>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="deleteRoleModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">ลบข้อมูลตำแหน่ง</h4>
        </div>
        <div class="modal-body">
          <p>คุณต้องการลบ <b>{{selected.display_name}}</b> ออกจากระบบใช่ไหรือไม่</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger" ng-click="deleteRole()">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editPermissionModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">แก้ไขข้อมูลหน้าที่</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal">
            <div class="form-group">

              <label for="permissionName" class="col-sm-2 col-md-3 control-label">คีย์</label>
              <div class="col-sm-8 col-md-6">
                <input type="text" class="form-control" id="permissionName" ng-model="selected.name">
              </div>

            </div>
            <div class="form-group">

              <label for="permissionDisplayname" class="col-sm-2 col-md-3 control-label">ชื่อหน้าที่</label>
              <div class="col-sm-8 col-md-6">
                <input type="text" class="form-control" id="permissionDisplayname" ng-model="selected.display_name">
              </div>
              
            </div>
            <div class="form-group">

              <label for="permissionDesc" class="col-sm-2 col-md-3 control-label">คำอธิบาย</label>
              <div class="col-sm-8 col-md-6">
                <textarea class="form-control" id="permissionDesc" rows="3" ng-model="selected.description"></textarea>
              </div>

            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" ng-click="updatePermission()">Update</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="deletePermissionModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">ลบข้อมูลหน้าที่</h4>
        </div>
        <div class="modal-body">
          <p>คุณต้องการลบ <b>{{selected.display_name}}</b> ออกจากระบบใช่ไหรือไม่</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger" ng-click="deletePermission()">Delete</button>
        </div>
      </div>
    </div>
  </div>

</div>