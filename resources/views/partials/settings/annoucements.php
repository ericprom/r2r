<div ng-controller="AnnoucementsController">
  <section class="content-header">
    <h1>
      Annoucements
      <small>ข่าวประชาสัมพันธ์</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="/admin">Admin</a></li>
      <li class="active">Annoucements</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title"><i class="fa fa-bullhorn"></i> ข่าวประชาสัมพันธ์</h3>

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
                  <th width="50%">หัวข้อข่าวประชาสัมพันธ์</th>
                  <th width="15%">ผู้ประกาศ</th>
                  <th width="15%">วันที่ลงประกาศ</th>
                  <th width="15%">วันที่แก้ไขล่าสุด</th>
                  <th width="5%">&nbsp;</th>
                </tr>
                <tr ng-hide="dataLists.annoucements.length>0">
                  <td colspan="5" class="text-vertical-center text-center"><h3>ไม่มีข้อมูลข่าวประชาสัมพันธ์</h3></td>
                </tr>
                <tr ng-repeat="annoucement in dataLists.annoucements">
                  <td class="text-vertical-center">
                    <div ng-class="(annoucement.active==1)?'null':'strikethrough'">{{annoucement.title}}</div>
                  </td>
                  <td class="text-vertical-center">
                    <div ng-class="(annoucement.active==1)?'null':'strikethrough'">{{annoucement.reporter.name}}</div>
                  </td>
                  <td class="text-vertical-center">
                    <div ng-class="(annoucement.active==1)?'null':'strikethrough'">{{annoucement.created_at | dateonly}}</div>
                  </td>
                  <td class="text-vertical-center">
                    <div ng-class="(annoucement.active==1)?'null':'strikethrough'">{{annoucement.updated_at | dateonly}}</div>
                  </td>
                  <td>
                    <div class="pull-right manage-link">
                      <button type="button" class="btn btn-box-tool" ng-click="edit(annoucement)">
                        <i class="fa fa-edit" style="font-size: 18px;"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <div class="box-footer clearfix">
            <a class="btn btn-primary" ng-click="add()"><i class="fa fa-plus"></i> เพิ่มข่าวประชาสัมพันธ์</a>
            <span ng-hide="dataLists.annoucements==''">
              <pagination ng-model="currentPage" total-items="total" max-size="maxSize" boundary-links="true"></pagination>
            </span>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="modal fade" id="manageAnnoucementModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">ข่าวประชาสัมพันธ์</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
              <div class="form-group">
                <label for="annoucementTitle">หัวข้อข่าวประชาสัมพันธ์</label>
                <input type="text" class="form-control" id="annoucementTitle" ng-model="fields.annoucement.title">
              </div>
            </div>
            <div class="col-sm-2"></div>
          </div>
          <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
              <div class="form-group">
                <label for="annoucementDetail" class="control-label">รายละเอียด</label>
                <textarea class="form-control" id="annoucementDetail" rows="3" placeholder="รายละเอียด" ng-model="fields.annoucement.detail"></textarea>
              </div>
            </div>
            <div class="col-sm-2"></div>
          </div>
          <div class="row" ng-show="fields.annoucement.id"> 
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
              <div class="form-group">
                <label for="annoucementActive" class="control-label">&nbsp;</label>
                <span class="cursor-pointer" ng-click="toggleStatus(fields.annoucement)">
                  <i class="fa" ng-class="(fields.annoucement.active)?' fa-check-square-o':' fa-square-o'"></i> 
                    <span ng-show="fields.annoucement.active">เปิด</span><span ng-show="!fields.annoucement.active">ปิด</span>ใช้งาน
                </span>
              </div>
            </div>
            <div class="col-sm-2"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" ng-click="save()">บันทึกข้อมูล</button>
        </div>
      </div>
    </div>
  </div>
</div>