@extends('layouts.admin')

@section('content')
    @can('isAdmin')
        <div class="content">
          <div class="sidebar-content">
          </div>
          <div class="card" id="card-subjectgrade">
            <div class="card-body">
              <div class="title">
                <h1>Dashboard </h1>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"> <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</li>
                  </ol>
                </nav>
              </div>
              <div class="card-deck">
                <div class="card">
                  <div class="card-body">
                    <div class="dash-icon d-flex justify-content-center pt-4 bg-primary">
                        <i class="fa fa-lock" aria-hidden="true" id="dashboard-icon"></i>
                    </div>
                    <div class="dash-header">
                      <h5 class="card-title">  Admin </h5>
                      <p class="card-text"> {{ $admin }}</p>
                        
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <div class="dash-icon d-flex justify-content-center pt-4 bg-danger">
                        <i class="fa fa-users" aria-hidden="true" id="dashboard-icon"></i>
                    </div>
                    <div class="dash-header">
                      <h5 class="card-title">  Teacher </h5>
                      <p class="card-text">  {{ $teacher }} </p>
                    </div>
                  </div>
                </div>
              <div class="card">
                <div class="card-body">
                  <div class="dash-icon d-flex justify-content-center pt-4 bg-success">
                      <i class="fa fa-users" aria-hidden="true" id="dashboard-icon"></i>
                  </div>
                  <div class="dash-header">
                    <h5 class="card-title">  Student </h5>
                    <p class="card-text">  {{ $student }} </p>
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
  @endCan
@endsection