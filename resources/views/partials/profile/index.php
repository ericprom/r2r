<div  ng-controller="ProfileController">
  <section class="content-header">
    <h1>
      User Settings
      <small>แก้ไขข้อมูลส่วนตัว</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">User Settings</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-3">
        <div class="box box-primary">
          <div class="box-body box-profile">
            <form name="form" role="form">
              <input type="file" name="avatar" accept="image/*" class="hidden" id="formImage" 
                ng-model="form.avatar" 
                onchange="angular.element(this).scope().uploaded(this)">
                <img ng-src="{{image_source}}" class="profile-user-img img-responsive img-circle" alt="{{fields.user.name}}" style="width: 150px;" ng-click="change()"/>
            </form>
            <h3 class="profile-username text-center">{{fields.user.name || 'ไม่ระบุ'}}</h3>
            <p class="text-muted text-center">{{fields.user.email || 'ไม่ระบุ'}}</p>
            <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                <b>ตำแหน่ง</b> <a class="pull-right">{{fields.work.position || 'ไม่ระบุ'}}</a>
              </li>
              <li class="list-group-item">
                <b>รหัสพนักงาน</b> <a class="pull-right">{{fields.work.code || 'ไม่ระบุ'}}</a>
              </li>
              <li class="list-group-item">
                <b>สังกัด</b> <a class="pull-right">{{fields.work.department || 'ไม่ระบุ'}}</a>
              </li>
              <li class="list-group-item">
                <b>วันที่เข้าทำงาน</b> <a class="pull-right">{{fields.work.start_date || 'ไม่ระบุ' | dateonly}}</a>
              </li>
            </ul>
            <button class="btn btn-primary btn-block" ng-click="editWork(fields.work)"> แก้ไขข้อมูล </button>
          </div>
        </div>
      </div>
      <div class="col-md-9">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-id-card"></i> ข้อมูลส่วนตัว</h3>
            <div class="box-tools">
              <button type="button" class="btn btn-default btn-sm" ng-click="editInfo(fields.info)">
                <i class="fa fa-edit"></i>
              </button>
            </div>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <p>
                  <strong>ชื่อ(ไทย)</strong> <span class="text-muted">{{fields.user.name || 'ไม่ระบุ'}}</span>
                </p>
              </div>
              <div class="col-md-6">
                <p>
                  <strong>ชื่อ(English)</strong> <span class="text-muted">{{fields.info.name || 'ไม่ระบุ'}}</span>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <p>
                  <strong>เพศ</strong> <span class="text-muted">{{getGender(fields.info.gender)}}</span>
                </p>
              </div>
              <div class="col-md-4">
                <p>
                  <strong>เชื้อชาติ</strong> <span class="text-muted">{{fields.info.origin || 'ไม่ระบุ'}}</span>
                </p>
              </div>
              <div class="col-md-4">
                <p>
                  <strong>สัญชาติ</strong> <span class="text-muted">{{fields.info.nationality || 'ไม่ระบุ'}}</span>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <p>
                  <strong>สถานภาพ</strong> <span class="text-muted">{{getStatus(fields.info.status)}}</span>
                </p>
              </div>
              <div class="col-md-4">
                <p>
                  <strong>กรุ๊ปเลือด</strong> <span class="text-muted">{{fields.info.blood_group || 'ไม่ระบุ'}}</span>
                </p>
              </div>
              <div class="col-md-4">
                <p>
                  <strong>ศาสนา</strong> <span class="text-muted">{{fields.info.religion || 'ไม่ระบุ'}}</span>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <strong>ที่อยู่ที่ติดต่อได้</strong>
                <p class="text-muted">{{fields.info.address || 'ไม่ระบุ'}}</p>
              </div>
              <div class="col-md-4">
                <strong>เลขที่บัตรประชาชน</strong>
                <p class="text-muted">{{fields.info.id_card || 'ไม่ระบุ'}}</p>
              </div>
              <div class="col-md-4">
                <p>
                  <strong>เบอร์โทร</strong> <span class="text-muted">{{fields.info.phone || 'ไม่ระบุ'}}</span>
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-graduation-cap"></i> ข้อมูลการศึกษา</h3>
            <div class="box-tools">
              <button type="button" class="btn btn-default btn-sm" ng-click="editEdu(fields.education)">
                <i class="fa fa-edit"></i>
              </button>
            </div>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <strong>ระดับ</strong>
                <p class="text-muted">{{fields.edu.degree || 'ไม่ระบุ'}}</p>
              </div>
              <div class="col-md-6">
                <strong>วุฒิการศึกษา</strong>
                <p class="text-muted">{{fields.edu.type || 'ไม่ระบุ'}}</p>
              </div>
              <div class="col-md-6">
                <strong>สาขา</strong>
                <p class="text-muted">{{fields.edu.department || 'ไม่ระบุ'}}</p>
              </div>
              <div class="col-md-6">
                <strong>คณะ</strong>
                <p class="text-muted">{{fields.edu.faculty || 'ไม่ระบุ'}}</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <strong>สถาบัน</strong>
                <p class="text-muted">{{fields.edu.university || 'ไม่ระบุ'}}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="modal fade" id="workModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">แก้ไขข้อมูลการทำงาน</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal">
            <div class="form-group">
              <label for="workPosition" class="col-sm-2 col-md-3 control-label">ตำแหน่ง</label>
              <div class="col-sm-8 col-md-6">
                <input type="text" class="form-control" id="workPosition" placeholder="" ng-model="fields.work.position">
              </div>
            </div>
            <div class="form-group">
              <label for="workCode" class="col-sm-2 col-md-3 control-label">รหัสพนักงาน</label>
              <div class="col-sm-8 col-md-6">
                <input type="text" class="form-control" id="workCode" placeholder="" ng-model="fields.work.code">
              </div>
            </div>
            <div class="form-group">
              <label for="workDept" class="col-sm-2 col-md-3 control-label">สังกัด</label>
              <div class="col-sm-8 col-md-6">
                <input type="text" class="form-control" id="workDept" placeholder="" ng-model="fields.work.department">
              </div>
            </div>
            <div class="form-group">
              <label for="startDate" class="col-sm-2 col-md-3 control-label">วันที่เข้าทำงาน</label>
              <div class="col-sm-8 col-md-6">
                <div class="input-group date col-md-12" data-provide="datepicker" data-date-format="dd/mm/yyyy">
                  <input type="text" class="form-control" id="startDate" ng-model="fields.work.date">
                  <div class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" 
            ng-click="updateWork()">บันทึก</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="infoModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">แก้ไขข้อมูลส่วนตัว</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="userNameTH" class="control-label">ชื่อ-สกุล(ไทย)</label>
                <input type="text" class="form-control" id="userNameTH" ng-model="fields.user.name">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="userNameEN" class="control-label">ชื่อ-สกุล(English)</label>
                <input type="text" class="form-control" id="userNameEN" ng-model="fields.info.name">
              </div>
            </div>
            <div class="col-sm-2"></div>
          </div>
          <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="userIDCard" class="control-label">เลขที่บัตรประชาชน</label>
                <input type="text" class="form-control" id="userIDCard" ng-model="fields.info.id_card">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="userPhone" class="control-label">เบอร์ติดต่อ</label>
                <input type="text" class="form-control" id="userPhone" ng-model="fields.info.phone">
              </div>
            </div>
            <div class="col-sm-2"></div>
          </div>
          <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="userGender" class="control-label">เพศ</label>
                    <ui-select data-ng-model="fields.info.gender" id="userGender" >
                      <ui-select-match>{{$select.selected.name}}</ui-select-match>
                      <ui-select-choices repeat="gender.id as gender in dataLists.genders| filter : {name : $select.search}">
                        <div ng-bind-html="gender.name | highlight: $select.search"></div>
                      </ui-select-choices>
                    </ui-select>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="userOrigin" class="control-label">เชื้อชาติ</label>
                    <input type="text" class="form-control" id="userOrigin" ng-model="fields.info.origin">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="userNationality" class="control-label">สัญชาติ</label>
                    <input type="text" class="form-control" id="userNationality" ng-model="fields.info.nationality">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-2"></div>
          </div>
          <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="userStatus" class="control-label">สถานะภาพ</label>
                    <ui-select data-ng-model="fields.info.status" id="userStatus" >
                      <ui-select-match>{{$select.selected.name}}</ui-select-match>
                      <ui-select-choices repeat="status.id as status in dataLists.status| filter : {name : $select.search}">
                        <div ng-bind-html="status.name | highlight: $select.search"></div>
                      </ui-select-choices>
                    </ui-select>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="userBlood" class="control-label">กรุ๊ปเลือด</label>
                    <input type="text" class="form-control" id="userBlood" ng-model="fields.info.blood_group">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="userReligion" class="control-label">ศาสนา</label>
                    <input type="text" class="form-control" id="userReligion" ng-model="fields.info.religion">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-2"></div>
          </div>
          <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
              <div class="form-group">
                <label for="userAddress" class="control-label">ที่อยู่ที่ติดต่อได้</label>
                <textarea class="form-control" id="userAddress" rows="3" placeholder="รายละเอียดที่อยู่" ng-model="fields.info.address"></textarea>
              </div>
            </div>
            <div class="col-sm-2"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" 
            ng-click="updateInfo()">บันทึก</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="eduModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">แก้ไขข้อมูลการศึกษา</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="eduDegree" class="control-label">ระดับ</label>
                <input type="text" class="form-control" id="eduDegree" ng-model="fields.edu.degree">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="eduType" class="control-label">วุฒิการศึกษา</label>
                <input type="text" class="form-control" id="eduType" ng-model="fields.edu.type">
              </div>
            </div>
            <div class="col-sm-2"></div>
          </div>
          <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="eduDepartment" class="control-label">สาขา</label>
                <input type="text" class="form-control" id="eduDepartment" ng-model="fields.edu.department">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="eduFaculty" class="control-label">คณะ</label>
                <input type="text" class="form-control" id="eduFaculty" ng-model="fields.edu.faculty">
              </div>
            </div>
            <div class="col-sm-2"></div>
          </div>
          <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
              <div class="form-group">
                <label for="eduUniversity" class="control-label">สถาบัน</label>
                <input type="text" class="form-control" id="eduUniversity" ng-model="fields.edu.university">
              </div>
            </div>
            <div class="col-sm-2"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" 
            ng-click="updateEdu()">บันทึก</button>
        </div>
      </div>
    </div>
  </div>
</div>