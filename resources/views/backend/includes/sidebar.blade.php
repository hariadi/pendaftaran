<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{!! access()->user()->picture !!}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{!! access()->user()->name !!}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('strings.backend.general.status.online') }}</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        {!! Form::open(['method' => 'GET', 'class' => 'sidebar-form', 'role' => 'search']) !!}
    	<div class="input-group">
            {!! Form::label('term', 'Carian', ['class' => 'sr-only']); !!}

            {!! Form::text('term', request('term', null), ['class' => 'form-control', 'placeholder' => trans('strings.backend.general.search_placeholder')]) !!}
            <span class="input-group-btn">
            	<button type='submit' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
            </span>
        </div>
        {!! Form::close() !!}
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('menus.backend.sidebar.general') }}</li>

            <!-- Optionally, you can add icons to the links -->
            <li class="{{ Active::pattern('admin/dashboard') }}">
                <a href="{!! route('admin.dashboard') !!}"><i class="fa fa-dashboard"></i> <span>{{ trans('menus.backend.sidebar.dashboard') }}</span></a>
            </li>

            @permission('view-event')
                <li class="{{ Active::pattern('admin/event*') }} treeview">

                    <a href="{!!url('admin/event')!!}">
                    	<i class="fa fa-calendar-plus-o"></i>
                    	<span>{{ trans('menus.backend.event.title') }}</span>
                    	<i class="fa fa-angle-left pull-right"></i>
                    </a>

                    <ul class="treeview-menu {{ Active::pattern('admin/log-viewer*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/event*', 'display: block;') }}">

                    	<li class="{{ Active::pattern('admin/event') }}">
	                        <a href="{{ route('admin.event.index') }}">{{ trans('menus.backend.event.list') }}</a>
	                    </li>

	                    <li class="{{ Active::pattern('admin/event/create') }}">
	                        <a href="{{ route('admin.event.create') }}">
		                    	<span>{{ trans('menus.backend.event.create') }}</span>
		                    </a>
	                    </li>

	                </ul>
                </li>
            @endauth

            @permission('view-participant')
                <li class="{{ Active::pattern('admin/participant*') }} treeview">

                    <a href="{!!url('admin/participant')!!}">
                    	<i class="fa fa-users"></i>
                    	<span>{{ trans('menus.backend.participant.title') }}</span>
                    	<i class="fa fa-angle-left pull-right"></i>
                    </a>

                    <ul class="treeview-menu {{ Active::pattern('admin/log-viewer*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/participant*', 'display: block;') }}">

                    	<li class="{{ Active::pattern('admin/participant') }}">
	                        <a href="{{ route('admin.participant.index') }}">{{ trans('menus.backend.participant.list') }}</a>
	                    </li>

	                    <li class="{{ Active::pattern('admin/participant/create') }}">
	                        <a href="{{ route('admin.participant.create') }}">
		                    	<span>{{ trans('menus.backend.participant.create') }}</span>
		                    </a>
	                    </li>

	                </ul>
                </li>
            @endauth

            @permission('view-report')
                <li class="{{ Active::pattern('admin/report*') }}">
                    <a href="{!!url('admin/report')!!}">
                    <i class="fa fa-bar-chart"></i>
                    <span>{{ trans('menus.backend.report.title') }}</span></a>
                </li>
            @endauth

            @permission('view-access-management')
                <li class="{{ Active::pattern('admin/access/*') }}">
                    <a href="{!!url('admin/access/users')!!}"><span>{{ trans('menus.backend.access.title') }}</span></a>
                </li>
            @endauth

            <li class="{{ Active::pattern('admin/log-viewer*') }} treeview">
                <a href="#">
                    <span>{{ trans('menus.backend.log-viewer.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ Active::pattern('admin/log-viewer*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/log-viewer*', 'display: block;') }}">
                    <li class="{{ Active::pattern('admin/log-viewer') }}">
                        <a href="{!! url('admin/log-viewer') !!}">{{ trans('menus.backend.log-viewer.dashboard') }}</a>
                    </li>
                    <li class="{{ Active::pattern('admin/log-viewer/logs') }}">
                        <a href="{!! url('admin/log-viewer/logs') !!}">{{ trans('menus.backend.log-viewer.logs') }}</a>
                    </li>
                </ul>
            </li>

        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
