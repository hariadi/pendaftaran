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
            <li class="{{ Active::pattern('dashboard') }}">
                <a href="{!! route('frontend.user.dashboard') !!}"><i class="fa fa-dashboard"></i> <span>{{ trans('menus.backend.sidebar.dashboard') }}</span></a>
            </li>

            @permission('view-event')
                <li class="{{ Active::pattern('event*') }} treeview">

                    <a href="{!!url('event')!!}">
                    	<i class="fa fa-calendar-plus-o"></i>
                    	<span>{{ trans('menus.backend.event.title') }}</span>
                    	<i class="fa fa-angle-left pull-right"></i>
                    </a>

                    <ul class="treeview-menu {{ Active::pattern('log-viewer*', 'menu-open') }}" style="display: none; {{ Active::pattern('event*', 'display: block;') }}">

                    	<li class="{{ Active::pattern('event') }}">
	                        <a href="{{ route('event.index') }}">{{ trans('menus.backend.event.list') }}</a>
	                    </li>

	                    <li class="{{ Active::pattern('event/create') }}">
	                        <a href="{{ route('event.create') }}">
		                    	<span>{{ trans('menus.backend.event.create') }}</span>
		                    </a>
	                    </li>

	                </ul>
                </li>
            @endauth

            @permission('view-participant')
                <li class="{{ Active::pattern('participant*') }} treeview">

                    <a href="{!!url('admin/participant')!!}">
                    	<i class="fa fa-users"></i>
                    	<span>{{ trans('menus.backend.participant.title') }}</span>
                    	<i class="fa fa-angle-left pull-right"></i>
                    </a>

                    <ul class="treeview-menu {{ Active::pattern('log-viewer*', 'menu-open') }}" style="display: none; {{ Active::pattern('participant*', 'display: block;') }}">

                    	<li class="{{ Active::pattern('participant') }}">
	                        <a href="{{ route('admin.participant.index') }}">{{ trans('menus.backend.participant.list') }}</a>
	                    </li>

	                    {{-- <li class="{{ Active::pattern('participant/create') }}">
	                        <a href="{{ route('participant.create') }}">
		                    	<span>{{ trans('menus.backend.participant.create') }}</span>
		                    </a>
	                    </li> --}}

	                </ul>
                </li>
            @endauth

            @permission('view-access-management')
                <li class="{{ Active::pattern('admin/access/*') }}">
                    <a href="{!!url('admin/access/users')!!}">
                    <i class="fa fa-user-secret"></i>
                    <span>{{ trans('menus.backend.access.title') }}</span></a>
                </li>
            @endauth

            @permission('view-report')
                <li class="{{ Active::pattern('report*') }}">
                    <a href="{!!url('admin/report')!!}">
                    <i class="fa fa-bar-chart"></i>
                    <span>{{ trans('menus.backend.report.title') }}</span></a>
                </li>
            @endauth

        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
