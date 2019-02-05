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
                     <h3> Submitted Grades </h3>
                     <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"> <i class="fa fa-tachometer" aria-hidden = "true" id="dashboard-icon"> </i> <a href="/dashboard">Dashboard </a></li>
                            <li class="breadcrumb-item" aria-current="page"> <a href="/addteacher"> Students </a> </li>
                            <li class="breadcrumb-item active" aria-current="page">Teacher Information</li>
                        </ol>
                     </nav>
                  </div>
                  
                  {{-- content --}}
                  <form action="">
                    <div class="form-group">
                      <select name="" id="" class="form-control col-lg-3">
                        <option value="" selected disabled>-Select Advisory-</option>
                        @foreach ($advisory as $advisories)
                            <option value="{{ $advisories->gradeLevel}}">Grade {{ $advisories->gradeLevel}}-{{ $advisories->className}}</option>
                        @endforeach
                      </select>
                    </div>
                  </form>

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
@endSection