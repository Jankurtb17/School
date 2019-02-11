@extends('layouts.admin')


@section('content')
  @include('Pages.sidebar')
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

                @if(count($errors))
                  <div class="alert alert-danger" role="alert">
                      <button class="close" data-dismiss="alert" aria-hidden="true">&times; </button>
                      @foreach ($errors->all() as $error)
                          <li> {{ $error }} </li>
                      @endforeach
                  </div>
                @endif

                <form method="POST" id="form-submit" action="{{ route('studentgrades.grade')}}"> 
                @csrf
                <div class="row">
                  <div class="col-lg-3">
                    <div class="form-group">
                      <select name="subjectCode" id="subjectCode" class="form-control" required>
                        <option value="" selected disabled>-Select Subject-</option>
                        @foreach ($advisory as $advisories)
                            <option value="{{ $advisories->subjectCode}}">{{$advisories->subjectCode}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-2">
                      <div class="form-group">
                        <select name="gradingperiod" class="form-control" required>
                          <option value="" selected disabled>-Select Grading Period-</option>
                          <option value="1">1st</option>
                          <option value="2">2nd</option>
                          <option value="3">3rd</option>
                          <option value="4">4th</option>
                        </select>
                      </div>
                    </div>
                    @foreach ($advisory as $advisories)
                    <input type="hidden" name="schoolYear" value="{{ $advisories->schoolYear }}">
                    </td><input type="hidden" name="className" value="{{ $advisories->className }}">
                    @endforeach
                </div>
                <div class="table-wrapper-scroll-y">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID Number</th>
                      <th>Gender</th>
                      <th>Student Name</th>
                      <th>Input Grade</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($user as $users)
                      <tr>
                          <td><input type="hidden" name="student_id[]" value="{{$users->student_id}}">{{$users->student_id}}</td>
                          <td>{{$users->gender}}</td>
                          <td>{{$users->firstName}} {{ $users->middleName}} {{$users->lastName}}</td>
                          <td><input  type="text" name="grade[]" class="form-control col-lg-2" id="grade" onkeypress="isNumber(event)" maxlength="5" required></td>
                          <input type="hidden" name="gradeLevel[]" value="{{$users->gradeLevel}}">
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                </div>
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
  <script>
     function isNumber(evt) {
      var ch = String.fromCharCode(evt.which);
      if(!/^[0-9.\b]+$/.test(ch)) {
        evt.preventDefault();
      }
    }
  </script>
@endsection