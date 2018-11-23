<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
  <link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
  <title>Angels of de vera</title>
</head>
<body>
<body>
  
  @include('Pages.sidebar')
  @yield('content')





<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript">
  $('nav-item').on('click', 'nav-link', function(){
      $('.nav-item nav-link.active').removeClass('current');
      $(this).addClass('current');
  }); 
</script>
</body>
</html>