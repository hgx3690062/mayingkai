<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ access()->user()->picture }}" class="img-circle" alt="User Image" />
            </div><!--pull-left-->
            <div class="pull-left info">
                <p>{{ access()->user()->full_name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('strings.backend.general.status.online') }}</a>
            </div><!--pull-left-->
        </div><!--user-panel-->

        <!-- search form (Optional) -->
        {{ Form::open(['route' => 'admin.search.index', 'method' => 'get', 'class' => 'sidebar-form']) }}
        <div class="input-group">
            {{ Form::text('q', Request::get('q'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => trans('strings.backend.general.search_placeholder')]) }}

            <span class="input-group-btn">
                    <button type='submit' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span><!--input-group-btn-->
        </div><!--input-group-->
    {{ Form::close() }}
    <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('menus.backend.sidebar.general') }}</li>

            <li class="{{ active_class(Active::checkUriPattern('admin/dashboard')) }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>{{ trans('menus.backend.sidebar.dashboard') }}</span>
                </a>
            </li>

            <li class="header">{{ trans('menus.backend.sidebar.system') }}</li>

            @role(1)
            <li class="{{ active_class(Active::checkUriPattern('admin/access/*')) }} treeview">
                <a href="javascript:void(0);">
                    <i class="fa fa-users"></i>
                    <span>{{ trans('menus.backend.access.title') }}</span>

                    @if ($pending_approval > 0)
                        <span class="label label-danger pull-right">{{ $pending_approval }}</span>
                    @else
                        <i class="fa fa-angle-left pull-right"></i>
                    @endif
                </a>

                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/access/*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/access/*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/access/user*')) }}">
                        <a href="{{ route('admin.access.user.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('labels.backend.access.users.management') }}</span>

                            @if ($pending_approval > 0)
                                <span class="label label-danger pull-right">{{ $pending_approval }}</span>
                            @endif
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/access/role*')) }}">
                        <a href="{{ route('admin.access.role.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('labels.backend.access.roles.management') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endauth
        </ul><!-- /.sidebar-menu -->
         {{--人员管理--}}
        @permission('view-guanli')
        <ul class="sidebar-menu">
            <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer*')) }} treeview">
                <a href="javascript:void(0);">
                    <i class="fa fa-address-book"></i>
                    <span>{{ trans('menus.backend.log-viewer.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer')) }}">
                            <a href="{{ route('admin.newshow') }}">
                            <i class="fa fa-address-book"></i>
                            <span>{{ trans('menus.backend.log-viewer.dashboard') }}</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer/logs')) }}">
                        <a href="{{ route('admin.create') }}">
                            <i class="fa fa-address-book"></i>
                            <span>{{ trans('menus.backend.log-viewer.shops') }}</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
        @endauth
        {{--商品管理--}}
@permission('view-pinglun')
        <ul class="sidebar-menu">
            <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer*')) }} treeview">
                <a href="javascript:void(0);">
                    <i class="fa  fa-envira "></i>
                    <span>{{ trans('labels.backend.access.users.comment') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer')) }}">
                        <a href="{{ route('admin.commentindex') }}">
                            <i class="fa fa-envira"></i>
                            <span>{{ trans('labels.backend.access.users.clothing') }}</span>
                        </a>
                    </li>
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer')) }}">
                        <a href="{{ route('admin.commentindex') }}">
                            <i class="fa fa-envira"></i>
                            <span>{{ trans('labels.backend.access.users.Fabric') }}</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
        @endauth
        {{--店铺管理--}}
        <ul class="sidebar-menu">
            <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer*')) }} treeview">
                <a href="javascript:void(0);">
                    <i class="fa  fa-pencil-square-o"></i>
                    <span>{{ trans('labels.backend.access.users.shops') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer')) }}">
                        <a href="{{ route('admin.commentindex') }}">
                            <i class="fa fa-pencil-square-o"></i>
                            <span>{{ trans('labels.backend.access.users.shops') }}</span>
                        </a>
                    </li>

                </ul>
            </li>

        </ul>
        {{--订单管理--}}
        <ul class="sidebar-menu">
            <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer*')) }} treeview">
                <a href="javascript:void(0);">
                    <i class="fa  fa-file-powerpoint-o"></i>
                    <span>{{ trans('labels.backend.access.users.order') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer')) }}">
                        <a href="{{ route('admin.commentindex') }}">
                            <i class="fa fa-file-powerpoint-o"></i>
                            <span>{{ trans('labels.backend.access.users.Order') }}</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer')) }}">
                        <a href="{{ route('admin.commentindex') }}">
                            <i class="fa fa-file-powerpoint-o"></i>
                            <span>{{ trans('labels.backend.access.users.Back') }}</span>
                        </a>
                    </li>
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer')) }}">
                        <a href="{{ route('admin.commentindex') }}">
                            <i class="fa fa-file-powerpoint-o"></i>
                            <span>{{ trans('labels.backend.access.users.approval') }}</span>
                        </a>
                    </li>
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer')) }}">
                        <a href="{{ route('admin.commentindex') }}">
                            <i class="fa fa-file-powerpoint-o"></i>
                            <span>{{ trans('labels.backend.access.users.complete') }}</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
        {{--客户中心--}}
        <ul class="sidebar-menu">
            <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer*')) }} treeview">
                <a href="javascript:void(0);">
                    <i class="fa  fa-android"></i>
                    <span>{{ trans('labels.backend.access.users.customer') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer')) }}">
                        <a href="{{ route('admin.commentindex') }}">
                            <i class="fa fa-android"></i>
                            <span>{{ trans('labels.backend.access.users.Online') }}</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer')) }}">
                        <a href="{{ route('admin.commentindex') }}">
                            <i class="fa fa-android"></i>
                            <span>{{ trans('labels.backend.access.users.Feedback') }}</span>
                        </a>
                    </li>

                </ul>
            </li>

        </ul>
        {{--系统管理--}}
        <ul class="sidebar-menu">
            <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer*')) }} treeview">
                <a href="javascript:void(0);">
                    <i class="fa fa-share-alt-square"></i>
                    <span>{{ trans('labels.backend.access.users.system') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer')) }}">
                        <a href="{{ route('admin.commentindex') }}">
                            <i class="fa fa-share-alt-square"></i>
                            <span>{{ trans('labels.backend.access.users.system') }}</span>
                        </a>
                    </li>

                </ul>
            </li>

        </ul>
    </section><!-- /.sidebar -->
</aside>