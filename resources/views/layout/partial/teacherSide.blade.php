<ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
    <li class="{{ request()->is('teacher/my/dashboard')?'active':'' }}"><a class="nav-link"
            href="{{ route('teacher.dashboard') }}"><i class="fas fa-cube"></i><span>Dashboard</span></a>
    </li>
    @if (Auth::user()->section()->where('school_year_id', $activeAY->id)->exists())
    <li class="{{ request()->is('teacher/my/class/monitor')?'active':'' }}">
        <a class="nav-link" href="{{ route('teacher.class.monitor') }}">
            <i class="fas fa-puzzle-piece"></i><span>
                Class Monitor</span>
        </a>
    </li>
    @endif
    <li class="menu-header">Data Entry</li>
    <li class="{{ request()->is('teacher/my/grading')?'active':'' }}"><a class="nav-link"
            href="{{ route('teacher.grading') }}"><i class="fas fa-cube"></i><span>Grading</span></a>
    </li>
    @if (Auth::user()->chairman()->where('school_year_id', $activeAY->id)->exists())
    <li class="menu-header">Chairman Setting</li>
    <li class="{{ request()->is('teacher/my/section')?'active':'' }}">
        <a class="nav-link" href="{{ route('teacher.section') }}">
            <i class="fas fa-border-all"></i><span>Manage Section</span>
        </a>
    </li>
    <li
        class="nav-item dropdown {{ request()->is('teacher/my/stem') || request()->is('teacher/my/bec') || request()->is('teacher/my/spa') || request()->is('teacher/my/spj')?'active':'' }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-users"></i><span>Enroll Student</span>
        </a>
        <ul class="dropdown-menu">
            <li class="{{ request()->is('teacher/my/stem')?'active':'' }}">
                <a class="nav-link" href="{{ route('teacher.stem') }}">
                    <i class="fas fa-atom"></i><span>STEM</span>
                </a>
            </li>
            <li class="{{ request()->is('teacher/my/bec')?'active':'' }}">
                <a class="nav-link" href="{{ route('teacher.bec') }}">
                    <i class="fas fa-users"></i><span>BEC</span>
                </a>
            </li>
            <li class="{{ request()->is('teacher/my/spa')?'active':'' }}">
                <a class="nav-link" href="{{ route('teacher.spa') }}">
                    <i class="fas fa-palette"></i><span>SP Art</span>
                </a>
            </li>
            <li class="{{ request()->is('teacher/my/spj')?'active':'' }}">
                <a class="nav-link" href="{{ route('teacher.spj') }}">
                    <i class="fas fa-file-signature"></i><span>SP Journalism</span>
                </a>
            </li>
        </ul>
    </li>
    @endif
    <li><a class="nav-link" href="{{ route('auth.logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                class="fas fa-sign-out-alt text-danger"></i><span class="text-danger">Logout</span></a>
        <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>
</ul>