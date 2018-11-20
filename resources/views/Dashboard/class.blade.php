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
          <h1>Class </h1>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"> <ion-icon name="speedometer" id="dashboard-icon"> </ion-icon> <a href="/dashboard"> Dashboard </a> </li>
              <li class="breadcrumb-item active" aria-current="page"> </ion-icon>Class</li>
            </ol>
          </nav>
          <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalFade">
              Add Student 
          </button>
          <div class="modal fade" id="modalFade" tabindex = "-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Add Student</h5>
                  <button type="button" class="close" data-dismiss="modal"> &times; </button>
                </div>  
                <div class="modal-body">
                  <form action="" method="POST">
                     @csrf
                      <div class="form-group">
                        <label class="col-form-label" id="Title">Student information</label>
                        <input type="text" class="form-control" name="className" placeholder="Class Name">
                      </div>
                      <div class="form-group">
                        <label class="col-form-label">School Year </label>
                        <input type="text" class="form-control" name="schoolYear" placeholder="School Year" >
                      </div>
                     <div class="form-group"> 
                        <label class="col-form-label">Year Level </label>
                        <input type="text" class="form-control" name="yearLevel" placeholder="Year Level">
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
                  <th> ID </th>
                  <th> Class Name </th>
                  <th> School Year </th>
                  <th> Year Level </th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1 ?>
                @foreach ($class as $row)
                    <tr>
                      <td> {{ $no++}} </td>
                      <td> {{ $row->className }}</td>
                      <td> {{ $row->schoolYear }}</td>
                      <td> {{ $row->yearLevel }}</td>
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
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="https://unpkg.com/ionicons@4.4.6/dist/ionicons.js"></script>
</body>
</html>