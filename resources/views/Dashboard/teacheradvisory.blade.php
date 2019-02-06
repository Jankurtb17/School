@extends('layouts.teacher')


@section('content')
  @include('Pages.sidebar')
        <div class="content">
          <div class="sidebar-content">
          </div>
          <div class="card" id="card-subjectgrade">
            <div class="card-body">
              <div class="title">
                <h1>Manage Teacher Advisory </h1>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><i class="fa fa-tachometer" aria-hidden="true" id="dashboard-icon"> </i> <a href="/dashboard">Dashboard </a> </li>
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
                        <form method="POST" id="form-horizontal">
                          @csrf
                          <div class="form-group">
                              <label class="col-form-label"> School Year </label>
                              <select name="schoolYear" id="schoolYear" class="form-control dynamic " data-dependent="gradeLevel">
                                  <option value=""  selected disabled>-Select Grade Level-</option>
                                  @foreach ($yearlevel as $yearlevels)
                                      <option value="{{ $yearlevels->schoolYear }}">{{ $yearlevels->schoolYear }}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="form-group">
                            <label class="col-form-label">Grade Level</label>
                            <select name="gradeLevel" id="gradeLevel" class="form-control  dynamic dynamics" data-dependent="className">
                                <option value="">-Select Grade Level-</option>
                                {{-- @foreach ($yearlevel as $yearlevels)
                                    <option value="{{ $yearlevels->gradeLevel }}">Grade {{ $yearlevels->gradeLevel }}</option>
                                @endforeach --}}
                            </select>
                          </div>
                          <div class="form-group">
                            <label class="col-form-label">Class Name</label>
                            {{-- <input type="text" class="form-control className" id="className" placeholder="Class Name"  name="className"> --}}
                            <select name="className" id="className" class="form-control">
                              <option value="">-Select Class Name-</option>
                            </select>
                          </div>
                          <div class="form-group ">     
                            <label class="col-form-label">Teacher Name</label>
                            <select name="employee_id" id="gradeLevel" class="form-control">
                                <option value="javascript:void(0);" selected disabled>-Select Teacher Name-</option>
                                @foreach ($user as $users)
                                    <option value="{{ $users->employee_id}}">{{ $users->firstName}} {{ $users->lastName}}</option>
                                @endforeach
                              </select>
                          </div>
                          <div class="form-group">
                            <label class="col-form-label">Subject</label>
                            <select name="subjectCode" class="form-control">
                                <option value="" selected disabled>-Select Subject-</option>
                                @foreach ($subject as $subjects)
                                    <option value="{{ $subjects->subjectCode }}">{{ $subjects->description }}</option>
                                @endforeach
                            </select>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="submit"> Submit </button>                    
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
                <table class="table table-hover table-bordered table-responsive-md">
                  <thead>
                    <tr>
                      <th> ID</th>
                      <th> School Year</th>
                      <th> Grade Level</th>
                      <th> Class Name</th>
                      <th>Subject code</th>
                      <th> Teacher ID</th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $n=1; ?>
                    @foreach ($advisory as $advisories)
                        <tr class="post{{ $advisories->id }}">
                          <td>{{ $n++  }}</td>
                          <td>{{ $advisories->schoolYear }} </td>
                          <td>{{ $advisories->gradeLevel }} </td>
                          <td>{{ $advisories->className }}</td>
                          <td>{{ $advisories->subjectCode}}</td>
                          <td><a href="/teacher/{{ $advisories->employee_id }}">{{$advisories->employee_id }} </a></td>
                          <td>
                            <a href="#" class="edit-modal btn btn-warning" data-target="#myModal" data-toggle="modal" data-id="{{ $advisories->id }}" data-schoolyear="{{ $advisories->schoolYear }}" data-gradelevel="{{ $advisories->gradeLevel }}" data-sectionname="{{ $advisories->className }}" data-employee = "{{ $advisories->employee_id }}" data-description="{{ $advisories->subjectCode}}"><i class="fa fa-pencil-square-o" aria-hidden="true"> </i> Edit</a>
                            <a href="#" class="delete-modal btn btn-danger" data-target="#myModal" data-toggle="modal" data-id="{{ $advisories->id }}" data-schoolyear="{{ $advisories->schoolYear }}" data-gradelevel="{{ $advisories->gradeLevel }}" data-sectionname="{{ $advisories->className }}" data-employee = "{{ $advisories->employee_id }}" data-description="{{ $advisories->subjectCode}}"><i class="fa fa-trash-o" aria-hidden="true"> </i> Delete</a>
                          </td>
                        </tr> 
                    @endforeach
                  </tbody>
                </table>
             </div>
            </div>
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
                    <input type="hidden" class="form-control" name="id" id="id" >
                    <div class="form-group">
                        <label class="col-form-label"> School Year </label>
                        <select name="schoolYear" id="schoolYear" class="form-control dynamic " data-dependent="gradeLevel">
                            <option value=""  selected disabled>-Select Grade Level-</option>
                            @foreach ($yearlevel as $yearlevels)
                                <option value="{{ $yearlevels->schoolYear }}">{{ $yearlevels->schoolYear }}</option>
                            @endforeach
                        </select>
                     </div>
                    <div class="form-group">
                        <label class="col-form-label">Grade Level</label>
                        <select name="gradeLevel" id="gradeLevel" class="form-control  dynamic" data-dependent="className">
                            <option value="">-Select Grade Level-</option>
                            {{-- @foreach ($yearlevel as $yearlevels)
                                <option value="{{ $yearlevels->gradeLevel }}">Grade {{ $yearlevels->gradeLevel }}</option>
                            @endforeach --}}
                        </select>
                    <div class="form-group">
                        <label class="col-form-label">Class Name</label>
                        {{-- <input type="text" class="form-control className" id="className" placeholder="Class Name"  name="className"> --}}
                        <select name="className" id="className" class="form-control">
                            <option value="">-Select Class Name-</option>
                          </select>
                      </div>
                    <div class="form-group">
                      <label for="c">Teacher Name</label>
                      {{-- <input type="text" class="form-control" name="employee_id" id="c"> --}}
                      <select name="employee_id" id="c" class="form-control">
                        @foreach ($user as $user)
                            <option value="{{ $user->employee_id }}"> {{ $user->employee_id }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                        <label for="d">Subject Description</label>
                        {{-- <input type="text" class="form-control" name="employee_id" id="c"> --}}
                        <select name="subjectCode" id="d" class="form-control">
                          @foreach ($advisory as $advisories)
                              <option value="{{ $advisories->subjectCode }}"> {{ $advisories->description }}</option>
                          @endforeach
                        </select>
                      </div>
                   
                  </form>
                  <div class="deleteContent">
                    Are you sure you want to delete this?
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn actionBtn" data-dismiss="modal">Update</button>
                    <button type="button" class="btn btn-danger delete" data-dismiss="modal">Delete</button>
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
  @endSection
@section('scripts')
  <script>
   
  
    $(document).on('click', '.modal', function() {
      $('.modal-title').text('Teacher Advisory')
    });
    $(document).on('click', '.edit-modal', function(){
      $('.form-horizontal').show();
      $('.deleteContent').hide();
      $('.actionBtn').show();
      $('.delete').hide();
      $('.modal-title').text('Edit Teacher advisory');
      $('.actionBtn').addClass('btn-dark');
      $('#id').val($(this).data('id'));
      $('#schoolyear').val($(this).data('schoolyear'));
      $('#gradeLevel').val($(this).data('gradelevel'));
      $('#b').val($(this).data('class'));
      $('#c').val($(this).data('employee'));
      $('#d').val($(this).data('description'));
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
              'schoolYear': $('#schoolyear').val(),
              'gradeLevel': $('#gradeLevel').val(),
              'className': $('#className').val(),
              'employee_id': $('#c').val(),
              'description': $('#d').val()
            },
            success: function(data) {
              $('.post' +data.id).replaceWith(" "+
            "<tr class='post" + data.id +"'>"+
            "<td>" +data.id+ " </td>"+
            "<td>" +data.gradeLevel+ " </td>"+
            "<td>" +data.schoolYear+ " </td>"+
            "<td>" +data.className+ " </td>"+
            "<td>" +data.subjectCode+ " </td>"+
            "<td>" +data.employee_id+ "</td>"+
            "<td> <a href='#' class='edit-modal btn btn-warning'  data-target='#myModal' data-toggle='modal' data-id='"+data.id+"' data-gradelevel='"+data.gradeLevel+"' data-class='"+data.className+"' data-employee='"+data.employee_id+"'>"+ " <i class='fa fa-pencil-square-o' aria-hidden='true'> </i> Edit </a>" +
            "     <a href='#' class='delete-modal btn btn-danger' data-target='#myModal' data-toggle='modal' data-id='"+data.id+"' data-gradelevel='"+data.gradeLevel+"' data-class='"+data.className+"' data-employee='"+data.employee_id +"'>"+ " <i class='fa fa-trash-o' aria-hidden='true'> </i> Delete </a>"+
            "</td>"+
            "</tr>");
            }
        });
    });
    $(document).on('change', '.dynamic', function() {
        if($(this).val() != '')
        {
          select = $(this).attr("id");
          value= $(this).val();
          dependent =$(this).data('dependent');
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

 

    $(document).on('click','.delete-modal', function(){
      $('.delete').show();
      $('.actionBtn').hide();
      $('.modal-title').text('Delete this advisory');
      $('.deleteContent').show();
      $('.form-horizontal').hide();
      $('#id').val($(this).data('id'));
      id = $('#id').val();
      $('#myModal').show();
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
@endSection