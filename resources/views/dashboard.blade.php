<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <title>Dashboard - myGym</title>
  <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  </script>
</head>

<body class="bg-neutral-900">

  <nav class="p-6 bg-amber-400 flex justify-between mb-6">
    <ul class="flex items-center">

      <li>
        <a href="{{ route('dashboard') }}" class="p-3">Dashboard</a>
      </li>


    </ul>

    <span class="justify-center font-bold text-2xl">My Gym</span>

    <ul class="flex items-center">


      @auth
      <li>
        <a href="{{ route('register') }}" class="p-3">Register Member</a>
      </li>

      <li>
        <form action="{{ route('logout') }}" method="POST" class="p-3 inline">
          @csrf
          <button type="submit">Logout</button>
        </form>
      </li>

      @endauth

      @guest

      <li>
        <a href="{{ route('login') }}" class="p-3">Login</a>
      </li>

      @endguest



    </ul>
  </nav>

  @yield('content')


</body>

</html>