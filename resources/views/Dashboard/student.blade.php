@extends('layouts.teacher')
@section('content')
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
                  <i class="fa fa-check" aria-hidden="true"></i>  <strong>Student </strong> {{session()->get('notif')}}
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
                            {{-- <div class="col-md-9">
                              <input id ="studentNumber" type="text" class="form-control" placeholder="Student Number" name="student_id" required>
                            </div> --}}
                            <div class="col-md-2">
                              <input type="text" name="studone" class="form-control" value="LRN" readonly style="text-align:center;">
                            </div>
                            <div class="col-md-4">
                              <input type="text" name="studtwo" class="form-control" style="text-align:center;"> 
                            </div>
                            <div class="col-md-3">
                              <input type="text" name="studthree" class="form-control" style="text-align:center;"> 
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
                            <input type="date" id="dateOfBirth" name="dateOfBirth" id="dateOfBirth" min="1920-12-30" max="3000-12-30" class="form-control">
                          </div>
                        </div>
                     </div>
                     <div class="form-group">
                       <div class="row">
                        <div class="col-md-3"> </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Address" name="address">
                        </div>
                       </div>
                     </div> 

                     <div class="form-group">
                      <div class="row">
                        <div class="col-md-3">
                          <div class="col-form-label">Parent  </div>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="parentFirstName" id="parentFirstName" class="form-control" placeholder="First name">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="parentLastName" id="parentLastName" class="form-control" placeholder="Last name">
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="parentMiddleName" id="parentMiddleName" class="form-control" placeholder="Middle Initial">
                        </div>
                      </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-3"> </div>
                          <div class="col-md-9">
                              <div class="input-group input-group-md">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                      +63 <input type="hidden" value="63" name="phone_one">
                                  </div>
                                 </div>
                               <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Contact number">
                              </div>
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
 
             <div class="form-group">
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFade3">
                   <i class="fa fa-plus" aria-hidden="true"></i> ADD STUDENT
               </button>
               <a href="{{ route('export.pdf')}}" class="btn btn-success"> <i class="fa fa-print" aria-hidden="true"></i> Export</a>
             </div>
              <div class="table-wrapper-scroll-y">
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
                <tbody>
                  @foreach ($user_student as $user_students)
                    <tr class="post{{$user_students->id}}">
                      <td> <a href="/student/{{ $user_students->student_id }}/{{ $user_students->gradeLevel}}">{{ $user_students->student_id}} </a> </td>
                      <td id="#gradeLevel">{{ $user_students->gradeLevel}} {{ $user_students->className}}</td>
                      <td>{{ $user_students->firstName}} </td>
                      <td>{{ $user_students->lastName}} </td>
                      <td>{{ $user_students->email}} </td>
                      <td class="post" id="status"><span class="badge {{ $user_students->status == 'Active' ? 'btn-success' : 'btn-danger'}}">{{$user_students->status}}</span></td>
                      <td>
                        <a href="#" class="btn btn-dark"> <i class="fa fa-print" aria-hidden="true"></i> PRINT GRADE</a>
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
  @endSection
  @section('scripts')
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
    $(document).on('click', '.edit-modal', function() {
       $(".dynamic2").val($(this).data('gradelevel'));
        $('#c').val($(this).data('fuck'));  
        $('#className').val($(this).data('classname'));
        $('#id').val($(this).data("id"));
        id = $('#id').val();
    });

    $('.modal-footer').on('click', '.actionBtn', function() {
        $.ajax( {
            type: "PUT",
            url: "student/" +id,
            data: {
              "id": id,
              "schoolYear": $('#schoolYear').val(),
              "gradeLevel": $('.dynamic2').val(),
              "status": $('#c').val(),
              "className": $('#d').val(),
              "_token": $('input[name=_token]').val()
            },
            success:function(data){
              $(document).ajaxStop(function(){
                  setTimeout("window.location = '/student'",100);
                });
            }
        })
    });


    $(document).on('change', '.dynamic2', function() {
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
                    $('#'+dependent).val(result);
                  }
              });
          }
    });

    function isNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if(!/^[0-9.\b]+$/.test(ch)) {
      evt.preventDefault();
    }
  }
  
  </script>
@endSection