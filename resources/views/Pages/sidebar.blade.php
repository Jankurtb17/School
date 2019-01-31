<div class="app-body">
    <div class="sidebar">
      <div class="sidebar-content">
          <nav class="sidebar-nav">
            <ul class="nav" id="menulist">
              <div class="main-content">
                @can('isAdmin')
                <div class="sidebar-image">
                    <img src="{{ url('image/admin.png')}}" class="logo-admin">
                </div>

                @endcan
                @can('isTeacher')
                <div class="sidebar-image">
                    <img src="{{ url('image/teacher.png')}}" class="logo-admin">
                </div>
                @endcan
                @can('isStudent')
                <div class="sidebar-image">
                    <img src="{{ url('image/student.png')}}" class="logo-admin">
                </div>
                @endcan
              </div>

              @can('isAdmin')
              <li class="nav-item">
                  <a id="dashboard-icon1" class="nav-link {{ setActive('dashboard', 'current') }}" href="/dashboard"> <i class="fa fa-tachometer" aria-hidden="true" id="icon-dashboard"></i> Dashboard </a>
              </li>
              <li class="nav-title"> Main Module </li>
              <li class="nav-item">
                  <a class="nav-link {{ setActive('schoolyear', 'current') }}" href="/schoolyear"> <i class="fa fa-calendar" aria-hidden="true" id="icon-dashboard"></i> School Year</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ setActive('gradelevel', 'current') }}" href="/gradelevel"> <i class="fa fa-calendar" aria-hidden="true" id="icon-dashboard"></i> Grade Level</a>
             </li>
              <li class="nav-item">
                  <a class="nav-link {{ setActive('examination', 'current') }}" href="/examination"> <i class="fa fa-calendar" aria-hidden="true" id="icon-dashboard"></i> Examination Date</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link {{ setActive('student', 'current') }}" href="/student"> <i class="fa fa-user" aria-hidden="true" id="icon-dashboard"></i> Students </a>
              </li>
            
              <li class="nav-item">
                  <a class="nav-link {{ setActive('studentgrades', 'current') }}" href="/studentgrades"> <i class="fa fa-user" aria-hidden="true" id="icon-dashboard"></i> Student Grades </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ setActive('addteacher', 'current') }}" href="/addteacher"> <i class="fa fa-user" aria-hidden="true" id="icon-dashboard"></i> Teachers </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link {{ setActive('advisory', 'current') }}" href="/advisory"> <i class="fa fa-user" aria-hidden="true" id="icon-dashboard"></i> Teachers Advisory </a>
              </li>
              {{-- <li class="nav-item">
                  <a class="nav-link {{ setActive('class', 'current') }}" href="/class"> <i class="fa fa-book" aria-hidden="true" id="icon-dashboard"></i> Class Section</a>
              </li> --}}
              <li class="nav-item">
                <a class="nav-link {{ setActive('subject', 'current') }}" href="/subject"> <i class="fa fa-book" aria-hidden="true" id="icon-dashboard"></i> Subject </a>
              </li>
              <li class="nav-title"> Settings </li>
              <li class="nav-item">
                <a class="nav-link" href="/settings"> <i class="fa fa-cog" aria-hidden="true" id="icon-dashboard"></i> Account Settings </a>
              </li>
              @endcan

              @can('isTeacher')
              <li class="nav-title"> Main Navigation </li>
              <li class="nav-item">
                <a class="nav-link {{ setActive('subjectload', 'current' )}}" href="/subjectload"> <i class="fa fa-book" aria-hidden="true" id="icon-dashboard"> </i> Subject Module </a>
                <ul>
                  <li class="nav-item"> <a class="nav-link" href="#">Example</a></li>
                </ul>
              </li>
              {{-- <li class="nav-item">
                <a class="nav-link {{ setActive('subjectgrade', 'current' )}}" href="/subjectgrade"> <i class="fa fa-book" aria-hidden="true" id="icon-dashboard"> </i> Subject Grade </a>
              </li> --}}
             
              <li class="nav-item">
                <a class="nav-link {{ setActive('viewgrades', 'current' )}}" href="/viewgrades"> <i class="fa fa-book" aria-hidden="true" id="icon-dashboard"> </i> View Student Grades </a>
              </li>
              
              <li class="nav-title"> Settings </li>
              <li class="nav-item">
                <a class="nav-link {{ setActive('settings', 'current')}}" href="/settings"> <i class="fa fa-cog" aria-hidden="true" id="icon-dashboard"></i> Account Settings </a>
              </li>
              @endcan

              @can('isStudent')
              <li class="nav-item">
                <a class="nav-link {{ setActive('listsubject', 'current' )}}" href="/listsubject"> <i class="fa fa-book" aria-hidden="true" id="icon-dashboard"> </i> List of subject </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ setActive('grades', 'current' )}}" href="/grades"> <i class="fa fa-book" aria-hidden="true" id="icon-dashboard"> </i> Grades </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ setActive('balance', 'current' )}}" href="/balance"> <i class="fa fa-money" aria-hidden="true" id="icon-dashboard"> </i> Balance Fees </a>
              </li>
              <li class="nav-title"> Settings </li>
              <li class="nav-item">
                <a class="nav-link {{ setActive('settings', 'current' )}}" href="/settings"> <i class="fa fa-cog" aria-hidden="true" id="icon-dashboard"></i> Account Settings </a>
              </li>
              @endcan
            </ul>
          </nav>
      </div>
    </div>

<div class="main">
  <div class="navbar-top">
    <ul class="navbar-nav">
      @if (isset(Auth::user()->firstName))
        <li>
          <a data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
            {{ Auth::user()->firstName }}
          </a>
          <div class="dropdown-menu" id="dropdown">
           
            <a class="dropdown-item"  href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
              <i class="fa fa-sign-out" aria-hidden="true"></i> {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
      @else
          <li class="nav-item">
            <a class="nav-link" href="{{ asset('login') }}"> {{ __('Login') }} </a>
          </li>
      @endif
    </ul>
</div>