<div ng-controller="ReportResearchesController">
  <section class="content-header">
    <h1>
      Report
      <small>รายงานงานวิจัย</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li>Report</li>
      <li class="active">Researches</li>
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
              <span data-toggle="tooltip" title="มีงานวิจัยทั้งหมด {{total}} เรื่อง" class="badge bg-light-blue">{{total}}</span>
            </div>
          </div>
          <div class="box-body no-padding">
            <div>
              <table class="table table-hover table-list">
                <tr>
                  <th width="49%">ชื่อเรื่อง</th>
                  <th width="15%" class="text-center">ประเภทชิ้นงาน</th>
                  <th width="15%" class="text-center">ระดับการตีพิมพ์</th>
                  <th width="11%" class="text-center">ปีงบประมาณ</th>
                  <th width="10%">&nbsp;</th>
                </tr>
                <tr ng-hide="dataLists.researches.length>0">
                  <td colspan="5" class="text-vertical-center text-center"><h3>ไม่มีข้อมูลรายงานการวิจัย</h3></td>
                </tr>
                <tr ng-repeat="research in dataLists.researches">
                  <td class="text-vertical-center">
                    <div ng-class="(research.active==1)?'null':'strikethrough'">{{research.title}}</div>
                  </td>
                  <td class="text-vertical-center text-center">
                    <div ng-class="(research.active==1)?'null':'strikethrough'">{{getTypeDetail(research.type_id).name}}</div>
                  </td>
                  <td class="text-vertical-center text-center">
                    <div ng-class="(research.active==1)?'null':'strikethrough'">{{getLevelDetail(research.level_id).name}}</div>
                  </td>
                  <td class="text-vertical-center text-center">
                    <div ng-class="(research.active==1)?'null':'strikethrough'">{{research.fiscal_year}}</div>
                  </td>
                  <td>
                    <div class="pull-right manage-link">
                      <a href="{{research.research.path}}" class="btn btn-box-tool" target="_self" download="{{research.research.name}}" data-toggle="tooltip" title="ไฟล์งานวิจัย">
                        <i class="fa fa-file-pdf-o" style="font-size: 18px;"></i>
                      </a>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <div class="box-footer clearfix" ng-hide="dataLists.researches==''">
            <span>
              <pagination ng-model="currentPage" total-items="total" max-size="maxSize" boundary-links="true"></pagination>
            </span>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>