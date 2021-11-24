<ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
    <li class="{{ request()->is('teacher/my/dashboard')?'active':'' }}"><a class="nav-link"
            href="{{ route('teacher.dashboard') }}"><i class="fas fa-cube"></i><span>Dashboard</span></a>
    </li>
    <li class="{{ request()->is('teacher/my/profile')?'active':'' }}"><a class="nav-link"
            href="{{ route('teacher.profile') }}"><i class="fas fa-user"></i><span>My Profile</span></a>
    </li>
    @if (Auth::user()->section()->where('school_year_id', $activeAY->id)->exists())
    @if (Auth::user()->section()->where('school_year_id', $activeAY->id)->first()->grade_level<=10) 
    <li class="{{ request()->is('teacher/my/assign')?'active':'' }}">
        <li class="menu-header">Adviser Setting</li>
        <li class="{{ request()->is('teacher/my/class/monitor')?'active':'' }}">
            <a class="nav-link" href="{{ route('teacher.class.monitor') }}">
                <i class="fas fa-puzzle-piece"></i><span>
                    Class Monitor</span>
            </a>
        </li>
        <li class="{{ request()->is('teacher/my/assign')?'active':'' }}">
            <a class="nav-link" href="{{ route('teacher.class.assign') }}">
                <i class="fas fa-handshake"></i><span>
                    Assign Subject
                </span>
            </a>
        </li>
        @else
        <li class="menu-header">Adviser Setting</li>
        <li class="{{ request()->is('teacher/my/senior/class/monitor')?'active':'' }}">
            <a class="nav-link" href="{{ route('teacher.class.senior.monitor') }}">
                <i class="fas fa-puzzle-piece"></i><span>
                    Class Monitor</span>
            </a>
        </li>
        <li class="{{ request()->is('teacher/my/senior/assign')?'active':'' }}">
            <a class="nav-link" href="{{ route('teacher.class.senior.assign') }}">
                <i class="fas fa-handshake"></i><span>
                    Assign Subject
                </span>
            </a>
        </li>
    @endif
    @endif
        @if (Auth::user()->assign->count()>0 || Auth::user()->newassign->count()>0)

        <?php
         $countjhs=0;
         $countshs=0;
         ?>
        @foreach (Auth::user()->assign_info as $item)
        <?php ($item->grade_level<11)? $countjhs+=1: $countshs+=1; ?>
        @endforeach
        <li class="menu-header">Data Entry</li>
        <li
        class="nav-item dropdown {{ request()->is('teacher/my/grading') || request()->is('teacher/my/grading/shs') ?'active':'' }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-users"></i><span>Grading</span>
        </a>
        @if (Auth::user()->assign()->where('school_year_id',$activeAY->id)->exists())
            <ul class="dropdown-menu">
                @if ($countjhs!=0)
                <li class="{{ request()->is('teacher/my/grading')?'active':'' }}">
                    <a class="nav-link" href="{{ route('teacher.grading') }}">
                        <i class="fas fa-user-friends"></i><span>Junior High</span>
                    </a>
                </li>
                @endif
            </ul>
            @endif

            @php
               $countss= DB::table('newassigns')
               ->join('sections','newassigns.section_id','sections.id')
                ->where('newassigns.teacher_id',auth()->user()->id)
                ->where('sections.school_year_id',$activeAY->id)
                ->count();
            @endphp

            @if ($countss>0)
            <ul class="dropdown-menu">
                <li class="{{ request()->is('teacher/my/grading/shs')?'active':'' }}">
                    <a class="nav-link" href="{{ route('teacher.grading.shs') }}">
                        <i class="fas fa-user-clock"></i><span>Senior High</span>
                    </a>
                </li>
            </ul>
            @endif
        </li>
        {{-- <li class="{{ request()->is('teacher/my/grading')?'active':'' }}"><a class="nav-link"
            href="{{ route('teacher.grading') }}"><i class="fas fa-cube"></i><span>Grading</span></a>
        </li> --}}
        @endif

        @if (Auth::user()->chairman()->where('school_year_id', $activeAY->id)->exists())
        @if (Auth::user()->chairman_info->grade_level>=11) <li class="menu-header">Chairman Setting</li>
        <li class="{{ request()->is('teacher/my/senior/section')?'active':'' }}"><a class="nav-link"
                href="{{ route('teacher.senior.section') }}"><i class="fas fa-border-all"></i><span>Manage
                    Section</span></a>
        </li>
        <li class="{{ request()->is('teacher/my/senior/enrollee')?'active':'' }}"><a class="nav-link"
                href="{{ route('teacher.senior.enrollee.page') }}"><i class="fas fa-users"></i><span>Enroll
                    Student</span></a>
        </li>
        @else
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
        <li class="{{ request()->is('teacher/my/certificate')?'active':'' }}">
            <a class="nav-link" href="{{ route('teacher.certificate') }}">
                <i class="fas fa-certificate"></i><span>Certificate</span>
            </a>
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