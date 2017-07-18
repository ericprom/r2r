<div  ng-controller="ResearchNewController">
  <section class="content-header">
    <h1>
      Research
      <small>อัพโหลดงานวิจัย</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Research</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-file-text-o"></i> งานวิจัย</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-sm-2"></div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="researchTitle">ชื่อเรื่อง</label>
                  <input type="text" class="form-control" id="researchTitle" ng-model="fields.research.title">
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="researchFiscalYear" class="control-label">ปีงบประมาณ</label>
                  <input type="text" class="form-control" id="researchFiscalYear" ng-model="fields.research.fiscal_year">
                </div>
              </div>
              <div class="col-sm-2"></div>
            </div>
            <div class="row">
              <div class="col-sm-2"></div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="researchType">ประเภทชิ้นงาน</label>
                  <ui-select data-ng-model="fields.research.type_id" id="researchType" >
                      <ui-select-match>{{$select.selected.name}}</ui-select-match>
                      <ui-select-choices repeat="type.id as type in dataLists.types| filter : {name : $select.search}">
                        <div ng-bind-html="type.name | highlight: $select.search"></div>
                      </ui-select-choices>
                    </ui-select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="researchLevel" class="control-label">ระดับการตีพิมพ์</label>
                  <ui-select data-ng-model="fields.research.level_id" id="researchLevel" >
                      <ui-select-match>{{$select.selected.name}}</ui-select-match>
                      <ui-select-choices repeat="level.id as level in dataLists.levels| filter : {name : $select.search}">
                        <div ng-bind-html="level.name | highlight: $select.search"></div>
                      </ui-select-choices>
                    </ui-select>
                </div>
              </div>
              <div class="col-sm-2"></div>
            </div>
            <div class="row">
              <div class="col-sm-2"></div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="researchReseacher">ผู้วิจัยหลัก</label>
                  <input type="text" class="form-control" id="researchReseacher" ng-model="fields.research.researcher">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="researchSecondaryReseacher" class="control-label">ผู้วิจัยร่วม</label>
                  <input type="text" class="form-control" id="researchSecondaryReseacher" ng-model="fields.research.secondry_researcher">
                </div>
              </div>
              <div class="col-sm-2"></div>
            </div>
            <div class="row">
              <div class="col-sm-2"></div>
              <div class="col-sm-8">
                <div class="form-group">
                  <label for="researchPublisher">ชื่อวารสารที่ตีพิมพ์</label>
                  <input type="text" class="form-control" id="researchPublisher" ng-model="fields.research.publisher">
                </div>
              </div>
              <div class="col-sm-2"></div>
            </div>
            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>ไฟล์แนบ</label>
                  <div ng-hide="!fields.file">
                    <i class="fa fa-file-pdf-o"></i>
                    {{fields.file.name}}
                    <i class="fa fa-times cursor-pointer" ng-click="remove('research')"></i>
                  </div>
                  <button class="btn btn-default btn-block" 
                    ng-hide="fields.file"
                    ng-click="change('research')">
                    <i class="fa fa-file-pdf-o"></i> ไฟล์งานวิจัย(แนบไฟล์)
                  </button>
                  <form name="form" role="form">
                    <input type="file" name="research" accept="application/pdf" class="hidden" id="formResearch"
                      onchange="angular.element(this).scope().uploaded('research',this);this.value=null;return false;">
                  </form>
                </div>
              </div>
              <div class="col-md-2"></div>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-info" ng-click="add()">
          <i class="fa fa-upload"></i> บันทึกข้อมูล
        </button>
      </div>
    </div>
  </section>
</div>