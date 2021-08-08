<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">PNOP</a>
            <p style="font-size: 11px;margin-top:-21px">
                {{ empty(session('sessionAY'))?'No active academic year':'S/Y '.session('sessionAY')->from.'-'.session('sessionAY')->to }}
            </p>

        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">OP</a>
            <p style="font-size: 11px;margin-top:-21px">
                @if (empty(session('sessionAY')))
                No active
                @else
                {{ Str::substr(session('sessionAY')->from, 2) }}-{{ Str::substr(session('sessionAY')->to, 2) }}
                @endif
            </p>
        </div>
        @if (Auth::guard('web')->check())
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ request()->is('admin/my/dashboard')?'active':'' }}"><a class="nav-link"
                    href="{{ route('admin.dashboard') }}"><i class="fas fa-cube"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Masterlist</li>
            <li class="{{ request()->is('admin/my/teacher')?'active':'' }}">
                <a class="nav-link" href="{{ route('admin.teacher') }}">
                    <i class="fas fa-users-cog"></i><span>Teacher</span></a>
            </li>
            <li class="{{ request()->is('admin/my/student')?'active':'' }}">
                <a class="nav-link" href="{{ route('admin.student') }}">
                    <i class="fas fa-users"></i><span>Student</span></a>
            </li>
            <li class="menu-header">Management</li>
            <li class="{{ request()->is('admin/my/section')?'active':'' }}">
                <a class="nav-link" href="{{ route('admin.section') }}">
                    <i class="fas fa-border-all"></i><span>Section</span></a>
            </li>
            <li class="{{ request()->is('admin/my/subject')?'active':'' }}">
                <a class="nav-link" href="{{ route('admin.subject') }}">
                    <i class="fas fa-book-reader"></i><span>Subject</span></a>
            </li>
            <li class="{{ request()->is('admin/my/schedule')?'active':'' }}">
                <a class="nav-link" href="{{ route('admin.schedule') }}">
                    <i class="fas fa-calendar-alt"></i><span>Schedule</span></a>
            </li>
            <li class="{{ request()->is('admin/my/profile')?'active':'' }}">
                <a class="nav-link" href="{{ route('admin.profile') }}">
                    <i class="fas fa-user-circle"></i><span>School Profile</span></a>
            </li>
            <li class="{{ request()->is('admin/my/academic-year')?'active':'' }}">
                <a class="nav-link" href="{{ route('admin.academicYear') }}">
                    <i class="fas fa-graduation-cap"></i><span>Academic Year</span></a>
            </li>
            <li class="menu-header">Settings</li>
            <li class="nav-item dropdown {{ request()->is('admin/my/school/profile')?'active':'' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-cog"></i><span>Settings</span></a>
                <ul class="dropdown-menu">
                    <li class="">
                        <a class="nav-link" href="">School Profile</a></li>
            </li>
        </ul>
        @elseif(Auth::guard('teacher')->check())
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ request()->is('admin/my/dashboard')?'active':'' }}"><a class="nav-link"
                    href="{{ route('admin.dashboard') }}"><i class="fas fa-cube"></i><span>Dashboard</span></a>
            </li>
        </ul>
        @elseif(Auth::guard('student')->check())
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ request()->is('admin/my/dashboard')?'active':'' }}"><a class="nav-link"
                    href="{{ route('admin.dashboard') }}"><i class="fas fa-cube"></i><span>Dashboard</span></a>
            </li>
            </li>
        </ul>
        @endif
    </aside>
</div>