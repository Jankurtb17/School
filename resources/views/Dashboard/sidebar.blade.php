<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dashboard2.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
  <title>Document</title>
</head>
<body>
    <div class="app-body">
      <div id="sidebar">
        <div class="toggle-btn" onclick="toggleSidebar()">
          <i class="fa fa-bars" aria-hidden="true" id="btnClose"></i>
        </div>

        <nav>
          <div class="sidebar-header">
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
          <ul>
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
                  <a class="nav-link {{ setActive('student', 'current') }}" href="/student"> <i class="fa fa-user" aria-hidden="true" id="icon-dashboard"></i> Student </a>
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
              <li class="nav-item">
                  <a class="nav-link {{ setActive('class', 'current') }}" href="/class"> <i class="fa fa-book" aria-hidden="true" id="icon-dashboard"></i> Class Section
                    <ul>
                        <li> asd</li>
                    </ul>
                  </a>
              </li>

              <div class="dropdown">
                  <a class="nav-link" href="#">  <i class="fa fa-book" aria-hidden="true" id="icon-dashboard"></i> Class Section <span class="caret"></span> </a>
                  
                    <ul class="dropdown-menu">
                      <li><a href="#">HTML</a></li>
                      <li><a href="#">CSS</a></li>
                      <li><a href="#">JavaScript</a></li>
                    </ul>
              </div>
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
              <li class="nav-item">
                <a class="nav-link {{ setActive('subjectgrade', 'current' )}}" href="/subjectgrade"> <i class="fa fa-book" aria-hidden="true" id="icon-dashboard"> </i> Subject Grade </a>
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
                <a class="nav-link {{ setActive('balance', 'current' )}}" href="/balance"> <i class="fa fa-book" aria-hidden="true" id="icon-dashboard"> </i> Balance Fees </a>
              </li>
              <li class="nav-title"> Settings </li>
              <li class="nav-item">
                <a class="nav-link" href="#"> <i class="fa fa-cog" aria-hidden="true" id="icon-dashboard"></i> Account Settings </a>
              </li>
              @endcan
          </ul>
        </nav>
      </div>  
     
        <div class="navbar-top" id="navtop">
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

    <div class="row">
        <div class="card">
          <div class="card-body">
                <table id="example" class="table table-hover">
                    <thead>
                      <tr>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>email</th>
                      </tr>
                    </thead>
                    <tbody>
                     @foreach ($user as $users)
                         <tr>
                           <td>{{$users->firstName}}</td>
                           <td>{{$users->lastName}}</td>
                           <td>{{$users->middleName}}</td>
                           <td>{{$users->email}}</td>
                         </tr>
                     @endforeach
                    </tbody>
                </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
  function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('active');
  }
 
</script>
</body>
</html>
