<div class="navbar-bg"></div>

<nav class="navbar navbar-expand-lg main-navbar sticky">
    <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar"
                    class="nav-link nav-link-lg
                                collapse-btn"> <i
                        data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                    <i data-feather="maximize"></i>
                </a></li>

        </ul>
    </div>
    <ul class="navbar-nav navbar-right">
        @if (auth()->user()->user_type == 1)
            <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                    class="nav-link nav-link-lg message-toggle"><i data-feather="bell"></i>
                    <span class="badge headerBadge1">
                        {{ auth()->user()->unreadNotifications->count() }} </span> </a>
                <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                    <div class="dropdown-header">
                        Notifications
                        @if (auth()->user()->unreadNotifications->count() > 0)
                            <div class="float-right">
                                <a href="{{ route('trackingProject.mark.all.read') }}">Mark All As Read</a>
                            </div>
                        @endif
                    </div>
                    <div class="dropdown-list-content dropdown-list-message">
                        @forelse (auth()->user()->unreadNotifications as $notification)
                            <a href="#" class="dropdown-item">
                                <span class="dropdown-item-avatar
                        text-white">
                                    <img alt="image" src="{{ \Storage::url($notification->data['avatar']) }}"
                                        class="rounded-circle">
                                </span>
                                <span class="dropdown-item-desc"> <span
                                        class="message-user">{{ $notification->data['user_name'] }}</span>
                                    <span class="time messege-text">Update status
                                        <strong> {{ $notification->data['project_name'] }}</strong>
                                        project
                                        to
                                        @if ($notification->data['user_project_status'] == 0)
                                            Not Started
                                        @elseif($notification->data['user_project_status'] == 1)
                                            Started
                                        @elseif($notification->data['user_project_status'] == 2)
                                            Completed
                                        @endif
                                    </span>
                                    {{-- <span class="time">2 Min Ago</span> --}}
                                </span>
                            </a>
                        @empty
                            <span class="time mx-5 text-muted">No new notification</span>
                        @endforelse
                    </div>
                    {{-- @if (auth()->user()->unreadNotifications->count() > 0)
                    <div class="dropdown-footer text-center">
                        <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                    </div>
                @endif --}}
                </div>
            </li>
        @endif

        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image"
                    src="{{ \Storage::url(auth()->user()->avatar) }}" class="user-img-radious-style"> <span
                    class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
                <div class="dropdown-title">Hello {{ auth()->user()->fname }}</div>
                <a href="{{ route('profile.index') }}" class="dropdown-item has-icon"> <i
                        class="far
                                    fa-user"></i> Profile
                </a>

                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <a class="dropdown-item has-icon text-danger" href="#"
                        onclick="event.preventDefault();
                        this.closest('form').submit();"><i
                            class="fas fa-sign-out-alt"></i>
                        Logout</a>
                </form>

            </div>
        </li>
    </ul>
</nav>
