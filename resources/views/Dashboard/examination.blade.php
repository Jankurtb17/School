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
            <h1>Examination Date </h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"> <i class="fa fa-tachometer" aria-hidden="true" id="dashboard-icon">  </i><a href="/dashboard">Dashboard </a> </li>
                <li class="breadcrumb-item active" aria-current="page">School Year</li>
              </ol>
            </nav>
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalFade1">
                Add examination date
            </button>
            <div class="modal fade" id="modalFade1" tabindex = "-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">examination date</h5>
                    <button type="button" class="close" data-dismiss="modal"> &times; </button>
                  </div>  
                  <div class="modal-body">
                    <form action="{{ url('examination') }}" method="POST">
                       @csrf
                    <div class="form-group">
                      <label>Examination Date </label>
                      <input type="text" class="form-control" id="schoolYear" name="schoolYear" placeholder="Enter School Year" required>
                    </div>

                    <div class="form-group">
                      <label>Examination Date </label>
                      <input type="date" class="form-control" id="schoolYear" name="examDate" required>
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
            <div class="table table-responsive">
            <table class="table table-hover table-bordered table-responsive-md">
              <thead>
                <tr>
                  <th> Id </th>
                  <th> Examination Date</th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; ?>
                @foreach ($examination as $examinations)
                    <tr class="post{{ $examinations->id }}"> 
                      <td> {{ $no++ }} </td>
                      <td> {{ date('m-d-Y', strtotime($examinations->examDate)) }}</td>
                      <td> 
                          <a href="#" class="edit-modal btn btn-warning" data-target="#myModal" data-toggle="modal" data-id="{{ $examinations->id}}" data-schoolYear="{{ $examinations->schoolYear}}" data-examDate="{{ $examinations->examDate}}"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>
                          <a href="#" class="delete-modal btn btn-danger" data-target="#myModal" data-toggle="modal" data-id="{{ $examinations->id}}" data-schoolYear="{{ $examinations->schoolYear}}" data-examDate="{{ $examinations->examDate}}"> <i class="fa fa-trash-o" aria-hidden="true"></i> Delete </a>
                        </td>
                    </tr>
                @endforeach
              </tbody> 
            </table>
            </div>
            <div id="myModal" class="modal fade" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit school year </h4>
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <form method="POST" class="form-horizontal" role="modal">
                      @csrf
                      <div class="form-group">
                        <label>School Year </label>
                        <input type="text" class="form-control" id="schoolYear" name="schoolYear" required>
                      </div>

                      <div class="form-group">
                        <label>Examination Date </label>
                        <input type="date" class="form-control" id="examDate" name="examDate" required>
                      </div>
                    </form>
                  <div class="deleteContent">
                    Do you want to delete this? 
                  </div>
                </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-dark actionBtn" data-dismiss="modal"> Update </button>
                    <button type="button" class="btn btn-md" data-dismiss="modal"> Cancel</button>
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
    $('nav-item').on('click', 'nav-link', function(){
        $('.nav-item nav-link.active').removeClass('current');
        $(this).addClass('current');
    }); 

    $(document).on('click','.edit-modal', function(){
      $('.modal-title').text('Edit school year');
      $('.form-horizontal').show();
      $('.deleteContent').hide();
      $('.actionBtn').addClass('btn-success');
      $('.actionBtn').removeClass('btn-danger');
      $('.actionBtn').addClass('edit');
      $('#schoolyr').val($(this).data('schoolyear'));
      $('#myModal').show();
    });

  $(document).on('click','.delete-modal', function() {
      $('.modal-title').text('Delete this id');
      $('.deleteContent').show();
      $('.form-horizontal').hide();
      $('.actionBtn').text('Delete');
    });

    $('modal-footer').on('click', 'edit', function(){
        $.ajax({
            type: 'DELETE',
            url:  'editPost',
            data: {
              '_token': $('input[name=_token').val(),
              'schoolYear': $('#schoolyr').val()
            },
            success: function(data) {
              $('.post' + data.id).replaceWith(" "+
                "<tr class='post'"+data.id +"'>" +
                "<td>" + data.id + "</td>"+
                "<td>" + data.schoolYear + "</td> </tr>");
            }
        });
      });
  </script>
</body>
</html>