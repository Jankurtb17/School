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
                        <th></th>
                        <th>Subject Code</th>
                        <th>Subject Description</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                      @foreach ($subjects as $subject)
                        <tr>
                          <td></td>
                          <td>{{ $subject->subjectCode}}</td>
                          <td>{{ $subject->description}}</td>
                        </tr>
                      @endforeach
                      </tr>
                      <tr>
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