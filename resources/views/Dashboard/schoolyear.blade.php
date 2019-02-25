@extends('layouts.admin')

@can('isAdmin')
@section('content')
  @include('Pages.sidebar')
        <div class="content">
          <div class="sidebar-content">
          </div>
          <div class="card" id="card-subjectgrade">
            <div class="card-body">
              <div class="title">
                <h1>School Year </h1>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <i class="fa fa-tachometer" aria-hidden="true" id="dashboard-icon">  </i><a href="/dashboard"> Dashboard </a> </li>
                    <li class="breadcrumb-item active" aria-current="page">School Year</li>
                  </ol>
                </nav>
                <div class="ui-form">
                @if(session()->has('success'))
                  <div class="alert alert-success" role="alert">
                    <button class="close" aria-hidden="true" data-dismiss="alert">&times; </button>
                    <i class="fa fa-check" aria-hidden="true"></i> <strong> School Year </strong> {{ session()->get('success')}}
                  </div>
                @endif

                @if(session()->has('error'))
                  <div class="alert alert-danger float-right" role="alert">
                    <button class="close" aria-hidden="true" data-dismiss="alert">&times; </button>
                    <i class="fa fa-times" aria-hidden="true"></i> <strong> School Year </strong> {{ session()->get('error')}}
                  </div>
                @endif
                <button type="button" class="btn btn-primary mb-2 float-left" data-toggle="modal" data-target="#modalFade1">
                   <i class="fa fa-plus"></i> ADD SCHOOL YEAR
                </button>
                </div>

                @if(count($errors) > 0)
                  <button class="close" data-dismiss="alert"> &times; </button>
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error}} </div>
                    @endforeach
                @endif
            
                <div class="modal fade" id="modalFade1" tabindex = "-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Add School Year</h5>
                        <button type="button" class="close" data-dismiss="modal"> &times; </button>
                      </div>  
                      <div class="modal-body">
                        <form action="{{ url('schoolyear') }}" method="POST">
                          @csrf
                        <div class="form-group">
                          <label>School Year </label>
                          <input type="text" class="form-control" id="schoolYear" name="schoolYear" placeholder="Enter School Year">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="submit"> Submit </button>     
                        <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel </button>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="table table-responsive-md">
                <table class="table table-hover" id="example">
                  <thead>
                    <tr>
                      <th> Id </th>
                      <th> School Year</th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; ?>
                    @foreach ($schoolyear as $schoolyears)
                        <tr class="post{{ $schoolyears->id }}"> 
                          <td> {{ $no++ }} </td>
                          <td> {{ $schoolyears->schoolYear }}</td>
                          <td> 
                              <a href="#" class="edit-modal btn btn-warning" data-target="#myModal" data-toggle="modal" data-id="{{ $schoolyears->id}}" data-schoolYear="{{ $schoolyears->schoolYear}}"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>
                              <a href="#" class="delete-modal btn btn-danger" data-target="#myModal" data-toggle="modal" data-id="{{ $schoolyears->id}}" data-schoolYear="{{ $schoolyears->schoolYear}}"> <i class="fa fa-trash-o" aria-hidden="true"></i> Delete </a>
                            </td>
                        </tr>
                    @endforeach
                  </tbody> 
                </table>
                </div>
                <div class="mt-2">
                  {{ $schoolyear->links() }}
                </div>
              </div>
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
                     
                        <input type="hidden" class="form-control" id="id" name="id">

                      <div class="form-group">
                        <label>School Year </label>
                        <input type="text" class="form-control" id="a" name="schoolYear" required>
                      </div>
                    </form>
                  <div class="deleteContent">
                    Do you want to delete this? 
                  </div>
                </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-dark actionBtn" data-dismiss="modal"> Update </button>
                    <button type="button" class="btn btn-danger delete" data-dismiss="modal">Delete</button>
                    <button type="button" class="btn btn-default cancel" data-dismiss="modal"> Cancel</button>
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
@endsection

 @section('scripts')
  <script type="text/javascript">
  
    $(document).on('click', '.modal', function() {
      $('.modal-title').text('Add School Year');
    });

    $(document).on('click','.edit-modal', function(){
      $('.actionBtn').show();
      $('.delete').hide();
      $('.modal-title').text('Edit school year');
      $('.form-horizontal').show();
      $('.deleteContent').hide();
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
    $('.delete').show();
    $('.actionBtn').hide();
    $('.modal-title').text('Delete this id');
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#id').val($(this).data('id'));
    id = $('#id').val();
    $('#myModal').show();
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
@endsection
@endCan