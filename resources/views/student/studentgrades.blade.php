@extends('layouts.admin')


@section('content')
  @include('Pages.sidebar')
  @can('isStudent')
        <div class="content">
          <div class="sidebar-content">
          </div>
          <div class="card" id="card-subjectgrade">
            <div class="card-body">
              <div class="title">
                <h1>Grades</h1>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <ion-icon name="speedometer" id="dashboard-icon"> </ion-icon> <a href="/dashboard">Dashboard </a></li>
                    <li class="breadcrumb-item active" aria-current="page">Grades</li>
                  </ol>
                </nav>
                <form>
                  <div class="row">
                
                    <div class="col-lg-2">
                      <select class="form-control" name="period">
                        <option value="" selected disabled>-Grading Period-</option>
                        <option value="1">1st Grading</option>
                        <option value="2">2nd Grading</option>
                        <option value="3">3rd Grading</option>
                        <option value="4">4th Grading</option>
                      </select>
                    </div>
                    <div class="col-lg-2">
                      <select class="form-control" name="schoolYear">
                          <option value="" selected disabled>-School Year-</option>
                          @foreach ($schoolyear as $schoolyears)
                              <option value="{{ $schoolyears->schoolYear }}">{{ $schoolyears->schoolYear }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group"> 
                      <button type="submit" class="btn btn-primary"> Proceed </button>
                    </div>
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
  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
@endCan
@endsection