@extends('layouts.admin')


@section('content')
  @include('Pages.sidebar')
  @can('isTeacher')
        <div class="content">
          <div class="sidebar-content">
          </div>
          <div class="card" id="card-subjectgrade">
            <div class="card-body">
              <div class="title">
                <h1>GRADE ENCODING</h1>
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"> <ion-icon name="speedometer" id="dashboard-icon"> </ion-icon> <a href="/dashboard">Dashboard </a></li>
                      <li class="breadcrumb-item active" aria-current="page">GRADE ENCODING</li>
                    </ol>
                  </nav>

                <form method="POST" id="form-submit" action="{{ route('studentgrades.grade')}}"> 
                @csrf
                <div class="row">
                  <div class="col-lg-3">
                    <div class="form-group">
                      <select name="subjectCode" id="subjectCode" class="form-control" required>
                        <option value="" selected disabled>-Select Subject-</option>
                        @foreach ($advisory as $advisories)
                            <option value="{{ $advisories->subject}}">{{$advisories->subject}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-3">
                      <div class="form-group">
                        <select name="gradingperiod" class="form-control" required>
                          <option value="" selected disabled>-Select Grading Period-</option>
                          <option value="1">1st Grading</option>
                          <option value="2">2nd Grading</option>
                          <option value="3">3rd Grading</option>
                          <option value="4">4th Grading</option>
                        </select>
                      </div>
                    </div>
                    @foreach ($advisory as $advisories)
                    <input type="hidden" name="schoolYear" value="{{ $advisories->schoolYear }}">
                    </td><input type="hidden" name="className" value="{{ $advisories->className }}">
                    @endforeach
                </div>
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID Number</th>
                      <th>Student Name</th>
                      <th>Input Grade</th>
                      <th>Remarks</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($user as $users)
                      <tr>
                          <td><input type="hidden" name="student_id[]" value="{{$users->student_id}}">{{$users->student_id}}</td>
                          <td>{{$users->firstName}} {{$users->lastName}}</td>
                          <td><input  type="text" name="grade[]" class="form-control col-lg-2"></td>
                          <td><input type="hidden" name="gradeLevel[]" value="{{$users->gradeLevel}}"></td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                <button type="submit" class="btn btn-success">Submit Grade </button>
                </form>
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
 
@endsection
@endCan