<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">
                {{-- <h1 style="font-weight: bold;" class="text-sm">PD Engineers</h1> --}}
                {{-- @if ($setting && $setting->logo) --}}
                <span class="logo-name">
                    <img alt="image" src="{{ Storage::url($setting->logo) }}" class="header-logo" />
                </span>
                {{-- @endif --}}
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="dropdown {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i data-feather="home"></i><span>Dashboard</span></a>
            </li>
            @can('user_view')
                <li class="dropdown {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i data-feather="user"></i><span>Users</span></a>
                </li>
            @endcan
            @if (auth()->user()->user_type == 1)
                <li class="dropdown {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                    <a href="{{ route('roles.index') }}" class="nav-link">
                        <i data-feather="lock"></i><span>Roles & Permissions</span></a>
                </li>
            @endif

            @can('bank_guarantee_retention_money_view')
                <li class="dropdown {{ request()->routeIs('tracking.*') ? 'active' : '' }}">
                    <a href="{{ route('tracking.index') }}" class="nav-link"><i data-feather="shield"></i><span>Bank
                            Guarantee & Retention Money</span></a>
                </li>
            @endcan
            @can('tracking_project_view')
                <li class="dropdown {{ request()->routeIs('trackingProject.*') ? 'active' : '' }}">
                    <a href="{{ route('trackingProject.index') }}" class="nav-link"><i
                            data-feather="globe"></i><span>Tracking Project</span></a>
                </li>
            @endcan
            @can('tracking_project_timeline')
                <li class="dropdown {{ request()->routeIs('trackingProject.timeline') ? 'active' : '' }}">
                    <a href="{{ route('trackingProject.timeline') }}" class="nav-link"><i
                            data-feather="sliders"></i><span>Tracking Project Timeline</span></a>
                </li>
            @endcan
            @can('settings')
                <li class="dropdown {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                    <a href="{{ route('settings.edit') }}" class="nav-link"><i
                            data-feather="settings"></i><span>Settings</span></a>
                </li>
            @endcan

        </ul>
    </aside>
</div>
