<div  ng-controller="SeminarEditController">
  <section class="content-header">
    <h1>
      Seminar Edit
      <small>แก้ไขงานอบรมสัมนา</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Seminar Edit</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-file-text-o"></i> งานอบรมสัมนา</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-sm-2"></div>
              <div class="col-sm-8">
                <div class="form-group">
                  <label for="seminarTitle">หัวข้อโครงการ</label>
                  <input type="text" class="form-control" id="seminarTitle" ng-model="fields.seminar.title">
                </div>
              </div>
              <div class="col-sm-2"></div>
            </div>
            <div class="row">
              <div class="col-sm-2"></div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="seminarStartDate">ตั้งแต่วันที่</label>
                  <div class="input-group date col-md-12" data-provide="datepicker" data-date-format="dd/mm/yyyy">
                    <input type="text" class="form-control" id="seminarStartDate" ng-model="fields.seminar.start">
                    <div class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="seminarEndDate">ถึงวันที่</label>
                  <div class="input-group date col-md-12" data-provide="datepicker" data-date-format="dd/mm/yyyy">
                    <input type="text" class="form-control" id="seminarEndDate" ng-model="fields.seminar.end">
                    <div class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2"></div>
            </div>
            <div class="row">
              <div class="col-sm-2"></div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="seminarFiscalYear">ปีงบประมาณ</label>
                  <input type="text" class="form-control" id="seminarFiscalYear" ng-model="fields.seminar.fiscal_year">
                </div>
              </div>
              <div class="col-sm-4">
              </div>
              <div class="col-sm-2"></div>
            </div>
            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>ไฟล์แนบ</label>
                  <div ng-hide="!fields.seminar_file">
                    <i class="fa fa-file-pdf-o"></i>
                    {{fields.seminar_file.name}}
                    <i class="fa fa-times cursor-pointer" ng-click="remove('seminar')"></i>
                  </div>
                  <button class="btn btn-default btn-block" 
                    ng-hide="fields.seminar_file"
                    ng-click="change('seminar')">
                    <i class="fa fa-file-pdf-o"></i> รายงานการฝึกอบรม(แนบไฟล์)
                  </button>
                  <form name="form" role="form">
                    <input type="file" name="seminar" accept="application/pdf" class="hidden" id="formSeminar"
                      onchange="angular.element(this).scope().uploaded('seminar',this);this.value=null;return false;">
                  </form>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>&nbsp;</label>
                  <div ng-hide="!fields.knowledge_file">
                    <i class="fa fa-file-pdf-o"></i>
                    {{fields.knowledge_file.name}}
                    <i class="fa fa-times cursor-pointer" ng-click="remove('knowledge')"></i>
                  </div>
                  <button class="btn btn-default btn-block" 
                    ng-hide="fields.knowledge_file"
                    ng-click="change('knowledge')">
                    <i class="fa fa-file-pdf-o"></i> รายงานการนำความรู้ไปใช้(แนบไฟล์)
                  </button>
                  <form name="form" role="form">
                    <input type="file" name="knowledge" accept="application/pdf" class="hidden" id="formKnowledge"
                      onchange="angular.element(this).scope().uploaded('knowledge',this);this.value=null;return false;">
                  </form>
                </div>
              </div>
              <div class="col-md-2"></div>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-info" ng-click="update()">
          <i class="fa fa-upload"></i> บันทึกข้อมูล
        </button>
        <button type="submit" class="btn btn-danger pull-right" ng-click="delete()">
          <i class="fa fa-trash"></i> ลบข้อมูลงานอบรมสัมนา
        </button>
      </div>
    </div>
  </section>
  <div class="modal fade" id="deleteSeminarModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <b>ข้อมูลงานอบรมสัมนา</b>
        </div>
        <div class="modal-body">
          คุณต้องการที่จะลบ <b>{{ fields.seminar.title }}</b> ออกจากฐานข้อมูล ใช่หรือไม่?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">กลับ</button>
          <button class="btn btn-danger btn-ok" ng-click="deleteSeminar()">ลบรายการ</button>
        </div>
      </div>
    </div>
  </div>
</div>