<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
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
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalFade">
                Add Teacher 
            </button>
            <div class="modal fade" id="modalFade" tabindex = "-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Add Teacher</h5>
                    <button type="button" class="close" data-dismiss="modal"> &times; </button>
                  </div>  
                  <div class="modal-body">
                    <form action="" method="POST">
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
                          <div class="col-md-4"> 
                            <label class="col-form-label">Student </label>
                          </div>
                          <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="Employee ID"  name="studId">
                          </div>
                       
                        </div>
                      </div>
                      <div class="form-group"> 
                        <div class="row">
                          <div class="col-md-4"> </div>
                          <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="First Name">
                          </div>
                          <div class="col-md-4">
                              <input type="text" class="form-control" placeholder="Last Name">
                            </div>
                        </div>
                      </div>
                      <div class="form-group"> 
                        <div class="row">
                          <div class="col-md-4"> </div>
                          <div class="col-md-8">
                            <input type="email" class="form-control" placeholder="Email">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="col-form-label">Account </label>
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" placeholder="Username">
                        </div>
                      </div>
                      </div>
                    <div class="form-group">
                      <div class="row">
                          <div class="col-md-4"> </div>
                          <div class="col-md-8">
                            <input type="password" class="form-control" placeholder="Password">
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                          <div class="col-md-4"> </div>
                          <div class="col-md-8">
                            <input type="password" class="form-control" placeholder="Confirm Password">
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-4"> Address </div>
                        <div class="col-md-8">
                          <textarea class="form-control" row="3" placeholder="House No./Street/Barangay"> </textarea>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-4"> </div>
                        <div class="col-md-4"> 
                          <input type="text" class="form-control" placeholder="City / Municipality">
                        </div>
                        <div class="col-md-4"> 
                            <input type="text" class="form-control" placeholder="Province / State">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-5">
                          <input type="text" class="form-control" placeholder="Country">
                        </div>
                        <div class="col-md-3">
                          <input type="text" class="form-control" placeholder="Zip Code">
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
        </div>
      </div>
    </div>
  </div>
  </div>
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="https://unpkg.com/ionicons@4.4.6/dist/ionicons.js"></script>
</body>
</html>