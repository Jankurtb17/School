@extends('layouts.teacher')

@section('content')
        <div class="content">
          <div class="sidebar-content">
          </div>
          <div class="card" id="card-subjectgrade">
          <div class="card-body" >
          <div class="title">
            <h1>Subject Load</h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"> <ion-icon name="speedometer" id="dashboard-icon"> </ion-icon> <a href="/dashboard">Dashboard </a></li>
                <li class="breadcrumb-item active" aria-current="page">Students</li>
              </ol>
            </nav>
            
           <div class="form-group">
              @if(session()->has('notif'))
                <div class="alert alert-success" role="alert">
                    <button class="close" aria-hidden="true" data-dismiss="alert">&times; </button>
                    <i class="fa fa-check"  aria-hidden="true"></i> <strong>Grade</strong> {{session()->get('notif')}}
                </div>
              @endif
           </div>

           <div class="form-group">
            @if(session()->has('error'))
              <div class="alert alert-danger" role="alert">
                  <button class="close" aria-hidden="true" data-dismiss="alert">&times; </button>
                  <i class="fa fa-times" aria-hidden="true"></i>  <strong>Grade</strong> {{session()->get('error')}}
              </div>
            @endif
          </div>

          <div class="form-group">
            @if(count($errors))
              <div class="alert alert-danger" role="alert">
                  <button class="close" aria-hidden="true" data-dismiss="alert">&times; </button>
                  @foreach ($errors->all() as $error)
                      <li> {{ $error }} </li>
                  @endforeach
              </div>
            @endif
          </div>
            
     
          
            <div class="table-responsive mt-3">
              <table class="table table-hover" id="example">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>School Year</th>
                      <th>Grade Level</th>
                      <th>Section</th>
                      <th>Subject</th>
                      <th>Action</th>
                    </tr> 
                  </thead>
                  
                  

                  <tbody id="tbody">
                    
                    {{-- @foreach ($examdate as $examdates)
                      @if (Carbon\Carbon::now('Asia/Taipei')->setTime(0, 0, 0)->between(Carbon\Carbon::parse($examdates->startDate), Carbon\Carbon::parse($examdates->endDate))) --}}
                        @foreach ($advisory as $advisories)
                            <tr class="post{{ $advisories->id}}">
                              <td>{{$advisories->id}}</td>
                              <td>{{$advisories->schoolYear}}</td>
                              <td>{{$advisories->gradeLevel }}</td>
                              <td>{{$advisories->className}}</td>
                              <td>{{ $advisories->subjectCode}}</td>
                              <td><a class="btn btn-success" href="/studentgrades/{{$advisories->gradeLevel}}/{{$advisories->className }}/{{ $advisories->subjectCode}}">Encode Grade</a></td>
                            </tr>
                        @endforeach
                      {{-- @else --}}
                        {{-- @foreach ($advisory as $advisories)
                        <tr class="post{{ $advisories->id}}">
                          <td>{{$advisories->id}}</td>
                          <td>{{$advisories->schoolYear}}</td>
                          <td>{{$advisories->gradeLevel }}</td>
                          <td>{{$advisories->className}}</td>
                          <td>{{ $advisories->subjectCode}}</td>
                          <td>Encoding of grades is not yet available</td>
                        </tr>
                        @endforeach --}}
                      {{-- @endif
                    @endforeach --}}
                  </tbody>
              </table>
            </div>

         
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  @endSection
  @section('scripts')
  <script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
      $(document).on('keyup', '#search', function() {
        
        value = $(this).val();
        $.ajax({
          url: "{{ route('search.subject')}}",
          type: "GET",
          data: {
            'search': value,
            '_token': $('input[name=_token]').val()
          },
          success:function(data) {
              $('tbody').html(data);
          }
        });
      })
  </script>
   @endSection
