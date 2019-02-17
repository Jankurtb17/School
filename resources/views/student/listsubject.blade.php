@extends('layouts.teacher')

@section('content')
        <div class="content">
          <div class="sidebar-content">
          </div>
          <div class="card" id="card-subjectgrade">
            <div class="card-body">
              <div class="title">
                <h1>List of Subjects</h1>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <ion-icon name="speedometer" id="dashboard-icon"> </ion-icon> <a href="/dashboard">Dashboard </a></li>
                    <li class="breadcrumb-item active" aria-current="page">List of Subject</li>
                  </ol>
                </nav>
              </div>
           
                <div class="table-wrapper-scroll-y">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Level</th>
                        <th>Subject Code</th>
                        <th>Subject Description</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                      <td colspan="4" id="level"><strong>GRADE 1 </strong></td>
                      @foreach ($grade1 as $grade1s)
                        <tr>
                          <td></td>
                          <td>{{ $grade1s->subjectCode}}</td>
                          <td>{{ $grade1s->description}}</td>
                        </tr>
                      @endforeach
                      </tr>
                      <tr>
                      <td colspan="4" id="level"><strong>GRADE 2 </strong></td>
                      @foreach ($grade2 as $grade2s)
                        <tr>
                          <td></td>
                          <td>{{ $grade2s->subjectCode}}</td>
                          <td>{{ $grade2s->description}}</td>
                        </tr>
                      @endforeach
                    </tr>
                    <tr>
                    <td colspan="4" id="level"> <strong> GRADE 3 </strong></td>
                    @foreach ($grade3 as $grade3e)
                    <tr>
                      <td></td>
                      <td>{{ $grade3e->subjectCode}}</td>
                      <td>{{ $grade3e->description}}</td>
                    </tr>
                  @endforeach
                </tr>
                <tr>
                    <td colspan="4" id="level"><strong>GRADE 4 </strong></td>
                    @foreach ($grade4 as $grade4f)
                    <tr>
                      <td></td>
                      <td>{{ $grade4f->subjectCode}}</td>
                      <td>{{ $grade4f->description}}</td>
                    </tr>
                  @endforeach
                </tr>
                <tr>
                    <td colspan="4" id="level"><strong>GRADE 5 </strong></td>
                    @foreach ($grade5 as $grade5g)
                    <tr>
                      <td></td>
                      <td>{{ $grade5g->subjectCode}}</td>
                      <td>{{ $grade5g->description}}</td>
                    </tr>
                  @endforeach
                </tr>
                <tr>
                    <td colspan="4" id="level"><strong>GRADE 6 </strong></td>
                    @foreach ($grade6 as $grade6h)
                    <tr>
                      <td></td>
                      <td>{{ $grade6h->subjectCode}}</td>
                      <td>{{ $grade6h->description}}</td>
                    </tr>
                  @endforeach
                </tr>
                    </tbody>
                  </table>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  @endSection
  @section('scripts')
  @endSection