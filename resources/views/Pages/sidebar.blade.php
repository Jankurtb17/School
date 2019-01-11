<div class="app-body">
    <div class="sidebar">
      <div class="sidebar-content">
          <nav class="sidebar-nav">
            <ul class="nav" id="menulist">
              <div class="main-content">
                @can('isAdmin')
                    Admin
                @endcan
                @can('isTeacher')
                    Teacher Dashboard
                @endcan
              </div>

              @can('isAdmin')
              <li class="nav-item">
                  <a class="nav-link {{ setActive('dashboard', 'current') }}" href="/dashboard"> <i class="fa fa-tachometer" aria-hidden="true" id="icon-dashboard"></i> Dashboard </a>
              </li>
              <li class="nav-title"> Module </li>
              <li class="nav-item">
                  <a class="nav-link {{ setActive('schoolyear', 'current') }}" href="/schoolyear"> <i class="fa fa-calendar" aria-hidden="true" id="icon-dashboard"></i> School Year</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ setActive('yearlevel', 'current') }}" href="/yearlevel"> <i class="fa fa-calendar" aria-hidden="true" id="icon-dashboard"></i> Year Level</a>
             </li>
              <li class="nav-item">
                  <a class="nav-link {{ setActive('examination', 'current') }}" href="/examination"> <i class="fa fa-calendar" aria-hidden="true" id="icon-dashboard"></i> Examination Date</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link {{ setActive('student', 'current') }}" href="/student"> <i class="fa fa-user" aria-hidden="true" id="icon-dashboard"></i> Student </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link {{ setActive('studentclass', 'current') }}" href="/studentclass"> <i class="fa fa-user" aria-hidden="true" id="icon-dashboard"></i> Student Class </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ setActive('teacher', 'current') }}" href="/addteacher"> <i class="fa fa-user" aria-hidden="true" id="icon-dashboard"></i> Teachers </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link {{ setActive('advisory', 'current') }}" href="/advisory"> <i class="fa fa-user" aria-hidden="true" id="icon-dashboard"></i> Teachers Advisory </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ setActive('subject', 'current') }}" href="/subject"> <i class="fa fa-book" aria-hidden="true" id="icon-dashboard"></i> Subject </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link {{ setActive('class', 'current') }}" href="/class"> <i class="fa fa-book" aria-hidden="true" id="icon-dashboard"></i> Class </a>
              </li>
              <li class="nav-title"> Settings </li>
              <li class="nav-item">
                <a class="nav-link" href="#"> <i class="fa fa-cog" aria-hidden="true" id="icon-dashboard"></i> Account Settings </a>
              </li>
              @endcan

              @can('isTeacher')
              <li class="nav-item">
                <a class="nav-link {{ setActive('subject', 'current' )}}" href="/subjectload"> <i class="fa fa-book" aria-hidden="true" id="icon-dashboard"> </i> Subject Module </a>
              </li>
              <li class="nav-title"> Settings </li>
              <li class="nav-item">
                <a class="nav-link" href="#"> <i class="fa fa-cog" aria-hidden="true" id="icon-dashboard"></i> Account Settings </a>
              </li>
              @endCan
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
          <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
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