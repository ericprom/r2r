<div ng-controller="ReportOfficersController">
  <section class="content-header">
    <h1>
      Report
      <small>รายงานพนักงาน</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li>Report</li>
      <li class="active">Officers</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-search"></i> ค้นหา</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-sm-2">
                <ui-select ng-model="fields.timer" ng-change="changeTime()">
                  <ui-select-match placeholder="">{{$select.selected.name}}</ui-select-match>
                  <ui-select-choices repeat="timer as timer in dataLists.timers | filter : {name : $select.search}">
                    <div ng-bind-html="timer.name | highlight: $select.search"></div>
                  </ui-select-choices>
                </ui-select>
              </div>
              <div class="col-sm-4">
                <div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy">
                  <input type="text" class="form-control" id="dateFrom" ng-model="fields.start" ng-click="updateFilter()">
                  <div class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy">
                  <input type="text" class="form-control" id="dateTo" ng-model="fields.end" ng-click="updateFilter()">
                  <div class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                  </div>
                </div>
              </div>
              <div class="col-sm-2">
                <button type="button" class="btn btn-primary btn-block" ng-click="search()">Filter</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-list"></i> รายงาน</h3>
            <div class="box-tools">
              <span data-toggle="tooltip" title="มีพนักงานทั้งหมด {{total}} คน" class="badge bg-light-blue">{{total}}</span>
            </div>
          </div>
          <div class="box-body no-padding">
            <div>
              <table class="table table-hover table-list">
                <tr>
                  <th width="10%">รหัสพนักงาน</th>
                  <th>ชื่อ-สกุล</th>
                  <th width="10%">ตำแหน่ง</th>
                  <th width="10%">วันที่เริ่มงาน</th>
                  <th width="10%">&nbsp;</th>
                </tr>
                <tr ng-hide="dataLists.officers.length>0">
                  <td colspan="5" class="text-vertical-center text-center"><h3>ไม่มีข้อมูลรายงานพนักงาน</h3></td>
                </tr>
                <tr ng-repeat="officer in dataLists.officers">
                  <td class="text-vertical-center">
                    <div ng-class="(officer.active==1)?'null':'strikethrough'">{{officer.work.code}}</div>
                  </td>
                  <td class="text-vertical-center">
                    <div ng-class="(officer.active==1)?'null':'strikethrough'">{{officer.name}}</div>
                  </td>
                  <td class="text-vertical-center">
                    <div ng-class="(officer.active==1)?'null':'strikethrough'">{{officer.work.position}}</div>
                  </td>
                  <td class="text-vertical-center">
                    <div ng-class="(officer.active==1)?'null':'strikethrough'">{{officer.work.start_date | dateonly}}</div>
                  </td>
                  <td>
                    <div class="pull-right manage-link">
                      <button class="btn btn-box-tool" data-toggle="tooltip" title="ข้อมูลพนักงาน" ng-click="view(officer)">
                        <i class="fa fa-file-text-o" style="font-size: 18px;"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <div class="box-footer clearfix" ng-hide="dataLists.officers==''">
            <span>
              <pagination ng-model="currentPage" total-items="total" max-size="maxSize" boundary-links="true"></pagination>
            </span>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="modal fade" id="viewOfficerModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">ข้อมูลพนักงาน</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-3">
              <div class="box box-primary">
                <div class="box-body box-profile">
                  <img ng-src="{{fields.officer.user.avatar}}" class="profile-user-img img-responsive img-circle" alt="{{fields.officer.user.name}}" style="width: 150px;"/>
                  <h3 class="profile-username text-center">{{fields.officer.user.name || 'ไม่ระบุ'}}</h3>
                  <p class="text-muted text-center">{{fields.officer.user.email || 'ไม่ระบุ'}}</p>
                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b>ตำแหน่ง</b> <a class="pull-right">{{fields.officer.work.position || 'ไม่ระบุ'}}</a>
                    </li>
                    <li class="list-group-item">
                      <b>รหัสพนักงาน</b> <a class="pull-right">{{fields.officer.work.code || 'ไม่ระบุ'}}</a>
                    </li>
                    <li class="list-group-item">
                      <b>สังกัด</b> <a class="pull-right">{{fields.officer.work.department || 'ไม่ระบุ'}}</a>
                    </li>
                    <li class="list-group-item">
                      <b>วันที่เข้าทำงาน</b> <a class="pull-right">{{fields.officer.work.start_date || 'ไม่ระบุ' | dateonly}}</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-id-card"></i> ข้อมูลส่วนตัว</h3>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">
                      <p>
                        <strong>ชื่อ(ไทย)</strong> <span class="text-muted">{{fields.officer.user.name || 'ไม่ระบุ'}}</span>
                      </p>
                    </div>
                    <div class="col-md-6">
                      <p>
                        <strong>ชื่อ(English)</strong> <span class="text-muted">{{fields.officer.info.name || 'ไม่ระบุ'}}</span>
                      </p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <p>
                        <strong>เพศ</strong> <span class="text-muted">{{getGender(fields.officer.info.gender)}}</span>
                      </p>
                    </div>
                    <div class="col-md-4">
                      <p>
                        <strong>เชื้อชาติ</strong> <span class="text-muted">{{fields.officer.info.origin || 'ไม่ระบุ'}}</span>
                      </p>
                    </div>
                    <div class="col-md-4">
                      <p>
                        <strong>สัญชาติ</strong> <span class="text-muted">{{fields.officer.info.nationality || 'ไม่ระบุ'}}</span>
                      </p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <p>
                        <strong>สถานภาพ</strong> <span class="text-muted">{{getStatus(fields.officer.info.status)}}</span>
                      </p>
                    </div>
                    <div class="col-md-4">
                      <p>
                        <strong>กรุ๊ปเลือด</strong> <span class="text-muted">{{fields.officer.info.blood_group || 'ไม่ระบุ'}}</span>
                      </p>
                    </div>
                    <div class="col-md-4">
                      <p>
                        <strong>ศาสนา</strong> <span class="text-muted">{{fields.officer.info.religion || 'ไม่ระบุ'}}</span>
                      </p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <strong>ที่อยู่ที่ติดต่อได้</strong>
                      <p class="text-muted">{{fields.officer.info.address || 'ไม่ระบุ'}}</p>
                    </div>
                    <div class="col-md-4">
                      <strong>เลขที่บัตรประชาชน</strong>
                      <p class="text-muted">{{fields.officer.info.id_card || 'ไม่ระบุ'}}</p>
                    </div>
                    <div class="col-md-4">
                      <p>
                        <strong>เบอร์โทร</strong> <span class="text-muted">{{fields.officer.info.phone || 'ไม่ระบุ'}}</span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-graduation-cap"></i> ข้อมูลการศึกษา</h3>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">
                      <strong>ระดับ</strong>
                      <p class="text-muted">{{fields.officer.edu.degree || 'ไม่ระบุ'}}</p>
                    </div>
                    <div class="col-md-6">
                      <strong>วุฒิการศึกษา</strong>
                      <p class="text-muted">{{fields.officer.edu.type || 'ไม่ระบุ'}}</p>
                    </div>
                    <div class="col-md-6">
                      <strong>สาขา</strong>
                      <p class="text-muted">{{fields.officer.edu.department || 'ไม่ระบุ'}}</p>
                    </div>
                    <div class="col-md-6">
                      <strong>คณะ</strong>
                      <p class="text-muted">{{fields.officer.edu.faculty || 'ไม่ระบุ'}}</p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <strong>สถาบัน</strong>
                      <p class="text-muted">{{fields.officer.edu.university || 'ไม่ระบุ'}}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>