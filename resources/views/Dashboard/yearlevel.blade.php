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
  <title>Document</title>
</head>
<body>
  @include('Pages.sidebar')
        <div class="content">
          <div class="sidebar-content">
          </div>
          <div class="title">
            <h1>Grade Level </h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><ion-icon name="speedometer" id="dashboard-icon"> </ion-icon> <a href="/dashboard">Dashboard </a> </li>
                <li class="breadcrumb-item active" aria-current="page">Grade Level</li>
              </ol>
            </nav>
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalFade">
                Add grade level
            </button>
            <div class="modal fade" id="modalFade" tabindex = "-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Add grade level</h5>
                    <button type="button" class="close" data-dismiss="modal"> &times; </button>
                  </div>  
                  <div class="modal-body">
                    <form action="{{ url('yearlevel') }} " method="POST">
                       @csrf
                    <div class="form-group">
                      <label class="col-form-label">Year Level</label>
                      <input type="text" class="form-control" name="yearLevel">
                    </div>
                    <div class="form-group">
                      <label class="col-form-label">Section</label>
                      <input type="text" class="form-control" name="description">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                    <button type="submit" class="btn btn-primary"> Submit </button>                    
                  </form>
                  </div>
                </div>
              </div>
            </div>
            <table class="table table-hover table-bordered table-responsive-md">
              <thead>
                <tr>
                  <th>@sortablelink('id')</th>
                  <th>@sortablelink('yearLevel')</th>
                  <th>@sortablelink('description') </th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>
                <?php $no =1 ?>
                @foreach ($yearlevel as $yearlevels)
                  <tr class="post{{ $yearlevels->id}}">
                    <td> {{ $no++ }} </td>
                    <td> {{ $yearlevels->yearLevel }} </td>
                    <td> {{ $yearlevels->description }} </td>
                    <td>
                        <a href="#" class="edit-modal btn btn-warning"   data-target="#myModal" data-toggle="modal" data-id="{{ $yearlevels->id}}" data-yearLevel="{{ $yearlevels->yearLevel}}" data-description="{{ $yearlevels->description}}">  <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>
                        <a href="#" class="delete-modal  btn btn-danger" data-target="#myModal" data-toggle="modal" data-id="{{ $yearlevels->id}}" data-yearLevel="{{ $yearlevels->yearLevel}}"  data-description="{{ $yearlevels->description}}"> <i class="fa fa-trash-o" aria-hidden="true"></i> Delete </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <div class="mt-4">
              {{ $yearlevel->links()}}
            </div>
          </div>
          <div class="modal fade" id="myModal" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Edit year level </h5>
                  <button type="button" class="close" data-dismiss="modal"> &times; </button>
                </div>
                <div class="modal-body">
                  <form method="POST" class="form-horizontal" role="modal">
                    @csrf
                    <div class="form-group hide">
                      <label>  Id </label>
                      <input type="text" class="form-control" id="id" name="id" disabled>
                    </div>
                    <div class="form-group">
                      <label>  Year Level </label>
                      <input type="text" class="form-control" id="a" name="yearLevel" required>
                    </div>
                    <div class="form-group">
                        <label>  Description </label>
                        <input type="text" class="form-control" id="b" name="description" required>
                    </div>
                  </form>
                    <div class="deleteContent">
                      Do you want to delete this?
                    </div>
                </div>
                <div class="modal-footer">
                  <button class="btn actionBtn" type="button" data-dismiss="modal">Update</button>
                  <button class="btn cancel"  type="button" data-dismiss="modal">Close </button>
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
    $(document).on('click', '.edit-modal', function(){
      $('.modal-title').text('Edit year level');
      $('.form-horizontal').show();
      $('.deleteContent').hide();
      $('.actionBtn').addClass('btn-dark');
      $('#a').val($(this).data('yearlevel'));
      $('#b').val($(this).data('description'));
      $('#id').val($(this).data('id'));
      id = $('#id').val();
      $('#myModal').show();
    });
 
    $('.modal-footer').on('click', '.actionBtn', function() {
      $.ajax({
        type: 'PUT',
        url: 'yearlevel/' + id,
        data: {
          '_token': $('input[name=_token]').val(),
          'id': $('#id').val(),
          'yearLevel': $('#a').val(),
          'description': $('#b').val()
        },
        success: function(data){
          $('.post' +data.id).replaceWith(" "+
            "<tr class='post" + data.id +"'>"+
            "<td>" +data.id+ "</td>"+
            "<td>" +data.yearLevel+ "</td>"+
            "<td>" +data.description+ " </td>"+
            "<td> <a href='#' class='edit-modal btn btn-warning'  data-target='#myModal' data-toggle='modal' data-id='"+data.id+"' data-yearlevel='"+data.yearLevel+"' data-description='"+data.description+"'>"+ " <i class='fa fa-pencil-square-o' aria-hidden='true'> </i> Edit </a>" +
            "     <a href='#' class='delete-modal btn btn-danger' data-target='#myModal' data-toggle='modal' data-id='"+data.id+"' data-yearlevel='"+data.yearLevel+"' data-description='"+data.description+"'>"+ " <i class='fa fa-trash-o' aria-hidden='true'> </i> Delete </a>"+
            "</td>"+
            "</tr>");
        }
      });
    });

    // Delete a post
    $(document).on('click', '.delete-modal', function(){
      $('.modal-title').text('Delete this id');
      $('.deleteContent').show();
      $('.form-horizontal').hide();
      $('.actionBtn').addClass('btn-danger');
      $('.actionBtn').addClass('delete');
      $('.delete').removeClass('.actionBtn');
      $('.delete').text('Yes');
      $('#id').val($(this).data('id'));
      id = $('#id').val();
      $('#myModal').show();
    });
    $(document).on('click', '.delete', function() {
      $.ajax({
          type: 'DELETE',
          url: 'yearlevel/' +id,
          data: {
            '_token': $('input[name=_token').val(),
            'id': $('#id').val()
          },
          success: function(data) {
            $('.post' +$('#id').val()).remove();
          }
      });
    });
  </script>
</body>
</html>