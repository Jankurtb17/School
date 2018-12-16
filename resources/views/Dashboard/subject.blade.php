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
          <h1>Subject </h1>
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
                        <label class="col-form-label" id="Title">Subject Name</label>
                        <input type="text" class="form-control" name="subjectName" placeholder="Subject Name">
                      </div>
                      <div class="form-group">
                        <label class="col-form-label">Description  </label>
                        <input type="text" class="form-control" name="description" placeholder="Description" >
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
                  <th> Subject Name </th>
                  <th> Description </th>
                  <th> Year Level </th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1 ?>
                @foreach ($subject as $subjects)
                 <tr class="post{{ $subjects->id}}">
                    <td> {{ $no++ }}</td>
                    <td> {{ $subjects->subjectName}} </td>
                    <td> {{ $subjects->description}} </td>
                    <td> {{ $subjects->yearLevel}} </td>
                    <td>
                      <a href="#" class="edit-modal btn btn-warning"  data-target="#myModal" data-toggle="modal" data-id="{{ $subjects->id }}" data-subjectname="{{ $subjects->subjectName}}" data-description="{{ $subjects->description}}" data-yearlevel="{{ $subjects->yearLevel }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>
                      <a href="#" class="delete-modal btn btn-danger" data-target="#myModal" data-toggle="modal" data-id="{{ $subjects->id }}" data-subjectname="{{ $subjects->subjectName}}" data-description="{{ $subjects->description}}" data-yearlevel="{{ $subjects->yearLevel }}"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete </a>
                    </td>
                 </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="modal fade" id="myModal" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title"> Edit Class </h5>
                  <button type="button" class="close" data-dismiss="modal"> &times; </button>
                </div>
                <div class="modal-body">
                  <form method="POST" class="form-horizontal" role="modal">
                    @csrf
                    <div class="form-group">
                      <label> Subject Name </label>
                      <input type="text" class="form-control" name="subjectName" id="a">
                    </div>
                    <div class="form-group">
                        <label> Description</label>
                        <input type="text" class="form-control" name="description" id="b">
                    </div>
                    <div class="form-group">
                        <label> Year Level</label>
                        <input type="text" class="form-control" name="yearLevel" id="c">
                    </div>
                  </form>
                  <div class="deleteContent">
                    Do you want to delete this?
                  </div>  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-dark actionBtn" data-dismiss="modal">Update</button>
                  <button type="button" class="btn btn-md" data-dismiss="modal">Cancel </button>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).on('click', '.edit-modal', function() {
      $('.form-horizontal').show();
      $('.deleteContent').hide();
      $('.actionBtn').addClass('btn-success');
      $('.actionBtn').removeClass('btn-danger');
      $('.actionBtn').addClass('edit');
      $('#a').val($(this).data('subjectname'));
      $('#b').val($(this).data('description'));
      $('#c').val($(this).data('yearlevel'));
      $('#myModal').show();
    });
    $(document).on('click','.delete-modal', function() {
      $('.modal-title').text('Delete this id');
      $('.deleteContent').show();
      $('.form-horizontal').hide();
      $('.actionBtn').text('Delete')
    });
  </script>
</body>
</html>