<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title> Online Grading System </title>
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
            <h1>Manage Teacher Advisory </h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><ion-icon name="speedometer" id="dashboard-icon"> </ion-icon> <a href="/dashboard">Dashboard </a> </li>
                <li class="breadcrumb-item active" aria-current="page">Teacher Advisory</li>
              </ol>
            </nav>
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalFade">
                Add teacher advisory
            </button>
            <div class="modal fade" id="modalFade" tabindex = "-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title"> Teacher Advisory</h5>
                    <button type="button" class="close" data-dismiss="modal"> &times; </button>
                  </div>  
                  <div class="modal-body">
                    <form action="" method="POST">
                       @csrf
                       <div class="form-group">
                         <label class="col-form-label">Grade Level</label>
                         <select name="gradeLevel" id="gradeLevel" class="form-control  dynamic" data-dependent="className">
                            <option value=""  selected disabled>-Select Grade Level-</option>
                            @foreach ($yearlevel as $yearlevels)
                                <option value="{{ $yearlevels->gradeLevel }}">Grade {{ $yearlevels->gradeLevel }}</option>
                            @endforeach
                         </select>
                       </div>
                       <div class="form-group">
                         <label class="col-form-label">Class Name</label>
                         {{-- <input type="text" class="form-control className" id="className" placeholder="Class Name"  name="className"> --}}
                         <select name="className" id="className" class="form-control">
                           <option value="">-Select Class Name-</option>
                         </select>
                         <div id="className"></div>
                       </div>

                      <div class="form-group ">     
                        <label class="col-form-label">Teacher Name</label>
                        <select name="employee_id" id="gradeLevel" class="form-control">
                            <option value="javascript:void(0);" selected disabled>-Select Teacher Name-</option>
                            @foreach ($user as $users)
                                <option value="{{ $users->employee_id}}">{{ $users->firstName}} {{ $users->lastName}}</option>
                            @endforeach
                          </select>
                        <div id="teacherList"></div>
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
                  <th> Grade Level</th>
                  <th> Class Name</th>
                  <th> Teacher Name</th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>
                <?php $n=1; ?>
                @foreach ($advisory as $advisories)
                    <tr class="post{{ $advisories->id }}">
                      <td>{{ $n++  }}</td>
                      <td>{{ $advisories->gradeLevel }} </td>
                      <td>{{ $advisories->className }}</td>
                      <td><a href="/teacher/{{ $advisories->employee_id }}">{{$advisories->employee_id }} </a></td>
                    
                      <td>
                        <a href="#" class="edit-modal btn btn-warning" data-target="#myModal" data-toggle="modal" data-id="{{ $advisories->id }}" data-teacher="{{ $advisories->teacherName }}" data-class="{{ $advisories->className }}" data-subject = "{{ $advisories->subjectName }}"><i class="fa fa-pencil-square-o" aria-hidden="true"> </i> Edit</a>
                        <a href="#" class="delete-modal btn btn-danger" data-target="#myModal" data-toggle="modal" data-id="{{ $advisories->id }}" data-teacher="{{ $advisories->teacherName }}" data-class="{{ $advisories->className }}" data-subject = "{{ $advisories->subjectName }}"><i class="fa fa-trash-o" aria-hidden="true"> </i> Delete</a>
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
                    <h5 class="modal-title"></h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <form action="" method="POST" class="form-horizontal">
                    @csrf
                    <div class="form-group hide">
                      <label> Teacher </label>
                      <input type="text" class="form-control" name="id" id="id" disabled>
                      <div id="teacherList"> </div>
                    </div>
                    <div class="form-group">
                      <label> Teacher </label>
                      <input type="text" class="form-control" name="teacherName" id="a">
                    </div>
                    <div class="form-group">
                      <label for="b">Class</label>
                      <input type="text" class="form-control" name="className" id="b">
                    </div>
                    <div class="form-group">
                      <label for="c">Subject</label>
                      <input type="text" class="form-control" name="subjectName" id="c">
                    </div>
                  </form>
                  <div class="deleteContent">
                    Are you sure you want to delete this?
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn actionBtn" data-dismiss="modal"></button>
                    <button type="button" class="btn" data-dismiss="modal">Cancel</button>
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
  <script>
    $(document).on('change', '.dynamic', function() {
        if($(this).val() != '')
        {
          select = $(this).attr("id");
          value= $(this).val();
          dependent  =$(this).data('dependent');
          _token = $('input[name="_token"]').val();
          $.ajax({
            url: "{{ route('dynamicdependent2.fetch')}}",
            method: "POST",
            data: {
              select: select,
              value: value,
              _token: _token,
              dependent: dependent
            },
            success:function(result)
            {
              $('#'+dependent).html(result);
            }

          })
        }
    });
    $(document).on('click', '.edit-modal', function(){
      $('.form-horizontal').show();
      $('.deleteContent').hide();
      $('.modal-title').text('Edit Teacher advisory');
      $('.actionBtn').text('Update')
      $('.actionBtn').addClass('btn-dark');
      $('#id').val($(this).data('id'));
      $('#a').val($(this).data('teacher'));
      $('#b').val($(this).data('class'));
      $('#c').val($(this).data('subject'));
      id = $('#id').val();
      $('#myModal').show();
    });

    $('.modal-footer').on('click', '.actionBtn', function() {
        $.ajax({
            type: 'PUT',
            url:  'advisory/' +id,
            data: {
              '_token': $('input[name=_token]').val(),
              'id':$('#id').val(),
              'teacherName': $('#a').val(),
              'className': $('#b').val(),
              'subjectName': $('#c').val(),
            },
            success: function(data) {
              $('.post' +data.id).replaceWith(" "+
            "<tr class='post" + data.id +"'>"+
            "<td>" +data.teacherName+ " </td>"+
            "<td>" +data.className+ " </td>"+
            "<td>" +data.subjectName+ "</td>"+
            "<td> <a href='#' class='edit-modal btn btn-warning'  data-target='#myModal' data-toggle='modal' data-id='"+data.id+"' data-subjectName='"+data.subjectName+"' data-description='"+data.description+"' data-yearLevel='"+data.yearLevel+"'>"+ " <i class='fa fa-pencil-square-o' aria-hidden='true'> </i> Edit </a>" +
            "     <a href='#' class='delete-modal btn btn-danger' data-target='#myModal' data-toggle='modal' data-id='"+data.id+"' data-subjectName='"+data.subjectName+"' data-description='"+data.description+"' data-yearLevel='"+data.yearLevel+"'>"+ " <i class='fa fa-trash-o' aria-hidden='true'> </i> Delete </a>"+
            "</td>"+
            "</tr>");
            }
        });
    });

    $(document).on('click','.delete-modal', function(){
      $('.deleteContent').show();
      $('.form-horizontal').hide();
      $('.modal-title').text('Delete');
      $('.actionBtn').addClass('btn-danger');
      $('.actionBtn').addClass('delete');
      $('.delete').removeClass('actionBtn');
      $('.delete').text('Yes');
      $('#id').val($(this).data('id'));
      id = $('#id').val();
    });

    $(document).on('click', '.delete', function() {
        $.ajax({
            type: 'DELETE',
            url: 'advisory/' +id,
            data: {
              '_token': $('input[name=_token').val(),
              'id': id
            },
            success:function(data) {
              $('.post' + $('#id').val()).remove();
            }
        });
    });
  </script>
</body>
</html>