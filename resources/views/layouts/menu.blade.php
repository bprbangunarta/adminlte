<ul class="sidebar-menu" data-widget="tree">
    <li class="header">GENERAL MENU</li>
    <li class="{{ Route::is('dashboard') ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}">
            <i class="fa fa-tv"></i> <span>Dashboard</span>
        </a>
    </li>

    <li class="{{ Route::is('profile.index') ? 'active' : '' }}">
        <a href="{{ route('profile.index') }}">
            <i class="fa fa-user"></i> <span>User Profile</span>
        </a>
    </li>

    <li class="header">ADMINISTRATOR</li>
    <li>
        <a href="/telescope" target="_blank">
            <i class="fa fa-laptop"></i> <span>Monitoring</span>
        </a>
    </li>

    <li class="treeview {{ Route::is('permissions.*', 'roles.*', 'users.*') ? 'active' : '' }}">
        <a href="javascript:void(0);">
            <i class="fa fa-gear"></i> <span>Pengaturan</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ Route::is('permissions.*') ? 'active' : '' }}">
                <a href="{{ route('permissions.index') }}">
                    <i class="fa fa-lock"></i> Kelola Perizinan
                </a>
            </li>

            <li class="{{ Route::is('roles.*') ? 'active' : '' }}">
                <a href="{{ route('roles.index') }}">
                    <i class="fa fa-key"></i> Kelola Peranan
                </a>
            </li>

            <li class="{{ Route::is('users.*') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}">
                    <i class="fa fa-user"></i> Kelola Pengguna
                </a>
            </li>
        </ul>
    </li>
</ul>