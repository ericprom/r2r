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
                    <div ng-class="(officer.active==1)?'null':'strikethrough'">{{officer.work.start_date}}</div>
                  </td>
                  <td>
                    <div class="pull-right manage-link"></div>
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
</div>