@extends('layouts.teacher')

@section('content')
        <div class="content">
          <div class="sidebar-content">
          </div>
          <div class="row">
            <div class="col-lg-9">
              <div class="card" id="card-information1">
                <div class="card-body">
                  <div class="title">
                     <h3> Submitted Grades </h3>
                     <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"> <i class="fa fa-tachometer" aria-hidden = "true" id="dashboard-icon"> </i> <a href="/dashboard">Dashboard </a></li>
                            <li class="breadcrumb-item" aria-current="page"> <a href="/addteacher"> Students </a> </li>
                            <li class="breadcrumb-item active" aria-current="page">Teacher Information</li>
                        </ol>
                     </nav>
             
                  
                  {{-- content --}}
                  {{-- <form action="">
                    <div class="row">
                      <div class="col-lg-2">
                        <div class="form-group">
                          @foreach ($user as $users)
                              <input type="hidden" id="employee_id" value="{{$users->employee_id}}" name="employee_id">
                          @endforeach
                          <select name="schoolYear" id="schoolYear" class="form-control" required>
                            <option value="" selected disabled>-Select Advisory-</option>
                              @foreach ($schoolyear as $schoolyears)
                                  <option value="{{ $schoolyears->schoolYear}}">{{ $schoolyears->schoolYear }}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-2">
                        <div class="form-group">
                          <select name="gradeLevel" id="gradeLevel" class="form-control dynamic" data-dependent="subjectCode" required>
                            <option value="" selected disabled>-Select Grade Level-</option>
                            @foreach ($gradelevel as $gradeLevels)
                                <option value="{{ $gradeLevels->gradeLevel }}"> {{ $gradeLevels->gradeLevel}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-3">
                          <div class="form-group">
                            <select name="subjectCode" id="subjectCode" class="form-control" required>
                                <option value="" selected disabled>-Select Subject Code-</option>
                                @foreach ($subjectCode as $subjectCodes)
                                <option value="{{ $subjectCodes->subjectCode }}"> {{ $subjectCodes->subjectCode}}</option>
                            @endforeach
                            </select>
                          </div>
                      </div>

                      <div class="col-lg-3">
                          <div class="form-group">
                            <select name="gradingperiod" id="gradingperiod" class="form-control" required>
                               <option value="" selected dusabked>-Select Grading Period-</option>
                               <option value="1">1st</option>
                               <option value="2">2nd</option>
                               <option value="3">3rd</option>
                               <option value="4">4th</option>
                            </select>
                          </div>
                      </div>

                      <div class="col-lg-2">
                        <button class="btn btn-success">Search</button>
                      </div>
                    </div>
                  </form> --}}
                  
                  @foreach ($user as $users)
                      <a href="{{ action('AddTeacherController@gradepdf', ['employee_id', $users->employee_id])}}" class="btn btn-success mb-3"> <i class="fa fa-print" aria-hidden="true" ></i> EXPORT </a>
                  @endforeach
                  <form id="form-submit">
                      @csrf
                    <div class="row">
                    <div class="col-lg-12">
                    <div class="table-responsive">
                    <table class="table" id="example">
                        <thead>
                          <tr>
                            <th>Grading Period</th>
                            <th>Grade Level</th>
                            <th>Section</th>
                            <th>ID</th>
                            <th>Gender</th>
                            <th>Student Name</th>
                            <th>Grade</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($grade as $grades)
                              <tr>
                                <td>{{ $grades->gradingperiod}}</td>
                                <td>{{ $grades->gradeLevel }}</td>
                                <td>{{ $grades->className }}</td>
                                <td>{{ $grades->student_id }}</td>
                                <td>{{ $grades->gender }}</td>
                                <td>{{ $grades->firstName }} {{ $grades->middleName }} {{ $grades->lastName }}</td>
                                <td><span class="badge {{ $grades->grade >= 75 ? 'badge-success' : 'badge-danger'}}"> {{ $grades->grade}} </span></td>
                              </tr>
                          @endforeach
                        </tbody>
                    </table>
                    </div>
                    </div>
                  </div>
                </form>
                </div>
              </div>
            </div>
          </div>
            <div class="col-lg-3">
              <div class="card" id="card-information2">
                <div class="card-body">
                  <h4>Teacher Information </h4>
                  <div class="form-information">
                    @foreach ($user as $users)
                    <div class="form-group">  
                      <i class="fa fa-address-card-o mr-2" id="information-icon" aria-hidden="true"></i>
                         <span>{{ $users->employee_id}}</span>
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
                    @endforeach
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

$(document).ready(function() {
  $('#example').DataTable();
});

$(document).on('submit', 'form', function(e) {
    e.preventDefault();
    $.ajax({
        url: '{{ route("searchgrade.admin")}}',
        method: 'POST',
        data: {
          "_token": $('input[name=_token]').val(),
          "gradingperiod": $('#gradingperiod').val(),
          "gradeLevel": $('#gradeLevel').val(),
          "subjectCode": $('#subjectCode').val(),
          "schoolYear": $('#schoolYear').val(),
          "employee_id": $('#employee_id').val()
        },
        success:function(data) {
          $('tbody').html(data);
        }
    });
});

$(document).on('submit', '#form-submit', function() {
   id = $('#id').val();
    $.ajax({
        url: "studentgrades/"+id,
        method: "PUT",
        data: {
            "_token": $('input[name=_token]').val(),
            "id": id,
            "grade": $("#grade").val()
        },
        success:function(data) {
          console.log('asd');
        }
        
    });
});


</script>
@endSection