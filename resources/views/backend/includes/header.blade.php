<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{!! route('frontend.index') !!}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img itemprop="logo" height="28" alt="Logo JPA" src="https://sistem.jpa.gov.my/smp/themes/default/assets/img/jpa-101pxx119px.png"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img itemprop="logo" height="28" alt="Logo JPA" src="https://sistem.jpa.gov.my/smp/themes/default/assets/img/jpa-101pxx119px.png"> <b>my</b>Daftar</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">{{ trans('labels.general.toggle_navigation') }}</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                {{-- @if (config('locale.status') && count(config('locale.languages')) > 1)
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ trans('menus.language-picker.language') }} <span class="caret"></span></a>
                        @include('includes.partials.lang')
                    </li>
                @endif --}}

                <!-- Notifications Menu -->
                <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-danger">1</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">{{ trans_choice('strings.backend.general.you_have.notifications', 0) }}</li>
                        <li>
                            <!-- Inner Menu: contains the notifications -->
                            <ul class="menu">
                                <li><!-- start notification -->
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                    </a>
                                </li><!-- end notification -->
                            </ul>
                        </li>
                        <li class="footer"><a href="#">{{ trans('strings.backend.general.see_all.notifications') }}</a></li>
                    </ul>
                </li>
                @if (auth()->check())
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="{!! access()->user()->picture !!}" class="user-image" alt="User Image"/>
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{ access()->user()->name }}</span>
                    </a>

                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="{!! access()->user()->picture !!}" class="img-circle" alt="User Image" />
                            <p>
                                {!! access()->user()->name !!}
                                <small>{{ trans('strings.backend.general.member_since') }} {!! access()->user()->created_at->formatLocalized('%d %b %Y') !!}</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Link</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Link</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Link</a>
                            </div>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">{{ trans('navs.backend.button') }}</a>
                            </div>
                            <div class="pull-right">
                                <a href="{!! route('auth.logout') !!}" class="btn btn-default btn-flat">{{ trans('navs.general.logout') }}</a>
                            </div>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </nav>
</header>
