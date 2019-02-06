@extends('layouts.teacher')

@section('content')
@can('isAdmin')
        <div class="content">
          <div class="sidebar-content">
          </div>
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
               <i class="fa fa-check"> </i> <strong>Teacher </strong> {{session()->get('success')}}
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
                Add Teacher 
            </button>
            <a href="{{ route('export.teacher')}}" class="btn btn-success">  <i class="fa fa-file-excel-o" aria-hidden="true"> </i> Export</a>
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
                            <input type="text" class="form-control" placeholder="Contact Number"  name="contactNumber">
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
                          <label class="col-form-label">Account </label>
                        </div>
                        <div class="col-md-9">
                          <input type="email" class="form-control" placeholder="email" name="email">
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
          </div>
          <div class="table-wrapper-scroll-y">
          <table class="table table-hover" id="example">
            <thead>
              <tr>
                <th>Employee ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($user as $users)
                <tr class="post {{ $users->id }}">
                  <td><a href="/addteacher/{{$users->employee_id}}">{{ $users->employee_id }} </a></td>
                    <td>{{ $users->firstName }}</td>
                    <td>{{ $users->lastName }}</td>
                    <td>{{ $users->email}}</td>
                    <th><span class="badge badge-success">Active</span></th>
                    <td><a href="#" class="btn btn-warning" data-target="#modalFade" data-id="{{ $users->id }}" data-employee="{{ $users->employee_id}}"><i class="fa fa-pencil-square-o"> </i>EDIT </a></td>
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
@endsection
@section('scripts')
<script>
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
  $(document).ready(function() {
      student = $('#employee-id').val();
  });
</script>
@endSection
@endCan