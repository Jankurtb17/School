@extends('layouts.teacher')

@section('content')
        <div class="content">
          <div class="row">
          <div class="col-lg-12 col-sm-12">
          <div class="card" id="card-subjectgrade">
           <div class="card-body">
          <div class="title">
            <h1>Teachers </h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-tachometer" aria-hidden="true" id="dashboard-icon"> </i> <a href="/dashboard">Dashboard </a> </li>
                <li class="breadcrumb-item active" aria-current="page">Teachers</li>
              </ol>
            </nav>
            @if(session()->has('success'))
              <div class="alert alert-success" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <i class="fa fa-check" aria-hidden="true"> </i> <strong>Teacher </strong> {{session()->get('success')}}
              </div>
            
            @endif  

            @if(count($errors) > 0)
              <div class="alert alert-danger" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  @foreach ($errors->all() as $error)
                  <li> {{ $error }} </li>
                  @endforeach
              </div>
            @endif
            <div class="form-group">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFade5">
                <i class="fa fa-plus" aria-hidden="true"> </i> ADD TEACHER
            </button>
            <a href="{{ route('teacher.pdf')}}" class="btn btn-success">  <i class="fa fa-print" aria-hidden="true"> </i> Export</a>
            </div>

            <div class="modal fade" id="modalFade5" tabindex = "-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Add Teacher</h5>
                    <button type="button" class="close" data-dismiss="modal"> &times; </button>
                  </div>  
                  <div class="modal-body">
                    <form method="POST">
                       @csrf
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-4">
                            <label class="col-form-label" id="Title">Teacher information</label>
                          </div>
                          <div class="col-md-8"> </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-3"> 
                            <label class="col-form-label">Teacher </label>
                          </div>
                          <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Employee ID" value="19-1000-100" name="employee_Id" id="employee-id">
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
                          <div class="col-md-3"> 
                            <label class="col-form-label"> </label>
                          </div>
                          <div class="col-md-5">
                               {{-- <input placeholder="Selected date" type="text" id="date-picker-example" class="form-control datepicker">> --}}
                               {{-- <div class="input-group date" data-provide="datepicker">
                                  <input type="text" class="form-control">
                                  <div class="input-group-addon">
                                      <span class="glyphicon glyphicon-th"></span>
                                  </div>
                              </div> --}}
                              <input type="date" class="form-control" name="dateOfBirth">
                          </div> 
                          <div class="col-md-4">
                            <select name="gender" id="gender" class="form-control">
                              <option value="" selected disabled>-Select Gender- </option>
                                  <option value="Male">Male</option>
                                  <option value="Female">Female</option>
                              </option>
                            </select>
                          </div> 
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3"> 
                                <label class="col-form-label"> </label>
                            </div>
                            <div class="col-md-9">
                                <div class="input-group input-group-md">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                         +63 <input type="hidden" value="63" name="phone_numberone">
                                        </div>
                                  </div>
                                <input type="text" class="form-control" placeholder="Contact Number"  name="phone_number" onkeypress="isNumber(event)" maxlength="10">
                                </div>
                            </div> 
                        </div>
                    </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-3"> 
                            <label class="col-form-label"> </label>
                          </div>
                          <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Address"  name="address">
                          </div> 
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                           <div class="col-md-3">
                              <label for="col-form-label">Emergency</label>
                           </div>
                           <div class="col-md-3">
                            <input type="text" name="parentFirstName" id="parentFirstName" class="form-control" placeholder=" First Name">
                           </div>
                           <div class="col-md-4">
                              <input type="text" name="parentLastName" id="parentLastName"  class="form-control" placeholder="Last Name ">
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="parentMiddleName" id="parentMiddleName"  class="form-control" placeholder="Middle Name" >
                            </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-3">
                          </div>
                          <div class="col-lg-9">
                              <div class="input-group input-group-md">
                                  <div class="input-group-prepend">
                                      <div class="input-group-text">
                                       +63 <input type="hidden" value="63" name="phone_one" id="">
                                      </div>
                                </div>
                              <input type="text" name="phone_numbertwo" id="phone_number" class="form-control" placeholder="Emergency Contact Number" onkeypress="isNumber(event)" maxlength="10">
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
                          <input type="email" class="form-control" placeholder="Email" name="email">
                        </div>
                      </div>
                      </div>
                    <div class="form-group">
                      <div class="row">
                          <div class="col-md-3"> </div>
                          <div class="col-md-9">
                            <input type="password" class="form-control" placeholder="Confirm Password" name="password">
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3"> </div>
                            <div class="col-md-9">
                              <input type="password" class="form-control" placeholder="Password" name="password_confirmation">
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
          </div>
          <div class="table-wrapper-scroll-y">
          <table class="table table-hover" id="example">
            <thead>
              <tr>
                <th>Employee ID</th>
                <th>Gender</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($user_teacher as $users)
                <tr class="post {{ $users->id }}">
                  <td>{{ $users->employee_id }}</td>
                    <td>{{ $users->gender}}</td>
                    <td>{{ $users->firstName }}</td>
                    <td>{{ $users->lastName }}</td>
                    <td>{{ $users->email}}</td>
                    <th><span class="badge {{ $users->status == 'Active' ? 'badge-success' : 'badge-danger'}}">{{ $users->status}}</span></th>
                    <td><a href="#" class="edit-modal btn btn-warning" data-target="#myModal" data-toggle="modal" data-id="{{ $users->id }}" data-employee="{{ $users->employee_id}}" data-name="{{ $users->firstName }} {{ $users->middleName }} {{ $users->lastName }}" data-status="{{ $users->status }}"><i class="fa fa-pencil-square-o"> </i>EDIT </a>
                        <a href="/viewteacher/{{$users->employee_id}}" class="btn btn-success"> <i class="fa fa-print" aria-hidden="true"></i> EXPORT GRADE </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
          
          {{-- Edit Modal --}}
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Teacher</h5>
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <form id="teacher-status">
                      @csrf
                      <input type="hidden" id="id">
                      <div class="form-group">
                      <label for="Status">Employee ID</label>
                      <input type="text" class="form-control" id="employee_id" readonly>
                    </div>
                    <div class="form-group">
                      <label for="Status">Name</label>
                      <input type="text" class="form-control" id="name" readonly>
                    </div>
                    <div class="form-group">
                      <label for="Status">Status</label>
                      <select name="status" id="status" class="form-control">
                        <option value="" selected disabled>-Select Status-</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                      </select>
                    </div>
                  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark actionBtn" data-dismiss="modal">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

          </div>
          </div>
          </div>
        </div>
        </div>
        </div>
        {{-- end row --}}
                
      </div>
    </div>
  </div>
  </div>
@endsection
@section('scripts')
<script>
  function isNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if(!/^[0-9.\b]+$/.test(ch)) {
      evt.preventDefault();
    }
  }
  $(document).on('keypress', '#phone_number', function(evt) {
        console.log('asd');
  });

  $(document).ready(function() {
      $('#example').DataTable();
  });
  $(document).on('keyup', '#search', function() {
    value = $(this).val();
    $.ajax({
      url: "{{ route('find.teacher')}}",
      type: "GET",
      data: {
        "search": value,
        "_token": $('input[name_token]').val()
      },
      success:function(data) {
        $('tbody').html(data);
      }
    });
  });
 
 $(document).on('click', '.edit-modal', function() {
  $('#id').val($(this).data('id'));
  $('#employee_id').val($(this).data('employee'));
  $('#name').val($(this).data('name'));
  $('#status').val($(this).data('status'));
  id = $('#id').val();
 });

 $(document).on('click', '.actionBtn', function() {
  $.ajax({
      url: "/addteacher/"+id,
      type: "PUT",
      data: {
        "_token": $('input[name=_token]').val(),
        "id": $('#employee_id').val(),
        "status": $('#status').val()
      },
      success:function(data)
      {
        $(document).ajaxStop(function(){
                  setTimeout("window.location = '/addteacher'",100);
          });
      }
  });
 });
</script>
@endSection