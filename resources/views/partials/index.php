<section class="content-header">
  <h1>
    Announcements
    <small>ข่าวประชาสัมพันธ์</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Announcements</li>
  </ol>
</section>
<section class="content"  ng-controller="DashboardController">
  <div class="box box-primary">
    <div class="box-body box-profile">
      <div class="post"  ng-repeat="annoucement in dataLists.annoucements">
        <div class="user-block">
          <h3>{{annoucement.title}}</h3>
          <span class="label label-default">ผู้ประกาศ: {{annoucement.reporter.name}}</span>
          <span class="label label-default">วันที่ประกาศ: {{annoucement.created_at | dateonly}}</span>
        </div>
        <div class="row margin-bottom">
          <div class="col-sm-12">
            {{annoucement.detail}}
          </div>
        </div>
      </div>
    </div>
    <div class="box-footer clearfix">
      <span ng-hide="dataLists.annoucements==''">
        <pagination ng-model="currentPage" total-items="total" max-size="maxSize" boundary-links="true"></pagination>
      </span>
    </div>
  </div>
</section>