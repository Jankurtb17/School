<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('css/addmodal.css')}}">
  <link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
  <title>Document</title>
</head>
<body>
  @include('Pages.sidebar')
        <div class="content">
          <div class="sidebar-content">
          </div>
          <div class="title">
            <h1>Students</h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"> <ion-icon name="speedometer" id="dashboard-icon"> </ion-icon> <a href="/dashboard">Dashboard </a></li>
                <li class="breadcrumb-item active" aria-current="page">Students</li>
              </ol>
            </nav>

            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalFade3">
                Add Student 
            </button>
            <div class="modal fade" id="modalFade3" tabindex = "-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Add Student</h5>
                    <button type="button" class="close" data-dismiss="modal"> &times; </button>
                  </div>  
                  @if($errors->all())
                      @foreach ($errors as $error)
                        <div class="alert alert-danger" role="alert">
                            </li>{{ $error }} </div>
                        </div>
                      @endforeach
                  @endif  
                  <div class="modal-body">
                    <form method="POST">
                       @csrf
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-4">
                              <label class="col-form-label" id="Title">Student information</label>
                            </div>
                            <div class="col-md-8"> </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-3"> 
                              <label class="col-form-label">Student </label>
                            </div>
                            <div class="col-md-5">
                              <input id ="studentNumber" type="text" class="form-control" placeholder="Student Number" name="studentNumbers">
                            </div>
                            <div class="col-md-4">
                                {{-- <input type="text" class="form-control" placeholder="Level" name="level"> --}}
                                <select name="gradeLevel" id="gradeLevel" class="form-control">
                                  <option value="" selected  disabled>-Select Grade-</option>
                                  @foreach ($yearlevel as $yearlevels)
                                      <option value="{{ $yearlevels->gradeLevel}}">Grade {{ $yearlevels->gradeLevel}} </option>
                                  @endforeach
                                </select>
                              </div>
                          </div>
                       </div>
                       <div class="form-group"> 
                          <div class="row">
                            <div class="col-md-3"> </div>
                            <div class="col-md-3">
                              <input type="text" class="form-control" placeholder="First Name" name="firstName">
                            </div>
                            <div class="col-md-4">
                              <input type="text" class="form-control" placeholder="Last Name" name="lastName">
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" placeholder="M.I" name="middleName">
                            </div>
                          </div>
                       </div>
                       
                       <div class="form-group"> 
                        <div class="row">
                          <div class="col-md-3"> </div>
                          <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Contact Number" name="contactNumber">
                          </div>
                        </div>
                     </div>
                       <div class="form-group">
                        <div class="row">
                          <div class="col-md-3">
                            <label class="col-form-label">Account </label>
                          </div>
                          <div class="col-md-9">
                              <input type="email" class="form-control" placeholder="Email" name="email">
                          </div>
                        </div>
                       </div>
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-3"> </div>
                            <div class="col-md-9">
                              <input type="password" class="form-control" placeholder="Password" name="password">
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                    <button type="submit" class="btn btn-primary" name="submit"> Submit </button>                    
                  </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="table-body">
              <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th>ID Number</th>
                    <th>Grade Level </th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($student as $students)
                    <tr>
                      <td>{{ $students->student_id}} </td>
                      <td>{{ $students->gradeLevel}} </td>
                      <td>{{ $students->firstName}} </td>
                      <td>{{ $students->lastName}} </td>
                      <td>
                      <a href="#" class="edit-modal btn btn-warning" data-target="#myModal" data-toggle="modal" data-id="{{ $students->student_id}}" data-level="{{ $students->gradeLevel }}" data-first="{{ $students->firstName }}" data-last="{{ $students->lastName }}" data-email="{{ $students->email }}" data-password="{{ $students->password }}"><i class="fa fa-pencil-square-o"> </i>Edit </a>
                      <a href="#" class="delete-modal btn btn-danger"><i class="fa fa-trash-o"> </i>Delete </a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <div id="myModal" class="modal">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="https://unpkg.com/ionicons@4.4.6/dist/ionicons.js"></script>
</body>
</html>