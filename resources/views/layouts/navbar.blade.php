<header class="main-header">
    <a href="javascript:void(0);" class="logo" style="border-bottom: 1px solid white;">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>BPR</b></span>
        <!-- <img src="{{ asset('logo.png') }}" class="logo-mini" alt="logo" style="width: 50px;height:50px;"> -->
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>ADMIN</b>LTE</span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
        <a href="javascript:void(0);" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Notifications Menu -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">10</span>
                    </a>

                    <ul class="dropdown-menu">
                        <li class="header">You have 10 notifications</li>

                        <li>
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>

                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ Str::limit(Auth::user()->name, 20) }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">

                            <p>
                                {{ Str::limit(Auth::user()->name, 20) }}
                                <small>{{ Auth::user()->getRoleNames()->implode(', ') }}</small>
                            </p>
                        </li>

                        <li class="user-footer">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-default btn-block">
                                    Keluar
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>