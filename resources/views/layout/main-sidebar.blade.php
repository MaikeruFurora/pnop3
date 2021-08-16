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
            <li class="menu-header">Enrollment</li>
            <li class="{{ request()->is('admin/my/enrollment')?'active':'' }}">
                <a class="nav-link" href="{{ route('admin.enrollment') }}">
                    <i class="fas fa-users"></i><span>Enrollee</span></a>
            </li>
            <li class="menu-header">Masterlist</li>
            <li
                class="nav-item dropdown {{ request()->is('admin/my/teacher') ||  request()->is('admin/my/student')?'active':'' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-cog"></i><span>Masterlist</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->is('admin/my/teacher')?'active':'' }}">
                        <a class="nav-link" href="{{ route('admin.teacher') }}">
                            <i class="fas fa-users-cog"></i><span>Teacher</span></a>
                    </li>
                    <li class="{{ request()->is('admin/my/student')?'active':'' }}">
                        <a class="nav-link" href="{{ route('admin.student') }}">
                            <i class="fas fa-users"></i><span>Student</span></a>
                    </li>
                </ul>
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
            {{-- <li class="{{ request()->is('admin/my/schedule')?'active':'' }}">
            <a class="nav-link" href="{{ route('admin.schedule') }}">
                <i class="fas fa-calendar-alt"></i><span>Schedule</span></a>
            </li> --}}
            <li class="{{ request()->is('admin/my/assign')?'active':'' }}">
                <a class="nav-link" href="{{ route('admin.assign') }}">
                    <i class="fas fa-hands-helping"></i><span>Assign</span></a>
            </li>
            <li class="{{ request()->is('admin/my/chairman')?'active':'' }}">
                <a class="nav-link" href="{{ route('admin.chairman') }}">
                    <i class="fas fa-user"></i><span>Chairman</span></a>
            </li>

            <li class="menu-header">Settings</li>
            <li
                class="nav-item dropdown {{ request()->is('admin/my/profile') || request()->is('admin/my/academic-year')?'active':'' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-cog"></i><span>Settings</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->is('admin/my/profile')?'active':'' }}">
                        <a class="nav-link" href="{{ route('admin.profile') }}">
                            <i class="fas fa-user-circle"></i><span>School Profile</span></a>
                    </li>
                    <li class="{{ request()->is('admin/my/academic-year')?'active':'' }}">
                        <a class="nav-link" href="{{ route('admin.academicYear') }}">
                            <i class="fas fa-graduation-cap"></i><span>Academic Year</span></a>
                    </li>
                </ul>
            </li>
        </ul>
        @elseif(Auth::guard('teacher')->check())
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ request()->is('teacher/my/dashboard')?'active':'' }}"><a class="nav-link"
                    href="{{ route('teacher.dashboard') }}"><i class="fas fa-cube"></i><span>Dashboard</span></a>
            </li>
            @if ( Auth::user()->chairman()->where('school_year_id', session('sessionAY')->id)->exists())
            <li class="menu-header">Chairman Setting</li>

            <li class="{{ request()->is('teacher/my/section')?'active':'' }}">
                <a class="nav-link" href="{{ route('teacher.section') }}">
                    <i class="fas fa-border-all"></i><span>Manage Section</span>
                </a>
            </li>

            <li
                class="nav-item dropdown {{ request()->is('teacher/my/stem') || request()->is('teacher/my/bec')?'active':'' }}">
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
                    <li class="{{ request()->is('teacher/my/enroll')?'active':'' }}">
                        <a class="nav-link" href="{{ route('teacher.stem') }}">
                            <i class="fas fa-palette"></i><span>SP Art</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('teacher/my/enroll')?'active':'' }}">
                        <a class="nav-link" href="{{ route('teacher.stem') }}">
                            <i class="fas fa-file-signature"></i><span>SP Journalism</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
        @elseif(Auth::guard('student')->check())
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ request()->is('student/my/dashboard')?'active':'' }}"><a class="nav-link"
                    href="{{ route('student.dashboard') }}"><i class="fas fa-cube"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Information</li>
            <li class="{{ request()->is('student/my/profile')?'active':'' }}"><a class="nav-link"
                    href="{{ route('student.profile',Auth::guard('student')->user()->id) }}"><i
                        class="fas fa-user-circle"></i><span>Profile</span></a>
            </li>
            <li class="{{ request()->is('student/my/grade')?'active':'' }}"><a class="nav-link"
                    href="{{ route('student.grade',Auth::guard('student')->user()->id) }}"><i
                        class="fas fa-book-reader"></i><span>Grade</span></a>
            </li>
            </li>
        </ul>
        @endif
    </aside>
</div>
{{-- #2B58A5 --}}