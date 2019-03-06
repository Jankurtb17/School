@extends('layouts.admin')

@section('content')
        <div class="content">
          <div class="sidebar-content">
          </div>
          <div class="row">
            <div class="col-lg-9">
              <div class="card" id="card-information1">
                <div class="card-body">
                  <div class="title">
                     <h3> List of Subject </h3>
                     <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"> <i class="fa fa-tachometer" aria-hidden = "true" id="dashboard-icon"> </i> <a href="/dashboard">Dashboard </a></li>
                            <li class="breadcrumb-item" aria-current="page"> <a href="/student"> Students </a> </li>
                            <li class="breadcrumb-item active" aria-current="page">Student Information</li>
                        </ol>
                     </nav>
                  </div>

                  {{-- content --}}
                  <ul>
                    <li><a href="#" data-toggle="modal" data-target="#MyModal">1st Grading </a></li>
                    <li><a href="#" data-toggle="modal" data-target="#MyModal2">2nd Grading </a></li>
                    <li><a href="#" data-toggle="modal" data-target="#MyModal3">3rd Grading </a></li>
                    <li><a href="#" data-toggle="modal" data-target="#MyModal4">4th Grading </a></li>
                    <li><a href="#" data-toggle="modal" data-target="#MyModal4">4th Grading </a></li>
                  </ul>

                  
                {{-- modal 1st grading--}}
                  <div class="modal fade" id="MyModal">
                    <div class="modal-dialog" role="document"> 
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title"> View Grades</h5>
                          <button type="button" class="close" data-dismiss="modal"> &times;</button>
                        </div>
                        <div class="modal-body">
                          <form id="form-grade" action="{{ route('send.sms')}}">
                            @csrf
                          <div class="row">
                            <div class="col-lg-6">
                            <table class="ml-5" style="width:350px;">
                              <tr>
                                <th>Learning Areas</th>
                                <th>Grade</th>
                                </tr>
                                @foreach ($user as $users)
                                  <input type="hidden" value="{{$users->phone_number}}" name="phone_number">
                                @endforeach
                                @foreach ($first as $firsts)
                                  <tr>
                                    <td> <input type="hidden" name="description[]" value="{{ $firsts->description}}"> {{$firsts->description }}</td>
                                    <td><input type="hidden" value="{{$firsts->grade}}" name="grade[]">{{$firsts->grade > 0 ? $firsts->grade : 'Grade Not Encoded' }}</td>
                                  </tr>
                                @endforeach 
                            </table>
                            </div>
                          </div>
                          
                        </div>
                        <div class="modal-footer">
                        <button class="btn btn-dark" type="submit"> <i class="fa fa-envelope-o" aria-hidden="true"></i> Send Grades</button>
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  {{-- Modal 2nd Grading --}}
                  <div class="modal fade" id="MyModal2">
                    <div class="modal-dialog" role="document"> 
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title"> View Grades</h5>
                          <button type="button" class="close" data-dismiss="modal"> &times;</button>
                        </div>
                        <div class="modal-body">
                          <form id="form-grade" action="{{ route('send.sms')}}">
                            @csrf
                          <div class="row">
                            <div class="col-lg-6">
                            <table class="ml-5" style="width:350px;">
                              <tr>
                                <th>Learning Areas</th>
                                <th>Grade</th>
                                </tr>
                                @foreach ($user as $users)
                                  <input type="hidden" value="{{$users->phone_number}}" name="phone_number">
                                @endforeach
                                @foreach ($second as $seconds)
                                  <tr>
                                    <td> <input type="hidden" name="description[]" value="{{ $seconds->description}}"> {{$seconds->description }}</td>
                                    <td><input type="hidden" value="{{$seconds->grade}}" name="grade[]">{{$seconds->grade > 0 ? $seconds->grade : 'Grade Not Encoded' }}</td>
                                  </tr>
                                @endforeach
                            </table>
                            </div>
                          </div>
                          
                        </div>
                        <div class="modal-footer">
                        <button class="btn btn-dark" type="submit"> <i class="fa fa-envelope-o" aria-hidden="true"></i> Send Grades</button>
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  {{-- 4th grading --}}
                  <div class="modal fade" id="MyModal4" aria-hidden="true" role="dialog">
                      <div class="modal-dialog" role="document"> 
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title"> View Grades</h5>
                            <button type="button" class="close" data-dismiss="modal"> &times;</button>
                          </div>
                          <div class="modal-body">
                            <form id="form-grade" action="{{ route('send.sms')}}">
                              @csrf
                            <div class="row">
                              <div class="col-lg-6">
                              <table class="ml-5" style="width:350px;">
                                <tr>
                                  <th>Learning Areas</th>
                                  <th>Grade</th>
                                  </tr>
                                  @foreach ($user as $users)
                                    <input type="hidden" value="{{$users->phone_number}}" name="phone_number">
                                  @endforeach
                                  @foreach ($fourth as $fourths)
                                    <tr>
                                      <td> <input type="hidden" name="description[]" value="{{ $fourths->description}}"> {{$fourths->description }}</td>
                                      <td><input type="hidden" value="{{$fourths->grade}}" name="grade[]">{{$fourths->grade > 0 ? $fourths->grade : 'Grade Not Encoded' }}</td>
                                    </tr>
                                  @endforeach
                              </table>
                              </div>
                            </div>
                            
                          </div>
                          <div class="modal-footer">
                          <button class="btn btn-dark" type="submit"> <i class="fa fa-envelope-o" aria-hidden="true"></i> Send Grades</button>
                          </form>
                          </div>
                        </div>
                      </div>
                    </div>

                    {{-- 3rd grading --}}
                    <div class="modal fade" id="MyModal3">
                        <div class="modal-dialog" role="document"> 
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title"> View Grades</h5>
                              <button type="button" class="close" data-dismiss="modal"> &times;</button>
                            </div>
                            <div class="modal-body">
                              <form id="form-grade" action="{{ route('send.sms')}}">
                                @csrf
                              <div class="row">
                                <div class="col-lg-6">
                                <table class="ml-5" style="width:350px;">
                                  <tr>
                                    <th>Learning Areas</th>
                                    <th>Grade</th>
                                    </tr>
                                    @foreach ($user as $users)
                                      <input type="hidden" value="{{$users->phone_number}}" name="phone_number">
                                    @endforeach
                                    @foreach ($third as $thirds)
                                      <tr>
                                        <td> <input type="hidden" name="description[]" value="{{ $thirds->description}}"> {{$thirds->description }}</td>
                                        <td><input type="hidden" value="{{$thirds->grade}}" name="grade[]">{{$thirds->grade > 0 ? $thirds->grade : 'Grade Not Encoded' }}</td>
                                      </tr>
                                    @endforeach
                                </table>
                                </div>
                              </div>
                              
                            </div>
                            <div class="modal-footer">
                            <button class="btn btn-dark" type="submit"> <i class="fa fa-envelope-o" aria-hidden="true"></i> Send Grades</button>
                            </form>
                            </div>
                          </div>
                        </div>
                      </div>

                 
                </div>
              </div>
            </div>




            <div class="col-lg-3">
              <div class="card" id="card-information2">
                <div class="card-body">
                  <h4>Student Information </h4>
                  <div class="form-information">
                    @foreach ($user as $users)
                    <div class="form-group">
                      <i class="fa fa-address-card-o mr-2" id="information-icon" aria-hidden="true"></i>
                         <span>{{ $users->student_id}}, {{ $users->gradeLevel}} - {{ $users->className}}</span>
                     </div>

                  

                     <div class="form-group">
                        <i class="fa fa-user-circle-o mr-2" id="information-icon" aria-hidden="true"></i>
                           <span>{{ $users->firstName}} {{ $users->middleName }}. {{ $users->lastName }}</span>
                     </div>   
                     <div class="form-group">
                        <i class="fa fa-envelope mr-2" id="information-icon" aria-hidden="true"></i>
                           <span>{{ $users->email}}</span>
                     </div>  
                     <div class="form-group">
                        <i class="fa fa-phone-square mr-2" id="information-icon" aria-hidden="true"></i>
                           <span>{{ $users->phone_number}}</span>
                     </div>  

                     <div class="form-group">
                        <a href="#" class="edit-modal btn btn-warning" data-target="#myModal" data-toggle="modal" data-id="{{ $users->id}}" data-studnumber="{{ $users->student_id }}" data-classname="{{ $users->className }}" data-gradelevel="{{ $users->gradeLevel }}" data-first="{{ $users->firstName }}" data-last="{{ $users->lastName }}" data-email="{{ $users->email }}" data-password="{{ $users->password }}" data-fuck="{{ $users->status }}"><i class="fa fa-pencil-square-o"> </i>Edit </a>
                     </div>
                    @endforeach

                    <div class="modal fade" id="myModal">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title"> Edit Status <h5>
                              <button class="close" data-dismiss="modal" type="button">&times;</button>
                          </div>
                          <div class="modal-body">
                            <form action="" id="form-status">
                                @csrf
                                @foreach ($user as $users)
                                  <input type="hidden" value="{{ $users->id}}" id="id">
                                @endforeach
                                <div class="form-group">
                                    <label class="col-form-label">School Year </label>
                                    <select name="schoolYear" id="schoolYear" class="form-control">
                                      @foreach ($schoolyear as $schoolyears)
                                        <option value="{{ $schoolyears->schoolYear }}"> {{ $schoolyears->schoolYear }}</option>
                                      @endforeach
                                  </select>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label"> Grade Level </label>
                                    <select name="gradeLevel" id="gradeLevel" class="form-control dynamic" data-dependent="className">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label"> Section </label>
                                    <select name="className" id="className" class="form-control classic">
                                      <option value="" selected disabled>-Select Section-</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                  <label class="col-form-label"> Status </label>
                                  <select name="status" id="c" class="form-control">
                                      <option value="Active">Active</option>
                                      <option value="Inactive">Inactive</option>
                                  </select>
                                </div>
                            </div>
                          <div class="modal-footer">
                                <button type="button" class="btn btn-dark actionBtn" data-dismiss="modal">Update</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                              </form>
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
    </div>
  </div>  
</div>
@endsection
@section('scripts')
<script>

  $(document).on('change', '.dynamic', function() {
      if($(this).val() != ''){
        select = $(this).attr('id');
        value = $(this).val();
        dependent = $(this).data('dependent');
        _token = $('input[name="_token"]').val();
          $.ajax({
                  url: "{{ route('dynamicdependent3.fetch') }}",
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

    $(document).on('click', '.edit-modal', function() {
       $(".dynamic").val($(this).data('gradelevel'));
        $('#c').val($(this).data('fuck'));  
        $('#className').val($(this).data('classname'));
        $('#id').val($(this).data("id"));
        id = $('#id').val();
        student_id = $("#student_id").val();
        gradelevel = $(".dynamic2").val();
    });

    $('.modal-footer').on('click', '.actionBtn', function() {

        $.ajax( {
            type: "PUT",
            url: "/student/"+id,
            data: {
              "id": id,
              "schoolYear": $('#schoolYear').val(),
              "gradeLevel": $('#gradeLevel').val(),
              "status":     $('#c').val(),
              "className":  $('#className').val(),
              "_token":     $('input[name=_token]').val()
            },
            success:function(data){
              $(document).ajaxStop(function(){
                  setTimeout("window.location = '/student'",100);
                });
            }
        })
    });
</script>
@endSection