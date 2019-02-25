@extends('layouts.teacher')


@section('content')
        <div class="content">
          <div class="sidebar-content">
          </div>
          <div class="card" id="card-subjectgrade">
            <div class="card-body">
              <div class="title">
                <h1>Examination Date </h1>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <i class="fa fa-tachometer" aria-hidden="true" id="dashboard-icon">  </i><a href="/dashboard"> Dashboard </a> </li>
                    <li class="breadcrumb-item active" aria-current="page">School Year</li>
                  </ol>
                </nav>
                <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalFade1">
                    Add examination date
                </button>
                <div class="modal fade" id="modalFade1" tabindex = "-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">examination date</h5>
                        <button type="button" class="close" data-dismiss="modal"> &times; </button>
                      </div>  
                      <div class="modal-body">
                        <form action="{{ url('examination') }}" method="POST">
                          @csrf
                        <div class="form-group">
                            <label class="col-form-label">School Year</label>
                            <select name="schoolYear" id="schoolYear" class="form-control">
                              <option value="" selected disabled>-Select School Year-</option>
                              @foreach ($schlyr as $schlyrs)
                                  <option value="{{ $schlyrs->schoolYear}}">{{ $schlyrs->schoolYear}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label"> Grading Period</label>
                            <select name="grading" id="grading" class="form-control">
                              <option value="" selected disabled>-Select Grading Period-</option>
                              <option value="1">1st Grading</option>
                              <option value="2">2nd Grading</option>
                              <option value="3">3rd Grading</option>
                              <option value="4">4th Grading</option>
                            </select>
                        </div>
                        <div class="form-group">
                          <label class="col-form-label">Start Date </label>
                          <input type="date" class="form-control" id="startDate" name="startDate" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">End Date </label>
                            <input type="date" class="form-control" id="endDate" name="endDate" required>
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
                <div class="table table-responsive">
                <table class="table table-hover table-bordered table-responsive-md">
                  <thead>
                    <tr>
                      <th> Id </th>
                      <th> School Year </th>
                      <th> Grading Period </th>
                      <th> Start Date of Examination</th>
                      <th> End Date of Examination</th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; ?>
                    @foreach ($examination as $examinations)
                        <tr class="post{{ $examinations->id }}"> 
                          <td> {{ $no++ }} </td>
                          <td> {{ $examinations->schoolYear }}</td>
                          <td> {{ $examinations->grading }} Grading</td>
                          <td> {{ $examinations->startDate }}</td>
                          <td> {{ $examinations->endDate }}</td>
                          <td> 
                              <a href="#" class="edit-modal btn btn-warning" data-target="#myModal" data-toggle="modal" data-id="{{ $examinations->id}}" data-schoolyear="{{ $examinations->schoolYear}}" data-grading="{{ $examinations->grading}}" data-startdate="{{ $examinations->startDate}}" data-enddate="{{ $examinations->endDate}}"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>
                              <a href="#" class="delete-modal btn btn-danger" data-target="#myModal" data-toggle="modal" data-id="{{ $examinations->id}}" data-schoolyear="{{ $examinations->schoolYear}}" data-grading="{{ $examinations->grading}}" data-startdate="{{ $examinations->startDate}}" data-enddate="{{ $examinations->endDate}}"> <i class="fa fa-trash-o" aria-hidden="true"></i> Delete </a>
                            </td>
                        </tr>
                    @endforeach
                  </tbody> 
                </table>
                </div>
              <div class="m-2">
                  {{ $examination->links() }}
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
                          <input type="hidden" class="form-control" id="id">
                      <div class="form-group">
                          <label class="col-form-label">School Year</label>
                          <select name="schoolYear" id="a" class="form-control">
                            <option value="" selected disabled>-Select School Year-</option>
                            @foreach ($schlyr as $schlyrs)
                                <option value="{{ $schlyrs->schoolYear}}">{{ $schlyrs->schoolYear}}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                          <label class="col-form-label"> Grading Period</label>
                          <select name="grading" id="b" class="form-control">
                            <option value="" selected disabled>-Select Grading Period-</option>
                            <option value="1">1st Grading</option>
                            <option value="2">2nd Grading</option>
                            <option value="3">3rd Grading</option>
                            <option value="4">4th Grading</option>
                          </select>
                      </div>
                      <div class="form-group">
                        <label class="col-form-label">Start Date </label>
                        <input type="date" class="form-control" id="start" name="startDate" required>
                      </div>
                      <div class="form-group">
                          <label class="col-form-label">End Date </label>
                          <input type="date" class="form-control" id="end" name="endDate" required>
                      </div>
                    </form>
                  <div class="deleteContent">
                    Do you want to delete this? 
                  </div>
                </div>
                  <div class="modal-footer">
                    <button type="button" class="btn actionBtn" data-dismiss="modal"> Update </button>
                    <button type="button" class="btn btn-danger deletes" data-dismiss="modal"> Delete </button>
                    <button type="button" class="btn" data-dismiss="modal"> Cancel</button>
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
      $('.modal-title').text('Examination date');
    });
    $(document).on('click','.edit-modal', function(){
      $('.actionBtn').show();
      $('.deletes').hide();
      $('.modal-title').text('Edit examination date');
      $('.form-horizontal').show();
      $('.deleteContent').hide();
      $('.actionBtn').text('Update');
      $('.actionBtn').addClass('btn-success');
      $('.actionBtn').removeClass('btn-danger');
      $('.actionBtn').removeClass('delete');
      $('#a').val($(this).data('schoolyear'));
      $('#b').val($(this).data('grading'));
      $('#start').val($(this).data('startdate'));
      $('#end').val($(this).data('enddate'));
      $('#id').val($(this).data('id'));
      id = $('#id').val();
      $('#myModal').show();
    });

    $('.modal-footer').on('click', '.actionBtn', function(){
      $.ajax({
        type: 'PUT',
        url:  'examination/' + id,
        data: {
          '_token': $('input[name=_token').val(),
          'id': id,
          'schoolYear': $('#a').val(),
          'grading': $('#b').val(),
          'startDate': $('#start').val(),
          'endDate': $('#end').val()
        },
        success: function(data) {
          $('.post' + data.id).replaceWith(" "+
          "<tr class='post'"+data.id +"'>" +
            "<td>" + data.id + "</td>"+
            "<td>" + data.schoolYear + "</td>"+
            "<td>" + data.grading + "</td>"+
            "<td>" + data.startDate + "</td>"+
            "<td>" + data.endDate + "</td>"+
            "<td> <a href='#' class='edit-modal btn btn-warning'  data-target='#myModal' data-toggle='modal' data-id='"+data.id+"' data-schoolyear='"+data.schoolYear+"' data-grading='"+data.grading+"' data-startdate='"+data.startDate+"' data-enddate='"+data.endDate+"'>"+ " <i class='fa fa-pencil-square-o' aria-hidden='true'> </i> Edit </a>" +
              "     <a href='#' class='delete-modal btn btn-danger'  data-target='#myModal' data-toggle='modal' data-id='"+data.id+"' data-schoolyear='"+data.schoolYear+"' data-grading='"+data.grading+"' data-startdate='"+data.startDate+"'data-enddate='"+data.endDate+"'>"+ " <i class='fa fa-pencil-square-o' aria-hidden='true'> </i> Delete </a>" +
              "</tr>");
          }
        });
      });

    $(document).on('click','.delete-modal', function() {
        $('.deletes').show();
        $('.actionBtn').hide();
        $('.modal-title').text('Delete this date');
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        $('.delete').removeClass('actionBtn');
        $('#id').val($(this).data('id'));
        id = $('#id').val();
        $('#myModal').show();
      });

    $(document).on('click', '.deletes', function() {
        $.ajax({
            type: 'DELETE',
            url: 'examination/' +id,
            data: {
              '_token': $('input[name=_token]').val(),
              'id': $('#id').val()
            },
            success:function(data) {
                $('.post'+id).remove();
            }
        });
    });
  </script>
@endsection