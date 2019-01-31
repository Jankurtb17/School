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
            <h1>View Submitted Grades</h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-tachometer" aria-hidden="true" id="dashboard-icon"> </i> <a href="/dashboard">Dashboard </a></li>
                <li class="breadcrumb-item active" aria-current="page"> Grade Encoding</li>
              </ol>
            </nav>
          </div>
         
          <form>
            <input type="search" class="form-control col-lg-2" name="search">
          </form>
          
          <table class="table table-hovered mt-2">
            <thead>
              <tr>
                <th>School Year</th>
                <th>Student Name</th>
                <th>Grade</th>
              </tr>
            </thead>
          </table>

            </div> 
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
@section('scripts')
<script> </script>
@endsection
@endCan
@endsection