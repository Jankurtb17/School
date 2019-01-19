<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('css/addmodal.css') }}">
  <link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
  <title>Document</title>
</head>
<body>
  @include('Pages.sidebar')
        <div class="content">
          <div class="sidebar-content">
          </div>
          <div class="title">
            <h1>Teachers </h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><ion-icon name="speedometer" id="dashboard-icon"> </ion-icon> <a href="/dashboard">Dashboard </a> </li>
                <li class="breadcrumb-item active" aria-current="page">Teachers</li>
              </ol>
            </nav>
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalFade5">
                Add Teacher 
            </button>
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
                            <input type="text" class="form-control" placeholder="Employee ID"  name="employee_Id">
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
          <div class="table-body">
          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>Employee ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($user as $users)
                <tr class="post {{ $users->id }}">
                  <td>{{ $users->employee_id }}</td>
                    <td>{{ $users->firstName }}</td>
                    <td>{{ $users->lastName }}</td>
                    <td>{{ $users->email}}</td>
                    <td>
                       <a href="#" class="edit-modal btn btn-warning" data-target="#myModal" data-toggle="modal" data-id="{{ $users->id }}" data-first="{{ $users->firstName }}" data-last="{{ $users->lastName }}" data-email="{{ $users->email }}" data-password="{{ $users->password }}"> <i class="fa fa-pencil-square-o"> Edit</i></a>
                       <a href="#" class="delete-modal btn btn-danger" data-target="#myModal" data-toggle="modal" data-id="{{ $users->id }}" data-first="{{ $users->firstName }}" data-last="{{ $users->lastName }}" data-email="{{ $users->email }}" data-password="{{ $users->password }}"><i class="fa fa-trash-o"> </i>Delete</a>
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
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="https://unpkg.com/ionicons@4.4.6/dist/ionicons.js"></script>
</body>
</html>