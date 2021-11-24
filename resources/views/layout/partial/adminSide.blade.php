<ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
    <li class="{{ request()->is('admin/my/dashboard')?'active':'' }}"><a class="nav-link"
            href="{{ route('admin.dashboard') }}"><i class="fas fa-cube"></i><span>Dashboard</span></a>
    </li>
    <li class="{{ request()->is('admin/my/announcement')?'active':'' }}"><a class="nav-link"
        href="{{ route('admin.announcement') }}"><i class="fas fa-bell"></i><span>Announcement</span></a>
    </li>
    <li class="menu-header">Appointment</li>
    <li class="{{ request()->is('admin/my/appointment')?'active':'' }}">
        <a class="nav-link" href="{{ route('admin.appointment') }}">
            <i class="fas fa-calendar-check"></i><span>Appointment</span></a>
    </li>
    <li class="menu-header">Enrollment</li>
    <li class="{{ request()->is('admin/my/enrollment')?'active':'' }}">
        <a class="nav-link" href="{{ route('admin.enrollment') }}">
            <i class="fas fa-users"></i><span>Enrollee</span></a>
    </li>
    <li class="menu-header">Masterlist</li>
    <li
        class="nav-item dropdown {{ request()->is('admin/my/teacher') ||  request()->is('admin/my/student') ||  request()->is('admin/my/archive') ||  request()->is('admin/my/backrecord')?'active':'' }}">
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
            <li class="{{ request()->is('admin/my/archive')?'active':'' }}">
                <a class="nav-link" href="{{ route('admin.archive') }}">
                    <i class="fas fa-user-times"></i><span>Archive</span></a>
            </li>
            <li class="{{ request()->is('admin/my/backrecord')?'active':'' }}">
                <a class="nav-link" href="{{ route('admin.backrecord') }}">
                    <i class="fas fa-reply-all"></i><span>Back Subject</span></a>
            </li>
        </ul>
    </li>

    <li class="menu-header">Management</li>

    <li class="{{ request()->is('admin/my/chairman')?'active':'' }}">
        <a class="nav-link" href="{{ route('admin.chairman') }}">
            <i class="fas fa-user-shield"></i><span>Chairman</span></a>
    </li>
    {{-- <li class="{{ request()->is('admin/my/schedule')?'active':'' }}">
    <a class="nav-link" href="{{ route('admin.schedule') }}">
        <i class="fas fa-calendar-alt"></i><span>Schedule</span></a>
    </li> --}}
    <li class="{{ request()->is('admin/my/subject')?'active':'' }}">
        <a class="nav-link" href="{{ route('admin.subject') }}">
            <i class="fas fa-book-reader"></i><span>Subject</span></a>
    </li>
    <li class="{{ request()->is('admin/my/assign')?'active':'' }}">
        <a class="nav-link" href="{{ route('admin.assign') }}">
            <i class="fas fa-hands-helping"></i><span>Assign</span></a>
    </li>
    <li class="{{ request()->is('admin/my/section')?'active':'' }}">
        <a class="nav-link" href="{{ route('admin.section') }}">
            <i class="fas fa-border-all"></i><span>Section</span></a>
    </li>
    <li class="{{ request()->is('admin/my/strand')?'active':'' }}">
        <a class="nav-link" href="{{ route('admin.strand') }}">
            <i class="fas fa-dna"></i><span>Strand &amp; Track</span></a>
    </li>
    <li class="menu-header">Settings</li>
    <li
        class="nav-item dropdown {{ request()->is('admin/my/profile') || request()->is('admin/my/academic-year') || request()->is('admin/my/user')?'active':''  }}">
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
            <li class="{{ request()->is('admin/my/user')?'active':'' }}">
                <a class="nav-link" href="{{ route('admin.user') }}">
                    <i class="fas fa-users"></i><span>Manage Users</span></a>
            </li>
        </ul>
    </li>
    <li>
        <a class="nav-link" href="{{ route('auth.logout') }}"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                    class="fas fa-sign-out-alt text-danger"></i><span class="text-danger">Logout</span></a>
    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" class="d-none">
            @csrf
    </form>
    </li>
</ul>