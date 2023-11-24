<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="icon" href="{{ asset('img/logo-kabbks.png') }}">

  <title>Pendataan Sembako</title>

  @stack('css')

  <!-- CDN Bootstrap Icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


</head>

<body>

  @include('partials.sidebar')

  @include('partials.header')

  @yield('content')
  
  @stack('js')
  
</body>

</html>
