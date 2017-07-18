<div ng-controller="ResearchListsController">
  <section class="content-header">
    <h1>
      Research Lists
      <small>รายงานการวิจัย</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="/admin">Admin</a></li>
      <li class="active">Research Lists</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title"><i class="fa fa-list"></i> รายงานการวิจัย</h3>

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
                      <!-- <button type="button" class="btn btn-box-tool" ng-click="download(research)">
                        <i class="fa fa-file-pdf-o" style="font-size: 18px;"></i>
                      </button> -->
                      <button type="button" class="btn btn-box-tool" ng-click="edit(research)">
                        <i class="fa fa-edit" style="font-size: 18px;"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <div class="box-footer clearfix">
            <a href="/research/new" class="btn btn-primary"><i class="fa fa-plus"></i> บันทึกงานวิจัยใหม่</a>
            <span ng-hide="dataLists.researches==''">
              <pagination ng-model="currentPage" total-items="total" max-size="maxSize" boundary-links="true"></pagination>
            </span>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>