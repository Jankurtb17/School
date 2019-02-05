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
                  <table>
                    <thead align="center  ">
                      <tr>
                        <th rowspan="2">Learning Areas</th>
                        <th colspan="4">Quarter </th>
                        <th rowspan="2">Final Grade </th>
                        <th rowspan="2">Remarks</th>
                      </tr>
                      <tr>
                        <th>1st</th>
                        <th>2nd</th>
                        <th>3rd</th>
                        <th>4th</th>
                      </tr>
                    </thead>
                    <tbody align="center" class="table-bordered">
                      @foreach ($first as $firsts)
                          <tr>
                              <td>{{ $firsts->subjectCode}}</td>
                              <td>{{ $firsts->grade}}</td>
                          </tr>
                      @endforeach
                    </tbody>
                  </table>
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
                         <span>{{ $users->student_id}}</span>
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
  $(document).on('keyup', '#search', function() {
    value = $(this).val();
    $.ajax({
      url: "{{ route('find.teacher')}}",
      type: "GET",
      data: {
        "search": value,
        "_token": $('input[name_token]').val()
      },
      success:function(data) {
        $('tbody').html(data);
      }
    });
  });
</script>
@endSection