<ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="{{ request()->is('student/my/dashboard')?'active':'' }}"><a class="nav-link"
                        href="{{ route('student.dashboard') }}"><i class="fas fa-cube"></i><span>Dashboard</span></a>
        </li>
        <li class="menu-header">Information</li>
        <li class="{{ request()->is('student/my/profile')?'active':'' }}"><a class="nav-link"
                        href="{{ route('student.profile') }}"><i class="fas fa-user-circle"></i><span>Profile</span></a>
        </li>
        @if (Auth::user()->completer==="No")
        <li class="{{ request()->is('student/my/grade')?'active':'' }}">
                <a class="nav-link" href="{{ route('student.grade') }}">
                        <i class="fas fa-book-reader"></i><span>Grade</span>
                </a>
        </li>
        @else
        <li class="{{ request()->is('student/my/grade')?'active':'' }}">
                <a class="nav-link" href="{{ route('student.shs.grade') }}">
                        <i class="fas fa-book-reader"></i><span>Grade</span>
                </a>
        </li>
        @endif
        @if (Auth::user()->grade()->where('avg','<','75')->whereNull('remarks')->exists())
        <li class="{{ request()->is('student/my/backsubject')?'active':'' }}"><a class="nav-link"
                        href="{{ route('student.backsubject') }}"><i class="fas fa-reply-all"></i><span>Back
                                Subject
                                @if(Auth::user()->grade()->where('avg','<','75')->whereNull('remarks')->get()->count()!=0)
                                <small class="badge badge-danger badge-sm" style="font-size: 10px">
                                        {{ Auth::user()->grade()->where('avg','<','75')->whereNull('remarks')->get()->count() }}
                                </small>
                                @endif
                        </span>
                </a>
        </li>
        @endif
        @if (Auth::user()->completer==="No") <li class="{{ request()->is('student/my/enrollment')?'active':'' }}"><a
                        class="nav-link" href="{{ route('student.enrollment') }}"><i
                                class="fas fa-box-tissue"></i><span>Enrollment</span></a>
        </li>
        @else
        <li class="{{ request()->is('student/my/enrollment')?'active':'' }}"><a class="nav-link"
                        href="{{ route('student.shs.enrollment') }}"><i
                                class="fas fa-box-tissue"></i><span>Enrollment</span></a>
        </li>
        @endif

        <li class="menu-header">Report</li>
        <li class="{{ request()->is('student/my/report')?'active':'' }}"><a class="nav-link"
                        href="{{ route('student.report') }}"><i class="fas fa-bug"></i><span>Report</span></a>
        </li>
        <li><a class="nav-link" href="{{ route('auth.logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                class="fas fa-sign-out-alt text-danger"></i><span class="text-danger">Logout</span></a>
                <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" class="d-none">
                        @csrf
                </form>
        </li>
</ul>