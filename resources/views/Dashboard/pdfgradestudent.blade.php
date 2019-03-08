<head>
    <style>
      *,
      *::before,
      *::after {
          box-sizing: border-box;
      }
      body {
        margin: 0;
        padding: 0;
      }
      table {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        margin: 10px 0 0 0px;
        width: 100vw;
       
      }
      th, td {
        border: 1px solid black;
        padding: 7px;
      }
      th {
        width:100px;
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
      }
      
      h2 {
        font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
      }
      .row {
        display: flex;
        flex-direction: row;
      }
      
      
    </style>
  </head>
      
      
      <body>
      
      <div class="row">
        <div class="heading">
          <h2>Angels of De Vera Learning Center </h4>
          <p>Blk 1 lot 33 phase 2 Molino Homes, <br> Molino, Cavite <br> Jankurt@angelsofdevera.com</p>
          <p>Grades Encoded</p>
        </div>
        <div class="logo">
        </div>
      </div>
      
      <table class="table">
        <thead >
          <tr>
            <th>Subject Code</th>
            <th>Description</th>
            <th>Grading Period</th>
            <th>Grade</th>
            <th>Teacher Name</th>
            
          </tr>
        </thead>
        <tbody>
          <tbody>
            @foreach ($grades as $grade)
              <tr>
                <td>{{ $grade->subjectCode }}</td>
                <td>{{ $grade->description }}</td>
                <td>{{ $grade->gradingperiod }}</td>
                <td>{{ $grade->grade }}</td>
                <td>{{ $grade->firstName }} {{ $grade->middleName }} {{ $grade->lastName }}</td>
              </tr>
            @endforeach
          </tbody>
        </tbody>
      </table>
      
      </body>