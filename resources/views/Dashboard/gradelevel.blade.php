@extends('layouts.teacher')

@section('content')
        <div class="content">
          <div class="sidebar-content">
          </div>
          <div class="card" id="card-subjectgrade">
          <div class="card-body">
          <div class="title">
            <h1>Grade Level </h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"> <i class="fa fa-tachometer" aria-hidden="true" id="dashboard-icon"> </i><a href="/dashboard"> Dashboard </a> </li>
                <li class="breadcrumb-item active" aria-current="page">Grade Level</li>
            </ol>
            </nav>
            @if(session()->has('success'))
              <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert"> &times; </button>
                  <i class="fa fa-check" aria-hidden="true"></i> <strong> Grade Level </strong> {{ session()->get('success') }}
              </div>
            @endif

            @if(session()->has('error'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert"> &times; </button>
                <i class="fa fa-times" aria-hidden="true"></i>  <strong> Grade Level </strong> {{ session()->get('error') }}
            </div>
          @endif

          <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalFade">
               <i class="fa fa-plus"></i> ADD GRADE LEVEL
            </button>
            <div class="modal fade" id="modalFade" tabindex = "-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Add grade level</h5>
                    <button type="button" class="close" data-dismiss="modal"> &times; </button>
                  </div>  
                  <div class="modal-body">
                    <form action="{{ url('gradelevel') }} " method="POST">
                       @csrf
                    <div class="form-group">
                      <label class="col-form-label">School Year</label>
                      <select name="schoolYear" id="schoolYear" class="form-control">
                        <option value="" selected disabled>-Select School Year-</option>
                        @foreach ($schoolyear as $schoolyears)
                            <option value="{{ $schoolyears->schoolYear}}">{{ $schoolyears->schoolYear}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label class="col-form-label">Section</label>
                      {{-- <input type="text" class="form-control" name="g"> --}}
                      <select name="gradeLevel" id="gradeLevel" class="form-control">
                        <option value="" selected disabled>-Select Grade Level-</option>
                        <option value="kindergarten">Kindergarten</option>
                        <option value="preparatory">preparatory</option>
                        <option value="1">Grade 1</option>
                        <option value="2">Grade 2</option>
                        <option value="3">Grade 3</option>
                        <option value="4">Grade 4</option>
                        <option value="5">Grade 5</option>
                        <option value="6">Grade 6</option>
                      </select>
                    </div>
                    <div class="form-group">
                        <label col-form-label>Section Name</label>
                        <input type="text" class="form-control" name="className" id ="className">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"> Submit </button>                    
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel </button>
                  </form>
                  </div>
                </div>
              </div>
            </div>  
            <div class="table-wrapper-scroll-y">
            <table class="table table-hover table-responsive-md" id="example">
              <thead>
                <tr>
                  <th>@sortablelink('id')</th>
                  <th>School Year</th>
                  <th>Grade Level </th>
                  <th>Class Name </th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody class="table-bordered">
                @foreach ($yearlevel as $yearlevels)
                  <tr class="post{{ $yearlevels->id}}">
                    <td> {{ $yearlevels->id }} </td>
                    <td> {{ $yearlevels->schoolYear }} </td>
                    <td> {{ $yearlevels->gradeLevel }} </td>
                    <td> {{ $yearlevels->className }} </td>
                    <td>
                        <a href="#" class="edit-modal btn btn-warning"   data-target="#myModal" data-toggle="modal" data-id="{{ $yearlevels->id}}" data-schoolyear="{{ $yearlevels->schoolYear}}" data-gradelevel="{{ $yearlevels->gradeLevel}}" data-classname="{{ $yearlevels->className}}">  <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>
                        <a href="#" class="delete-modal  btn btn-danger" data-target="#myModal" data-toggle="modal" data-id="{{ $yearlevels->id}}" data-schoolyear="{{ $yearlevels->schoolYear}}" data-gradelevel="{{ $yearlevels->gradeLevel}}" data-classname="{{ $yearlevels->className}}"> <i class="fa fa-trash-o" aria-hidden="true"></i> Delete </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            </div>
            <div class="mt-4">
              {{ $yearlevel->links()}}
            </div>
          </div>
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
                      <input type="hidden" class="form-control" id="id" name="id">
                    <div class="form-group">
                      <label>  School Year </label>
                      {{-- <input type="text" class="form-control" id="a" name="schoolYear" required> --}}
                      <select name="schoolYear" id="a" class="form-control">
                          <option value="" selected disabled>-Select School Year-</option>
                          @foreach ($schoolyear as $schoolyears)
                              <option value="{{ $schoolyears->schoolYear}}">{{ $schoolyears->schoolYear}}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>  Grade Level </label>
                        {{-- <input type="text" class="form-control" id="b" name="gradeLevel" required> --}}
                        <select name="gradeLevel" id="b" class="form-control">
                            <option value="" selected disabled>-Select Grade Level-</option>
                            <option value="kindergarten">Kindergarten</option>
                            <option value="preparatory">preparatory</option>
                            <option value="1">Grade 1</option>
                            <option value="2">Grade 2</option>
                            <option value="3">Grade 3</option>
                            <option value="4">Grade 4</option>
                            <option value="5">Grade 5</option>
                            <option value="6">Grade 6</option>
                          </select>
                    </div>
                    <div class="form-group">
                        <label> Class Name </label>
                        <input type="text" class="form-control" id="c" name="classname" required>
                    </div>
                  </form>
                    <div class="deleteContent">
                      Do you want to delete this?
                    </div>
                </div>
                <div class="modal-footer">
                  <button class="btn actionBtn" type="button" data-dismiss="modal">Update</button>
                  <button class="btn btn-danger delete" type="button" data-dismiss="modal">Delete</button>
                  <button class="btn btn-default"  type="button" data-dismiss="modal">Close </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
@endSection

@section('scripts')
  <script>
   
    $(document).ready(function() {
        $('#example').DataTable();
    });
    $(document).on('click', '.edit-modal', function(){
      $('.modal-title').text('Edit year level');
      $('.actionBtn').show();
      $('.delete').hide();
      $('.form-horizontal').show();
      $('.deleteContent').hide();
      $('.actionBtn').addClass('btn-dark');
      $('#a').val($(this).data('schoolyear'));
      $('#b').val($(this).data('gradelevel'));
      $('#c').val($(this).data('classname'));
      $('#id').val($(this).data('id'));
      id = $('#id').val();
      $('#myModal').show();
    });
 
    $('.modal-footer').on('click', '.actionBtn', function() {
      $.ajax({
        type: 'PUT',
        url: 'gradelevel/' + id,
        data: {
          '_token': $('input[name=_token]').val(),
          'id': $('#id').val(),
          'schoolYear': $('#a').val(),
          'gradeLevel': $('#b').val(), 
          'className':  $('#c').val() 
        },
        success: function(data){
          $('.post' +data.id).replaceWith(" "+
            "<tr class='post" + data.id +"'>"+
            "<td>" +data.id+ "</td>"+
            "<td>" +data.schoolYear+ "</td>"+
            "<td>" +data.gradeLevel+ " </td>"+
            "<td>" +data.className+ " </td>"+
            "<td> <a href='#' class='edit-modal btn btn-warning'  data-target='#myModal' data-toggle='modal' data-id='"+data.id+"' data-schoolyear='"+data.schoolYear+"' data-gradelevel='"+data.gradeLevel+"' data-classname='"+data.className+"'>"+ " <i class='fa fa-pencil-square-o' aria-hidden='true'> </i> Edit </a>" +
            "     <a href='#' class='delete-modal btn btn-danger' data-target='#myModal' data-toggle='modal' data-id='"+data.id+"' data-schoolyear='"+data.schoolYear+"' data-gradelevel='"+data.gradeLevel+"' data-classname='"+data.className+"'>"+ " <i class='fa fa-trash-o' aria-hidden='true'> </i> Delete </a>"+
            "</td>"+
            "</tr>");
        }
      });
    });

    // Delete a post
    $(document).on('click', '.delete-modal', function(){
      $('.modal-title').text('Delete this id');
      $('.delete').show();
      $('.actionBtn').hide();
      $('.deleteContent').show();
      $('.form-horizontal').hide();
      $('#id').val($(this).data('id'));
      id = $('#id').val();
      $('#myModal').show();
    });
    $(document).on('click', '.delete', function() {
      $.ajax({
          type: 'DELETE',
          url: 'gradelevel/' +id,
          data: {
            '_token': $('input[name=_token]').val(),
            'id': $('#id').val()
          },
          success: function(data) {
            $('.post' +$('#id').val()).remove();
          }
      });
    });
  </script>
@endSection