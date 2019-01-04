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
            <h1>Manage Student Class </h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><ion-icon name="speedometer" id="dashboard-icon"> </ion-icon> <a href="/dashboard">Dashboard </a> </li>
                <li class="breadcrumb-item active" aria-current="page">Student Class</li>
              </ol>
            </nav>
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalFade">
                Add student class
            </button>
            <div class="modal fade" id="modalFade" tabindex = "-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Student Class</h5>
                    <button type="button" class="close" data-dismiss="modal"> &times; </button>
                  </div>  
                  <div class="modal-body">
                    <form method="POST">
                       @csrf
                      <div class="form-group">
                        <label class="col-form-label">Class</label>
                        <select name="className" id="className" class="form-control">
                          @foreach ($nameOfClasses as $row)
                            <option value="{{ $row->className}}">{{ $row->className}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="col-form-label">Student Name</label>
                        <input type="text" class="form-control" placeholder="Student Name"  name="studentName">
                      </div>
                      <div class="form-group">
                        <label class="col-form-label">Subject</label>
                        <select name="subjectName" id="subjectName" class="form-control">
                          @foreach ($subject as $subjects)
                            <option value="{{ $subjects->subjectName }}">{{ $subjects->subjectName }}</option>
                          @endforeach
                        </select>
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
            <table class="table table-hover table-bordered table-responsive-md">
              <thead>
                <tr>
                  <th> ID</th>
                  <th> Student Class</th>
                  <th> Student Name </th>
                  <th> Subject </th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>
                <?php $no =1; ?>
                @foreach ($manageclass as $manageclasses)
                    <tr class="post{{$manageclasses->id}}">
                        <td>{{ $no++ }}</td>
                        <td>{{ $manageclasses->className }}</td>
                        <td>{{ $manageclasses->studentName}} </td>
                        <td>{{ $manageclasses->subjectName }}</td>
                        <td>
                          <a href="#" class="edit-modal btn btn-warning"  data-toggle="modal" data-target="#myModal" data-id="{{ $manageclasses->id }}" data-classname="{{ $manageclasses->className}}" data-studentname="{{ $manageclasses->studentName }}" data-subjectname="{{ $manageclasses->subjectName }}"> <i class="fa fa-pencil-square-o" aria-hidden="true"> </i> Edit </a>
                          <a href="#" class="delete-modal btn btn-danger" data-toggle="modal" data-target="#myModal" data-id="{{ $manageclasses->id }}" data-classname="{{ $manageclasses->className}}" data-studentname="{{ $manageclasses->studentName }}" data-subjectname="{{ $manageclasses->subjectName }}"> <i class="fa fa-trash-o" aria-hidden="true"> </i> Delete </a>
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title"> Edit Student Class </h5>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal" method="POST" role="modal">
                    @csrf
                    <div class="form-group">
                        <label> ID NUmber </label>
                        <input type="text" class="form-control" name="id" id="id">
                      </div>

                    <div class="form-group">
                      <label for="className">Class Name</label>
                      <select name="className" id="a" class="form-control">
                        @foreach ($nameOfClasses as $row)
                          <option value="{{ $row->className}}">{{ $row->className}}</option>                            
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label> Student </label>
                      <input type="text" class="form-control" name="studentName" id="b">
                    </div>
                    <div class="form-group">
                      <label>Subject </label>
                      <select name="subjectName" id="c" class="form-control">
                        @foreach ($subject as $subjects)
                          <option value="{{ $subjects->subjectName }}">{{ $subjects->subjectName }}</option>
                        @endforeach
                      </select>
                    </div>
                  </form>
                  <div class="deleteContent">
                    Do you want to delete this?
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn actionBtn" data-dismiss="modal">Update </button>
                  <button type="button" class="btn" data-dismiss="modal">Cancel </button>
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
    $(document).on('click', '.edit-modal', function(){
      $('.modal-title').text('Edit Manage student class');
      $('.deleteContent').hide();
      $('.form-horizontal').show();
      $('.actionBtn').addClass('btn-success');
      $('.actionBtn').text('Update');
      $('#id').val($(this).data('id'));
      $('#a').val($(this).data('classname'));
      $('#b').val($(this).data('studentname'));
      $('#c').val($(this).data('subjectname'));
      id = $('#id').val();
      $('#myModal').show();
    });

    $('.modal-footer').on('click', '.actionBtn', function() {
        $.ajax({
          type: 'PUT',
          url: "studentclass/" +id,
          data: {
            '_token': $('input[name=_token]').val(),
            'id': $('#id').val(),
            'className': $('#a').val(),
            'studentName': $('#b').val(),
            'subjectName': $('#c').val()
          },
          success:function(data) {
            $('.post'+data.id).replaceWith(" "+
              "<tr class='"+data.id+"'>"+
              "<td>" +data.id+ " </td>"+
              "<td>" +data.className+ " </td>"+
              "<td>" +data.studentName+ " </td>"+
              "<td>" +data.subjectName+ "</td>"+
              "<td> <a href='#' class='edit-modal btn btn-warning'  data-target='#myModal' data-toggle='modal' data-id='"+data.id+"' data-classname='"+data.className+"' data-studentName='"+data.studentName+"' data-subjectName ='"+data.subjectName+"'>"+ " <i class='fa fa-pencil-square-o' aria-hidden='true'> </i> Edit </a>" +
              "     <a href='#' class='delete-modal btn btn-danger' data-target='#myModal' data-toggle='modal' data-id='"+data.id+"' data-classname='"+data.className+"' data-studentName='"+data.studentName+"' data-subjectName ='"+data.subjectName+"'>"+ " <i class='fa fa-trash-o' aria-hidden='true'> </i> Delete </a>"+
              "</td>"+
              "</tr>");
            }
        });
    });
    $(document).on('click','.delete-modal', function(){
      $('.modal-title').text('Delete');
      $('.deleteContent').show();
      $('.form-horizontal').hide();
      $('.actionBtn').addClass('btn-danger');
      $('.actionBtn').addClass('delete');
      $('.delete').removeClass('actionBtn');
      $('.delete').text('Yes');
      $('#id').val($(this).data('id'));
      id = $('#id').val();
      $('#myModal').show();
    });
    
    $(document).on('click', '.delete', function() {
      $.ajax({
          type: 'DELETE',
          url: 'studentclass/' +id,
          data: {
            '_token': $('input[name=_token').val(),
            'id': $('#id').val()
          },
          success: function(data){
            $('.post' + $('#id').val()).remove();
          }
      });
    });
  </script>
</body>
</html>