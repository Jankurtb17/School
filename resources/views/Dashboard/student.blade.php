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
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
  <title>Document</title>
</head>
<body>
  @include('Pages.sidebar')
        <div class="content">
          <div class="sidebar-content">
          </div>
          <div class="card" id="card-subjectgrade">
          <div class="card-body">
          <div class="title">
            <h1>Students</h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"> <i class="fa fa-tachometer" aria-hidden = "true" id="dashboard-icon"> </i> <a href="/dashboard">Dashboard </a></li>
                <li class="breadcrumb-item active" aria-current="page">Students</li>
              </ol>
            </nav>
            @if(session()->has('notif'))
              <div class="alert alert-success" role="alert">
                  <button type="button" data-dismiss="alert" class="close" aria-hidden="true">&times; </button>
                  <strong>Student </strong> {{session()->get('notif')}}
              </div>
            @endif
            @if(count($errors) > 0)
              <div class="alert alert-danger" role="alert">
                <button type="button" data-dismiss="alert" class="close" aria-hidden="true">&times; </button>
                @foreach ($errors->all() as $error)
                      <li> {{ $error }} </li>
                @endforeach
              </div>
            @endif
         
            <div class="modal fade" id="modalFade3" tabindex = "-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Add Student</h5>
                    <button type="button" class="close" data-dismiss="modal"> &times; </button>
                  </div>  
                 
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
                            <div class="col-md-9">
                              <input id ="studentNumber" type="text" class="form-control" placeholder="Student Number" name="student_id" required>
                            </div>
                          </div>
                        </div>
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-3">
                            </div>
                            <div class="col-md-5">
                                {{-- <input type="text" class="form-control" placeholder="Level" name="level"> --}}
                                <select name="gradeLevel" id="gradeLevel" class="form-control dynamic" data-dependent="className" required>
                                  <option value="" selected  disabled>-Select Grade-</option>
                                  <option value="kindergarten">kindergarten</option>
                                  <option value="1">Grade 1</option>
                                  <option value="2">Grade 2</option>
                                  <option value="3">Grade 3</option>
                                  <option value="4">Grade 4</option>
                                  <option value="5">Grade 5</option>
                                  <option value="6">Grade 6</option>
                                </select>
                              </div>
                            <div class="col-md-4">
                              <select name="className" id="className" class="form-control" required>
                                <option value="">-Select Class-</option>
                              </select>
                            </div>
                          </div>
                        </div>
                       <div class="form-group"> 
                          <div class="row">
                            <div class="col-md-3"> </div>
                            <div class="col-md-3">
                              <input type="text" class="form-control" placeholder="First Name" name="firstName" required>
                            </div>
                            <div class="col-md-4">
                              <input type="text" class="form-control" placeholder="Last Name" name="lastName" required>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" placeholder="M.I" name="middleName">
                            </div>
                          </div>
                       </div>
                       
                       <div class="form-group"> 
                        <div class="row">
                            <div class="col-md-3"> </div>
                            <div class="col-md-4">
                                <select name="gender" id="gender" class="form-control" required>
                                  <option value="" selected disabled>-Select Gender-</option>
                                  <option value="Male">Male</option>
                                  <option value="Female">Female</option>
                                </select>
                              </div>
                          <div class="col-md-5">
                            <input type="text" class="form-control" placeholder="Contact Number" name="phone_number" required>
                          </div>
                        </div>
                     </div>
                     <div class="form-group">
                       <div class="row">
                        <div class="col-md-3"> </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Address" name="Address">
                        </div>
                       </div>
                     </div> 
                       <div class="form-group">
                        <div class="row">
                          <div class="col-md-3">
                            <label class="col-form-label">Account </label>
                          </div>
                          <div class="col-md-9">
                              <input type="email" class="form-control" placeholder="Email" name="email" required>
                          </div>
                        </div>
                       </div>
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-3"> </div>
                            <div class="col-md-9">
                              <input type="password" class="form-control" placeholder="Password" name="password" required>
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit"> Submit </button>                    
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                  </form>
                  </div>
                </div>
              </div>
            </div>
 
              <div class="ui-form">
              <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalFade3">
                  <i class="fa fa-plus" aria-hidden="true"></i> Add Student 
              </button>
              </div>
              <div class="table-body">
              <table class="table table-hover" id="example">
                <thead>
                  <tr>
                    <th>ID Number</th>
                    <th>Grade Level </th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody class="table-bordered">
                  @foreach ($students as $student)
                    <tr>
                      <td> <a href="/student/{{ $student->student_id }}/{{ $student->gradeLevel}}">{{ $student->student_id}} </a> </td>
                      <td>{{ $student->gradeLevel}} </td>
                      <td>{{ $student->firstName}} </td>
                      <td>{{ $student->lastName}} </td>
                      <td>{{ $student->email}} </td>
                      <td></td>
                      <td>
                      <a href="#" class="edit-modal btn btn-warning" data-target="#myModal" data-toggle="modal" data-id="{{ $student->student_id}}" data-level="{{ $student->gradeLevel }}" data-first="{{ $student->firstName }}" data-last="{{ $student->lastName }}" data-email="{{ $student->email }}" data-password="{{ $student->password }}"><i class="fa fa-pencil-square-o"> </i>Edit </a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script>
    $(document).on('change', '.dynamic', function() {
      if($(this).val() != ''){
        select = $(this).attr('id');
        value = $(this).val();
        dependent = $(this).data('dependent');
        _token = $('input[name="_token"]').val();
          $.ajax({
                  url: "{{ route('dynamicdependent3.fetch') }}",
                  method: "POST",
                  data: {
                    select: select,
                    value: value,
                    _token: _token,
                    dependent:dependent
                  },
                  success:function(result)
                  {
                    $('#'+dependent).html(result);
                  }
              });
          }
    });
    $(document).ready(function() {
        $('#example').DataTable();
    });

    // $(document).on('keyup', '#search', function() {
    //   value = $(this).val();
    //   $.ajax({
    //       url: "{{ route('find.student')}}",
    //       type: "GET",
    //       data: {
    //         "_token": $('input[name=_token]').val(),
    //         "search": value
    //       },
    //       success:function(data) {
    //         $('tbody').html(data);
    //       }
    //   });
    // });
  
  </script>  
</body>
</html>