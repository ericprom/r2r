<div ng-controller="ReportSeminarsController">
  <section class="content-header">
    <h1>
      Report
      <small>รายงานการอบรมสัมนา</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li>Report</li>
      <li class="active">Seminars</li>
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
              <span data-toggle="tooltip" title="มีงานอบรมสัมนาทั้งหมด {{total}} หัวข้อ" class="badge bg-light-blue">{{total}}</span>
            </div>
          </div>
          <div class="box-body no-padding">
            <div>
              <table class="table table-hover table-list">
                <tr>
                  <th width="49%">หัวข้อโครงการ</th>
                  <th width="15%" class="text-center">ตั้งแต่วันที่</th>
                  <th width="15%" class="text-center">ถึงวันที่</th>
                  <th width="11%" class="text-center">ปีงบประมาณ</th>
                  <th width="10%">&nbsp;</th>
                </tr>
                <tr ng-hide="dataLists.seminars.length>0">
                  <td colspan="5" class="text-vertical-center text-center"><h3>ไม่มีข้อมูลรายงานการอบรมสัมนา</h3></td>
                </tr>
                <tr ng-repeat="seminar in dataLists.seminars">
                  <td class="text-vertical-center">
                    <div ng-class="(seminar.active==1)?'null':'strikethrough'">{{seminar.title}}</div>
                  </td>
                  <td class="text-vertical-center text-center">
                    <div ng-class="(seminar.active==1)?'null':'strikethrough'">{{seminar.start_date | dateonly}}</div>
                  </td>
                  <td class="text-vertical-center text-center">
                    <div ng-class="(seminar.active==1)?'null':'strikethrough'">{{seminar.end_date | dateonly}}</div>
                  </td>
                  <td class="text-vertical-center text-center">
                    <div ng-class="(seminar.active==1)?'null':'strikethrough'">{{seminar.fiscal_year}}</div>
                  </td>
                  <td>
                    <div class="pull-right manage-link">
                       <a href="{{seminar.seminar.path}}" class="btn btn-box-tool" target="_self" download="{{seminar.seminar.name}}" data-toggle="tooltip" title="รายงานการฝึกอบรม">
                        <i class="fa fa-file-pdf-o" style="font-size: 18px;"></i>
                      </a>
                       <a href="{{seminar.knowledge.path}}" class="btn btn-box-tool" target="_self" download="{{seminar.knowledge.name}}" data-toggle="tooltip" title="รายงานการนำความรู้ไปใช้">
                        <i class="fa fa-file-pdf-o" style="font-size: 18px;"></i>
                      </a>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <div class="box-footer clearfix" ng-hide="dataLists.seminars==''">
            <span>
              <pagination ng-model="currentPage" total-items="total" max-size="maxSize" boundary-links="true"></pagination>
            </span>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>