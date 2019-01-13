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
              Add Class Section
          </button>
          <div class="modal fade" id="modalFade" tabindex = "-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Add Class Section</h5>
                  <button type="button" class="close" data-dismiss="modal"> &times; </button>
                </div>  
                <div class="modal-body">
                  <form method="POST">
                    @csrf
                      <div class="form-group">
                        <label class="col-form-label">School Year </label>
                        {{-- <input type="text" class="form-control" name="schoolYear" placeholder="School Year"> --}}
                        <select class ="form-control" name="schoolYear" id="schoolYear">
                          <option value="" selected disabled>-Select School Year-</option>
                          @foreach ($schoolyear as $schoolyears)
                              <option value="{{ $schoolyears->schoolYear }}"> {{ $schoolyears->schoolYear }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group"> 
                          <label class="col-form-label">Grade Level </label>
                          {{-- <input type="text" class="form-control" name="yearLevel" placeholder="Year Level"> --}}
                          <select class ="form-control" name="yearLevel" id="yearLevel">
                              <option value="" selected disabled>-Select Grade Year-</option>
                              @foreach ($yearlevels as $yearlevel)
                                  <option value="{{ $yearlevel->gradeLevel }}"> {{ $yearlevel->gradeLevel }}</option>
                              @endforeach
                            </select>
                      </div>
                      <div class="form-group">
                        <label class="col-form-label" id="Title">Section Name</label>
                        <input type="text" class="form-control" name="className" placeholder="Class Name">
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
                    <tr class="post{{ $row->id}}">
                      <td> {{ $no++}} </td>
                      <td> {{ $row->className }}</td>
                      <td> {{ $row->schoolYear }}</td>
                      <td> {{ $row->yearLevel }}</td>
                      <td>
                        <a href="#" class="edit-modal btn btn-warning"  data-target="#myModal" data-toggle="modal" data-id="{{ $row->id}}" data-classname="{{ $row->className }}" data-schoolyear="{{ $row->schoolYear}}" data-yearlevel="{{ $row->yearLevel}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                        <a href="#" class="delete-modal btn btn-danger" data-target="#myModal" data-toggle="modal" data-id="{{ $row->id}}" data-classname="{{ $row->className }}" data-schoolyear="{{ $row->schoolYear}}" data-yearlevel="{{ $row->yearLevel}}"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
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
                  <h5 class="modal-title">Edit Class</h5>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <form method="POST" class="form-horizontal" role="modal">
                    @csrf
                    <div class="form-group hide">
                      <label>Class Name </label>
                      <input type="text" class="form-control" name="id" id="id">
                    </div>
                    <div class="form-group">
                      <label>Class Name </label>
                      <input type="text" class="form-control" name="className" id="a">
                    </div>
                    <div class="form-group">
                        <label>School Year </label>
                        <input type="text" class="form-control" name="schoolYear" id="b">
                    </div>
                    <div class="form-group">
                        <label>Year Level </label>
                        <input type="text" class="form-control" name="yearLevel" id="c">
                    </div>
                  </form>
                <div class="deleteContent">
                  Do you want to delete this?
                </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn actionBtn" data-dismiss="modal">Update</button>
                  <button type="button" class="btn " data-dismiss="modal">Cancel </button>
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
      $('.modal-title').text('Edit Class');
      $('.deleteContent').hide();
      $('.form-horizontal').show();
      $('.actionBtn').addClass('btn-success');
      $('.actionBtn').removeClass('btn-danger');
      $('.actionBtn').removeClass('delete');
      $('#id').val($(this).data('id'));
      $('#a').val($(this).data('classname'));
      $('#b').val($(this).data('schoolyear'));
      $('#c').val($(this).data('yearlevel'));
      id = $('#id').val();
      $('#myModal').show();
    });

    $('.modal-footer').on('click', '.actionBtn', function() {
      $.ajax({
          type: 'PUT',
          url:  'class/' +id,
          data: {
            '_token': $('input[name=_token]').val(),
            'id': $('#id').val(),
            'className': $('#a').val(),
            'schoolYear': $('#b').val(),
            'yearLevel': $('#c').val()
          },
          success: function(data) {
            $('.post' +data.id).replaceWith(" "+
            "<tr class='post" + data.id +"'>"+
            "<td>" +data.id+ "</td>"+
            "<td>" +data.className+ " </td>"+
            "<td>" +data.schoolYear+ " </td>"+
            "<td>" +data.yearLevel+ "</td>"+
            "<td> <a href='#' class='edit-modal btn btn-warning'  data-target='#myModal' data-toggle='modal' data-id='"+data.id+"' data-className='"+data.className+"' data-schoolYear='"+data.schoolYear+"' data-yearLevel='"+data.yearLevel+"'>"+ " <i class='fa fa-pencil-square-o' aria-hidden='true'> </i> Edit </a>" +
            "     <a href='#' class='delete-modal btn btn-danger' data-target='#myModal' data-toggle='modal' data-id='"+data.id+"' data-className='"+data.className+"' data-schoolYear='"+data.schoolYear+"' data-yearLevel='"+data.yearLevel+"'>"+ " <i class='fa fa-trash-o' aria-hidden='true'> </i> Delete </a>"+
            "</td>"+
            "</tr>");

          }
      });
    });

    $(document).on('click','.delete-modal', function() {
      $('.modal-title').text('Delete this class?');
      $('.deleteContent').show();
      $('.form-horizontal').hide();
      $('.actionBtn').addClass('btn-danger');
      $('.actionBtn').addClass('delete');
      $('.delete').removeClass('actionBtn');
      $('.delete').removeClass('btn-success');
      $('.delete').text('Yes');
      $('#id').val($(this).data('id'));
      id = $('#id').val();
      $('#myModal').show();
    });
    $(document).on('click', '.delete', function() {
      $.ajax({
          type: 'DELETE',
          url: 'class/' + id,
          data: {
            '_token': $('input[name=_token]').val(),
            'id': id
          },
          success:function(data) {
            $('.post' + id).remove();
          }
      });
    });
  </script>
</body>
</html>