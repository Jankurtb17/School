<head>
    <style>
    
    table {
      font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
      margin-right: 40px;
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
    
    .logo {
      background: url("/image/angel.jpg");
    }
    
    </style>
    </head>
    
    
    <body>
    
    <div class="row">
      <div class="heading">
        <h2>Angels of De Vera Learning Center </h4>
        <p>Blk 1 lot 33 phase 2 Molino Homes, <br> Molino, Cavite <br> Jankurt@angelsofdevera.com</p>
        <p>List of teachers</p>
      </div>
      <div class="logo">
      </div>
    </div>
    
    <table class="table">
      <thead >
        <tr>
          <th>Student Id</th>
          <th>Grade Level</th>
          <th>Section</th>
          <th>Name </th>
          <th>Contact Number</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <tbody>
          @foreach ($user_student as $user_students)
              <tr>
                <td>{{ $user_students->student_id}}</td>
                <td>{{ $user_students->gradeLevel}}</td>
                <td>{{ $user_students->className}}</td>
                <td>{{ $user_students->firstName}} {{ $user_students->middleName}} {{ $user_students->lastName}}</td>
                <td>{{ $user_students->phone_number}}</td>
                <td>{{ $user_students->email}}</td>
              </tr>
          @endforeach
        </tbody>
      </tbody>
    </table>
    
    </body>