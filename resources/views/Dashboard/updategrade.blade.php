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
            <a class="delete-modal btn btn-danger mb-2" data-target="#myModal" data-toggle="modal"> <i class="fa fa-trash"></i></a>
            <div class="table-wrapper-scroll-y">
            <table class="table" id="example" >
              <thead>
                <tr>
                  <th><input type="checkbox" id="checkall" class="toggle-button"></th>
                  <th>Student Id</th>
                  <th>Student Name</th>
                  <th>Grade Level</th>
                  <th>School Year</th>
                  <th>Grading period</th>
                  <th>Section</th>
                  <th>Subject</th>
                  <th>Grade</th>
                  <th>Teacher ID</th>
                  <th>Action</th> 
                </tr>
              </thead>
              <tbody>
                @foreach ($grades as $grade)
                    <tr class="post{{$grade->id}}">
                      <td><input type="checkbox" class="checkbox" name="row_id[]" data-id="{{$grade->id}}"></td>
                      <td>{{ $grade->student_id}}</td>
                      <td>{{ $grade->firstName}} {{ $grade->middleName}} {{ $grade->lastName}}</td>
                      <td>{{ $grade->gradeLevel}}</td>
                      <td>{{ $grade->schoolYear}}</td>
                      <td>{{ $grade->gradingperiod}}</td>
                      <td>{{ $grade->className}}</td>
                      <td>{{ $grade->subjectCode}}</td>
                      <td>{{ $grade->grade}}</td>
                      <td>{{ $grade->employee_id}}</td>
                      <td>
                        <a href="#" class="edit-modal btn btn-success btn-md" data-target="#myModal" data-toggle="modal" data-grading="{{ $grade->gradingperiod}}" data-subject="{{ $grade->description}}" data-id="{{ $grade->id}}" data-grade="{{ $grade->grade }}" data-name="{{ $grade->firstName}} {{ $grade->middleName}} {{ $grade->lastName}}">Update Grade</a>
                        <a href="#" class="delete-modal btn btn-danger btn-md" data-target="#myModal" data-toggle="modal" data-grading="{{ $grade->gradingperiod}}" data-subject="{{ $grade->description}}" data-id="{{ $grade->id}}" data-grade="{{ $grade->grade }}" data-name="{{ $grade->firstName}} {{ $grade->middleName}} {{ $grade->lastName}}">Delete Grade</a>
                      </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            </div>


            {{-- modal content of update grade --}}
            <div class="modal" id="myModal" role="dialog">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content" >
                  <div class="modal-header">
                      <h5 class="modal-title">Update Grade</h5>
                      <button class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                      <form action="" class="form-horizontal">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="id" id="studentid" class="form-control">
                        </div>
                        <div class="form-group">
                          <input type="hidden" name="rowId[]" id="id" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-label-form">Name</label>
                            <input type="text" class="form-control" id="name" name="name" readonly>
                        </div>
                        <div class="form-group">
                          <label for="grade" class="col-label-form">Subject Description</label>
                          <input type="text" class="form-control" id="subjectCode" name="subjectCode" readonly>
                        </div>
                        <div class="form-group">
                            <label for="grade" class="col-label-form">Grading Period</label>
                            <input type="text" class="form-control" id="gradingperiod" name="gradingperiod" readonly>
                          </div>
                         <div class="form-group">
                          <label for="grade" class="col-label-form">Grade</label>
                          <input type="text" class="form-control" id="grade" name="grade">
                        </div>
                      </form>
                      {{-- Delete Content --}}
                        <div class="delete-content">
                            Are you sure you want to delete This?
                        </div>
                  </div>
                  <div class="modal-footer">
                      <button class="btn btn-dark actionBtn" type="button">Update</button>
                      <button class="btn btn-danger deleteBtn" type="button">Delete</button>
                      <button class="btn btn-defualt" data-dismiss="modal">Close</button>
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

    $(document).ready(function() {
      $('#example').dataTable();
      $('.toggle-button').click( function () {
      $('input[type="checkbox"]').prop('checked', this.checked)
      });
    
      $(document).on('click', '.delete-modal', function() {
        $('.delete-content').show();
        $('.form-horizontal').hide();
        $('.modal-title').text('Delete Record');
        $('.deleteBtn').show();
        $('.actionBtn').hide();
        $('#id').val($(this).data('id'));
        id = $('#id').val();
      });

      $('.modal-footer').on('click', '.deleteBtn', function() {
        let idsArr =[];
        $('.checkbox:checked').each(function() {
          idsArr.push($(this).attr('data-id'));
        });

        let strIds = idsArr.join(","); 
          $.ajax({
              url: "viewstudentgrades/"+strIds,
              type: 'DELETE',
              data: {
                "id": +strIds,
                "_token": $('input[name=_token').val()
              },
              success: function (data) {
                  $('.post'+id).remove();
              },
              error: function (data) {
                  alert(data.responseText);
              }
        });
      });
    });

    
    $(document).on('click','.edit-modal', function(){
      $('.form-horizontal').show();
      $('.delete-content').hide();
      $('#studentid').val($(this).data('id'));
      $('#name').val($(this).data('name'));
      $('#grade').val($(this).data('grade'));
      $('#subjectCode').val($(this).data('subject'));
      $('#gradingperiod').val($(this).data('grading'));
      $('#id').val($(this).data('rowid'));
      $('.modal-title').text('Update Grades');
      $('.deleteBtn').hide();
      $('.actionBtn').show();
      id = $('#studentid').val();
      $('#myModal').show(); 
    });

    $('.modal-footer').on('click', '.actionBtn', function() { 
      $.ajax({
        type: 'PUT',
        url: 'viewstudentgrades/' +id,
        data: {
          '_token': $('input[name=_token]').val(),
          'id': $('#studentid').val(),
          'grade': $('#grade').val()
        },
        success:function(data) {
          $(document).ajaxStop(function(){
                  setTimeout("window.location = '/viewstudentgrades'",100);
          }); 
        }
      });
    });

  
  
  </script>
@endsection