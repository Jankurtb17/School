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
              </div>
              {{-- @if(Auth()->user()->status == 'Active') --}}
                <form method="POST">
                  <div class="row">
                
                    <div class="col-lg-2">
                      <select class="form-control" name="gradingPeriod" id="gradingPeriod">
                        <option value="" selected disabled>-Grading Period-</option>
                        <option value="1">1st Grading</option>
                        <option value="2">2nd Grading</option>
                        <option value="3">3rd Grading</option>
                        <option value="4">4th Grading</option>
                      </select>
                    </div>
                    <div class="col-lg-2">
                      <select class="form-control" name="schoolYear" id="schoolYear">
                          <option value="" selected disabled>-School Year-</option>
                          @foreach ($schoolyear as $schoolyears)
                              <option value="{{ $schoolyears->schoolYear }}">{{ $schoolyears->schoolYear }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group"> 
                      <button type="submit" class="btn btn-primary"> Proceed </button>
                    </div>
                  </div>
                </form>

                      <table class="table">
                          <thead align="left">
                              <tr>
                                <th>Subject Code <th>
                                <th>Subject Description <th>
                                <th>Instructor <th>
                                <th>Grade <th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody align="left">

                            </tbody>
                      </table>
                  {{-- @else 
                     <h4 class="display-5">Please pay your remaining balance to view grades </h1>
                  @endIf --}}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
@section('scripts')
<script>
  $(document).on('submit', 'form', function(e) {
    e.preventDefault();
      $.ajax({
          url: "{{ route('show.grades')}}",
          type: "POST",
          data: {
            "_token": $('input[name=_token]').val(),
            "gradingPeriod": $('#gradingPeriod').val(),
            "schoolYear": $('#schoolYear').val(),
          },
          success:function(data)
          {
            $('tbody').html(data);
          }
      });
  });
</script>
@endsection
</body>
</html>
@endCan
@endsection