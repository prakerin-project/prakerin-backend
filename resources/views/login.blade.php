<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  <link rel="icon" href="{{asset('logo.svg')}}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Akshar&family=Bitter&display=swap" rel="stylesheet">

  <style>
    body {
      background-repeat: no-repeat;
      background-size: cover;
      background-image: url({{ asset('bg.png') }});
    }

    .form-cover {
      background-color: rgba(236, 247, 255, 0.75);
      position: absolute;
      top: 50%;
      left: 50%;
      color: #006FEE;
      transform: translate(-50%, -50%);
      width: 800px;
      height: 500px;
      border-radius: 10px;
      font-family: 'Akshar', sans-serif;
    }
    
    .form-cover h1 {
      font-size: 50px;
      font-weight: 300;
    }
  </style>

  <!-- Scripts -->
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>
<body>
  <div class="form-cover">
    <h1>Login</h1>
    <form id="tambah-ps-form" enctype="multipart/form-data">
          <label for="username">Username</label>
          <input type="text" id="username" class="form-control mb-3"
                 autofocus
                 name="username"
                 required/>
          @csrf
  </form>
  </div>
</body>
</html>