<header class="main-header" ng-if="authenticatedUser">
    <a ui-sref="dashboard" class="logo" href="/">
        <span class="logo-mini">R<b>2</b>R</span>
        <span class="logo-lg">Routine<b>2</b>Research</span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user-circle-o"></i>
                        <span class="hidden-xs">@{{authenticatedUser.name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img ng-src="@{{authenticatedUser.avatar}}" class="img-circle"
                                 alt="@{authenticatedUser.name}}"/>

                            <p>
                                @{{authenticatedUser.name}}
                                <small>@{{authenticatedUser.email}}</small>
                            </p>
                        </li>
                        @role((['super-admin']))
                        <li class="user-body">
                            <div class="col-xs-6 text-center">
                                <a href="{!! url('/admin/users'); !!}">
                                    <i class="fa fa-users"></i> จัดการผู้ใช้
                                </a>
                            </div>
                            <div class="col-xs-6">
                                <a href="{!! url('/admin/role-permissions'); !!}">
                                    <i class="fa fa-id-badge"></i> จัดการสิทธิ์
                                </a>
                            </div>
                        </li>
                        @endrole
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{!! url('/profile'); !!}" class="btn btn-default">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a ng-click="logout()" class="btn btn-default">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>