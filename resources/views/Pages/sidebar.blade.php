<div class="app-body">
    <div class="sidebar">
      <div class="sidebar-content">
          <nav class="sidebar-nav">
            <ul class="nav">
              <div class="main-content">
                Admin
              </div>
              <li class="nav-item current">
                  <a class="nav-link" href="/dashboard"> <ion-icon name="speedometer" id="icon-dashboard"></ion-icon> Dashboard </a>
              </li>
              <li class="nav-title"> Module </li>
              <li class="nav-item">
                  <a class="nav-link" href="/schoolyear"> <ion-icon name="calendar" id="icon-dashboard"></ion-icon>  School Year</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="/yearlevel"> <ion-icon name="calendar" id="icon-dashboard"></ion-icon>  Year Level</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="/student"> <ion-icon name="person" id="icon-dashboard"></ion-icon>  Student </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="/studentclass"> <ion-icon name="person" id="icon-dashboard"></ion-icon>  Student Class </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/teacher"> <ion-icon name="person" id="icon-dashboard"></ion-icon>  Teachers </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="/advisory"> <ion-icon name="person" id="icon-dashboard"></ion-icon>  Teachers Advisory </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/subject"> <ion-icon name="albums" id="icon-dashboard"></ion-icon>  Subject </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="/class"> <ion-icon name="albums" id="icon-dashboard"></ion-icon>  Class </a>
              </li>
              <li class="nav-title"> Settings </li>
              <li class="nav-item">
                <a class="nav-link" href="#"> <ion-icon name="settings" id="icon-dashboard"></ion-icon>  Account Settings </a>
              </li>
            </ul>
          </nav>
      </div>
    </div>

<div class="main">
  <div class="navbar-top">
      <ul class="navbar-nav">
        @if (isset(Auth::user()->name))
          <li>
            <a data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
              {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu">
            <a class="dropdown-item" href=" {{ url('/logout') }}">
                Logout
              </a>
            </div>
          </li>
        @else
          <script>
            window.location = '/login';
          </script>
        @endif
      </ul>
</div>