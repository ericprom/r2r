<aside class="main-sidebar" ng-if="authenticatedUser">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img ng-src="@{{authenticatedUser.avatar}}" class="img-circle" alt="@{{authenticatedUser.name}}"/>
            </div>
            <div class="pull-left info">
                <p>@{{authenticatedUser.name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li ng-class="{active:isActive('/profile')}">
                <a href="{!! url('/profile'); !!}"><i class="fa fa-address-book"></i> <span>ข้อมูลส่วนตัว</span></a>
            </li>
            <li class="treeview" 
                ng-class="{active:isActive('/research/new') || isActive('/research/lists')}">
              <a href="#">
                <i class="fa fa-file-text"></i>
                <span>ข้อมูลงานวิจัย</span>
              </a>
              <ul class="treeview-menu">
                <li>
                    <a href="{!! url('/research/new'); !!}">
                        <i class="fa fa-pencil-square-o"></i> บันทึกข้อมูลงานวิจัย
                    </a>
                </li>
                <li>
                    <a href="{!! url('/research/lists'); !!}">
                        <i class="fa fa-circle-o"></i> รายงานงานวิจัย
                    </a>
                </li>
              </ul>
            </li>
            <li class="treeview" 
                ng-class="{active:isActive('/seminar/new') || isActive('/seminar/lists')}">
              <a href="#">
                <i class="fa fa-file-text"></i>
                <span>ข้อมูลอบรมสัมนา</span>
              </a>
              <ul class="treeview-menu">
                <li>
                    <a href="{!! url('/seminar/new'); !!}">
                        <i class="fa fa-pencil-square-o"></i> บันทึกข้อมูลอบรมสัมนา
                    </a>
                </li>
                <li>
                    <a href="{!! url('/seminar/lists'); !!}">
                        <i class="fa fa-circle-o"></i> รายงานการอบรมสัมนา
                    </a>
                </li>
              </ul>
            </li>
            @role((['super-admin','admin','executive']))
            <li class="treeview" 
                ng-class="{active:isActive('/reports') || isActive('/reports/researches') || isActive('/reports/seminars') || isActive('/reports/officers')}">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>รายงาน</span>
              </a>
              <ul class="treeview-menu">
                <li>
                    <a href="{!! url('/report/researches'); !!}">
                        <i class="fa fa-circle-o"></i> รายงานข้อมูลงานวิจัย
                    </a>
                </li>
                <li>
                    <a href="{!! url('/report/seminars'); !!}">
                        <i class="fa fa-circle-o"></i> รายงานข้อมูลการสัมนา
                    </a>
                </li>
                <li>
                    <a href="{!! url('/report/officers'); !!}">
                        <i class="fa fa-circle-o"></i> รายงานข้อมูลพนักงาน
                    </a>
                </li>
              </ul>
            </li>
            @endrole
            @role((['super-admin','admin']))
            <li class="header">SETTING AREA</li>
            <li ng-class="{active:isActive('/settings/users')}">
                <a href="{!! url('/settings/users'); !!}"><i class="fa fa-user-circle-o"></i> <span>จัดการพนักงาน</span></a>
            </li>
            @endrole
            <li ng-class="{active:isActive('/settings/account')}">
                <a href="{!! url('/settings/account'); !!}"><i class="fa fa-cog"></i> <span>จัดการบัญชีผู้ใช้</span></a>
            </li>
        </ul>
    </section>
</aside>