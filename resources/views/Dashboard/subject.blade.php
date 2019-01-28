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
        <div class="card" id="card-subjectgrade">
          <div class="card-body">
            <div class="title">
              <h1>Subject </h1>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"> <i class="fa fa-tachometer" aria-hidden="true" id="dashboard-icon"> </i> <a href="/dashboard"> Dashboard </a> </li>
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
                      <h5 class="modal-title">Add Class</h5>
                      <button type="button" class="close" data-dismiss="modal"> &times; </button>
                    </div>  
                    <div class="modal-body">
                      <form action="" method="POST">
                        @csrf
                          <div class="form-group">
                            <label class="col-form-label" id="Title">Grade Level</label>
                            {{-- <input type="text" class="form-control" name="subjectName" placeholder="Subject Name"> --}}
                          <select name="gradeLevel" id="gradeLevel" class="form-control dynamic" data-dependent="className">
                              <option value="" selected disabled>-Select Grade Level-</option>
                              @foreach ($yearlevel as $yearlevels)
                                  <option value="{{  $yearlevels->gradeLevel }}">Grade {{  $yearlevels->gradeLevel }} </option>
                              @endforeach
                          </select>
                          </div>
                          <div class="form-group">
                            <label class="col-form-label">Description  </label>
                            {{-- <input type="text" class="form-control" name="description" placeholder="Description" > --}}
                            <select name="className" id="className" class="form-control">
                              <option value="">-Select Class-</option>
                            </select>
                          </div>
                        <div class="form-group"> 
                            <label class="col-form-label">Subject Code </label>
                            <input type="text" class="form-control" name="subjectCode" id='subjectCode' placeholder="Subject Code e.g MATH 101">
                        </div>
                        <div class="form-group"> 
                            <label class="col-form-label">Subject Description </label>
                            <input type="text" class="form-control" name="description" id='description' placeholder="Subject description">
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
                      <th> Grade Level </th>
                      <th> Section Name </th>
                      <th> Subject Code</th>
                      <th> description</th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1 ?>
                    @foreach ($subject as $subjects)
                    <tr class="post{{ $subjects->id}}">
                        <td> {{ $no++ }}</td>
                        <td> {{ $subjects->gradeLevel}} </td>
                        <td> {{ $subjects->className}} </td>
                        <td> {{ $subjects->subjectCode}} </td>
                        <td> {{ $subjects->description}} </td>
                        <td>
                          <a href="#" class="edit-modal btn btn-warning"  data-target="#myModal" data-toggle="modal" data-id="{{ $subjects->id }}" data-gradelevel="{{ $subjects->gradeLevel}}" data-classname="{{ $subjects->className}}" data-subjectcode="{{ $subjects->subjectCode }}" data-description="{{ $subjects->description }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>
                          <a href="#" class="delete-modal btn btn-danger" data-target="#myModal" data-toggle="modal" data-id="{{ $subjects->id }}" data-gradelevel="{{ $subjects->gradeLevel}}" data-classname="{{ $subjects->className}}" data-subjectcode="{{ $subjects->subjectCode }}" data-description="{{ $subjects->description }}"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete </a>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              <div class="mt-2">
                  {{ $subject->links() }}
              </div>
            </div>
          </div>
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
                    <div class="form-group hide">
                      <label> Subject Name </label>
                      <input type="text" class="form-control" name="id" id="id" disabled>
                    </div>
                    <div class="form-group">
                      <label> Grade Level </label>
                      <input type="text" class="form-control" name="gradeLevel" id="a">
                      {{-- <select name="gradeLevel" id="gradeLevel" class="form-control dynamic" data-dependent="className">
                          <option value="" selected disabled>-Select Grade Level-</option>
                          @foreach ($yearlevel as $yearlevels)
                              <option value="{{  $yearlevels->gradeLevel }}">Grade {{  $yearlevels->gradeLevel }} </option>
                          @endforeach
                      </select> --}}
                    </div>
                    <div class="form-group">
                        <label> Class name</label>
                        <input type="text" class="form-control" name="className" id="b">
                        {{-- <select name="className"  class="form-control className">
                            <option value="">-Select Class-</option>
                        </select> --}}
                    </div>
                    <div class="form-group">
                        <label> Subject Code</label>
                        <input type="text" class="form-control" name="subjectCode" id="c">
                    </div>
                    <div class="form-group">
                        <label> Subject Code</label>
                        <input type="text" class="form-control" name="description" id="d">
                    </div>
                  </form>
                  <div class="deleteContent">
                    Do you want to delete this?
                  </div>  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn actionBtn" data-dismiss="modal">Update</button>
                  <button type="button" class="btn btn-danger delete" data-dismiss="modal">Delete</button>
                  <button type="button" class="btn cancel" data-dismiss="modal">Cancel </button>
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
    $(document).on('change', '.dynamic', function() {
        if($(this).val() != '')
          {
              select = $(this).attr("id");
              value = $(this).val();
              dependent =  $(this).data('dependent');
              _token = $('input[name="_token"]').val();
              $.ajax({
                  url: "{{ route('dynamicdependent.fetch') }}",
                  method: "POST",
                  data: {
                    select: select,
                    value: value,
                    _token: _token,
                    dependent:dependent
                  },
                  success:function(result)
                  {
                    $('#'+dependent).html(result);
                  }
              });
          }
    });
    $(document).on('click', '.modal', function() {
      $('.modal-title').text('Add Subject');
    });

    $(document).on('click', '.edit-modal', function() {
      $('.actionBtn').show();
      $('.delete').hide();
      $('.actionBtn').addClass('btn-success');
      $('.form-horizontal').show();
      $('.deleteContent').hide();
      $('#id').val($(this).data('id'));
      $('#a').val($(this).data('gradelevel'));
      $('#b').val($(this).data('classname'));
      $('#c').val($(this).data('subjectcode'));
      $('#d').val($(this).data('description'));
      id = $('#id').val();
      $('#myModal').show();
    });
    $('.modal-footer').on('click', '.actionBtn', function(){
      $.ajax({
          type: 'PUT',
          url:  'subject/' + id,
          data: {
            '_token': $('input[name=_token]').val(),
            'id': $('#id').val(),
            'gradeLevel': $('#a').val(),
            'className': $('#b').val(),
            'subjectCode': $('#c').val(),
            'description': $('#d').val()
          },
          success: function(data) {
            $('.post' +data.id).replaceWith(" "+
            "<tr class='post" + data.id +"'>"+
            "<td>" +data.id+ "</td>"+
            "<td>" +data.gradeLevel+ " </td>"+
            "<td>" +data.className+ " </td>"+
            "<td>" +data.subjectCode+ "</td>"+
            "<td>" +data.description+ "</td>"+
            "<td> <a href='#' class='edit-modal btn btn-warning'  data-target='#myModal' data-toggle='modal' data-id='"+data.id+"' data-gradelevel='"+data.gradeLevel+"' data-classname='"+data.className+"' data-subjectcode='"+data.subjectCode+"' data-description='"+data.description+"'>"+ " <i class='fa fa-pencil-square-o' aria-hidden='true'> </i> Edit </a>" +
            "     <a href='#' class='delete-modal btn btn-danger' data-target='#myModal' data-toggle='modal' data-id='"+data.id+"' data-gradelevel='"+data.gradeLevel+"' data-classname='"+data.className+"' data-subjectcode='"+data.subjectCode+"' data-description='"+data.description+"'>"+ " <i class='fa fa-trash-o' aria-hidden='true'> </i> Delete </a>"+
            "</td>"+
            "</tr>");
          }

      });
    });
    $(document).on('click','.delete-modal', function() {
      $('.modal-title').text('Delete this subject');
      $('.deleteContent').show();
      $('.form-horizontal').hide();
      $('.actionBtn').hide();
      $('.delete').show();
      $('#id').val($(this).data('id'));
      id = $('#id').val();
      $('#myModal').show();      
    });

    $(document).on('click', '.delete', function() {
      $.ajax({
        type: 'DELETE',
        url: 'subject/' + id,
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