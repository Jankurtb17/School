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
            <h1>School Year </h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"> <i class="fa fa-tachometer" aria-hidden="true" id="dashboard-icon">  </i><a href="/dashboard">Dashboard </a> </li>
                <li class="breadcrumb-item active" aria-current="page">Search</li>
              </ol>
            </nav>
            
              <div class="form-group">
              <input type="text" class="form-control input-lg teacher" name="teacher" id="#teacher" placeholder="Enter Teacher Name">
              <div id="teacherList"> </div>
               @csrf
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
    $(document).on('keyup', '.teacher',function(){
              query = $(this).val();
              if(query != '')
              {
                 _token = $('input[name="_token"]').val();
                $.ajax({
                url:"{{ route('autocomplete.fetch') }}",
                method:"POST",
                data:{query:query, _token:_token},
                success:function(data){
                      $('#teacherList').fadeIn();  
                      $('#teacherList').html(data);
                  }
                });
              }
          });

    $(document).on('click', 'li', function(){  
        $('#teacherList').val($(this).text());  
        $('#teacherList').fadeOut();  
    });  

    $(document).on('click','.edit-modal', function(){
      $('.modal-title').text('Edit school year');
      $('.form-horizontal').show();
      $('.deleteContent').hide();
      $('.actionBtn').addClass('btn-success');
      $('.actionBtn').removeClass('delete');
      $('#id').val($(this).data('id'));
      $('#a').val($(this).data('schoolyear'));
      id = $('#id').val();
      $('#myModal').show();
    });

    $('.modal-footer').on('click', '.actionBtn', function() {
      $.ajax({
        type: 'PUT',
        url: 'schoolyear/' +id,
        data: {
          '_token': $('input[name=_token]').val(),
          'id': $('#id').val(),
          'schoolYear': $('#a').val()
        },
        success:function(data) {
          $('.post' +data.id).replaceWith(" "+
          "<tr class='post" + data.id +"'>"+
            "<td>" +data.id+ "</td>"+
            "<td>" +data.schoolYear+ " </td>"+
            "<td> <a href='#' class='edit-modal btn btn-warning'  data-target='#myModal' data-toggle='modal' data-id='"+data.id+"' data-schoolYear='"+data.schoolYear+"' >"+ " <i class='fa fa-pencil-square-o' aria-hidden='true'> </i> Edit </a>" +
            "     <a href='#' class='delete-modal btn btn-danger' data-target='#myModal' data-toggle='modal' data-id='"+data.id+"' data-schoolYear='"+data.schoolYear+"' >"+ " <i class='fa fa-trash-o' aria-hidden='true'> </i> Delete </a>"+
            "</td>"+
            "</tr>");
        }
      });
    });
    
    // Delete Post
    $(document).on('click','.delete-modal', function() {
    $('.modal-title').text('Delete this id');
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('delete');
    $('.delete').removeClass('actionBtn');
    $('.delete').text('Yes');
    $('#id').val($(this).data('id'));
    id = $('#id').val();
    });
    $(document).on('click','.delete', function() {
      $.ajax({
        type: 'DELETE',
        url: 'schoolyear/' +id,
        data: {
          '_token': $('input[name=_token]').val(),
          'id': $('#id').val()
        },
        success:function(data) {
          $('.post' + $('#id').val()).remove();
        }
      });
    });
  </script>
</body>
</html>