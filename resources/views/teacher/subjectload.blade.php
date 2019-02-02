@extends('layouts.admin')

@section('content')
  @include('Pages.sidebar')
  @can('isTeacher')
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
              <input type="text" name= "search" class="form-control col-lg-2 float-left mb-2" id="search" placeholder="Search">
              @if(session()->has('notif'))
              <div class="row float-right mr-2">
                <div class="alert alert-success" role="alert">
                    <button class="close" aria-hidden="true" data-dismiss="alert">&times; </button>
                    <strong>Grade</strong> {{session()->get('notif')}}
                </div>
              </div>
              @endif
           </div>

           <div class="form-group">
            @if(session()->has('error'))
            <div class="row float-right mr-2">
              <div class="alert alert-danger" role="alert">
                  <button class="close" aria-hidden="true" data-dismiss="alert">&times; </button>
                  <strong>Grade</strong> {{session()->get('error')}}
              </div>
            </div>
            @endif
          </div>

          <div class="form-group">
            @if(count($errors))
            <div class="row float-right mr-2">
              <div class="alert alert-danger" role="alert">
                  <button class="close" aria-hidden="true" data-dismiss="alert">&times; </button>
                  @foreach ($errors->all() as $error)
                      <li> {{ $error }} </li>
                  @endforeach
              </div>
            </div>
            @endif
          </div>

            <div class="table-responsive mt-3">
              <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>School Year</th>
                      <th>Grade Level</th>
                      <th>Class Name</th>
                    </tr> 
                  </thead>

                  <tbody id="tbody">
                    @foreach ($advisory as $advisories)
                        <tr class="post{{ $advisories->id}}">
                          <td>{{$advisories->id}}</td>
                          <td>{{$advisories->schoolYear}}</td>
                          <td>{{$advisories->gradeLevel }}</td>
                          <td><a href="/studentgrades/{{$advisories->gradeLevel}}/{{$advisories->className }}">{{$advisories->className }}</a></td>
                        </tr>
                    @endforeach
                  </tbody>
              </table>
            </div>


            <div class="mt-2">
              {{-- {{ $advisory->links() }} --}}
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
   @endCan
