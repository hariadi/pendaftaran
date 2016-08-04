<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#frontend-navbar-collapse">
                <span class="sr-only">{{ trans('labels.general.toggle_navigation') }}</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
			<a itemprop="url" class="navbar-brand" href="{!! route('frontend.index') !!}">
				<img itemprop="logo" height="28" alt="Logo JPA" src="{{ asset('img/jpa-101pxx119px.png') }}" data-toggle="tooltip" title="{!! app_name() !!}" data-placement="bottom">
				<h1><span class="sr-only" itemprop="name">{!! app_name() !!}</span></h1>
			</a>

        </div><!--navbar-header-->

        {!! Form::open(['method' => 'GET', 'class' => 'navbar-form collapsed navbar-left', 'role' => 'search']) !!}
    	<div class="form-group inner-addon left-addon">
            {!! Form::label('term', 'Carian', ['class' => 'sr-only']); !!}
            <i class="fa fa-search"></i>
            {!! Form::text('term', request('term', null), ['class' => 'form-control', 'placeholder' => 'Aktiviti atau lokasi']) !!}
        </div>
        {!! Form::close() !!}


        <div class="collapse navbar-collapse" id="frontend-navbar-collapse">

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">

            	@if (Request::is('/'))
				<li{{ (request('view', 'list') == 'list') ? ' class=active' : '' }}>

					<a class="view btn-lg" data-placement="auto" data-toggle="tooltip" title="Paparan secara senarai" href="{{ route('frontend.index', array_merge(request()->query(), ['view' => 'list'])) }}"><span class="fa fa-list"></span>&nbsp; <span class="sr-only">Paparan secara senarai</span></a>

				</li>

				<li{{ (request('view') == 'grid') ? ' class=active' : '' }}>

					<a class="view btn-lg" data-placement="auto" data-toggle="tooltip" title="Paparan secara grid" href="{{ route('frontend.index', array_merge(request()->query(), ['view' => 'grid'])) }}"><span class="fa fa-th"></span>&nbsp; <span class="sr-only">Paparan secara grid</span></a>

				</li>
				@endif

                <!-- @if (config('locale.status') && count(config('locale.languages')) > 1)
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ trans('menus.language-picker.language') }}
                            <span class="caret"></span>
                        </a>

                        @include('includes.partials.lang')
                    </li>
                @endif -->

                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li>{!! link_to('login', trans('navs.frontend.login')) !!}</li>
                    <li>{!! link_to('register', trans('navs.frontend.register')) !!}</li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>{!! link_to_route('frontend.user.dashboard', trans('navs.frontend.dashboard')) !!}</li>

                            @if (access()->user()->canChangePassword())
                                <li>{!! link_to_route('auth.password.change', trans('navs.frontend.user.change_password')) !!}</li>
                            @endif

                            @permission('view-backend')
                                <li>{!! link_to_route('admin.dashboard', trans('navs.frontend.user.administration')) !!}</li>
                            @endauth

                            <li>{!! link_to_route('auth.logout', trans('navs.general.logout')) !!}</li>
                        </ul>
                    </li>
                @endif

            </ul>
        </div><!--navbar-collapse-->
    </div><!--container-->
</nav>
