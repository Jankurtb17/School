@extends('layouts.teacher')

@section('content')
        <div class="content">
          <div class="sidebar-content">
          </div>
          <div class="card" id="card-subjectgrade">
            <div class="card-body">
              <div class="title">
                <h1>Student Grades </h1>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <i class="fa fa-tachometer" aria-hidden="true" id="dashboard-icon">  </i><a href="/dashboard"> Dashboard </a> </li>
                    <li class="breadcrumb-item active" aria-current="page">Student Grades</li>
                  </ol>
                </nav>
              </div>

            <table class="table" id="example">
              <thead>
                <tr>
                  <th>Student Id</th>
                  <th>Grade Level</th>
                  <th>School Year</th>
                  <th>Grading period</th>
                  <th>Section</th>
                  <th>Subject</th>
                  <th>Grade</th>
                  <th>Teacher Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($grades as $grade)
                    <tr>
                      <td>{{ $grade->student_id}}</td>
                      <td>{{ $grade->gradeLevel}}</td>
                      <td>{{ $grade->schoolYear}}</td>
                      <td>{{ $grade->gradingperiod}}</td>
                      <td>{{ $grade->className}}</td>
                      <td>{{ $grade->subjectCode}}</td>
                      <td>{{ $grade->grade}}</td>
                      <td>{{ $grade->firstName}} {{ $grade->middleName}} {{ $grade->lastName}}</td>
                      <td>
                        <a href="#" class="btn btn-success btn-sm">Update Grade</a>
                      </td>
                    </tr>
                @endforeach
              </tbody>
            </table>

        </div>
      </div>
    </div>
  </div>
  </div>
@endsection

 @section('scripts')
  <script type="text/javascript">

    $(document).ready(function() {
        $('#example').dataTable();
    });

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