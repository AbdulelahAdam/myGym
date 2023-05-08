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

    <a href="{{ route('dashboard') }}"><span class="font-bold text-2xl">MyGym</span></a>

    <ul class="flex items-center">


      @auth
      <li>
        <a href="{{ route('register') }}" class="p-3 font-bold">Register Member</a>
      </li>

      <li>
        <form action="{{ route('logout') }}" method="POST" class="p-3 inline font-bold">
          @csrf
          <button type="submit" onclick="return confirm('Are you sure?')">Logout</button>
        </form>
      </li>

      @endauth

      @guest

      <li>
        <a href="{{ route('login') }}" class="p-3 font-bold">Login</a>
      </li>

      @endguest



    </ul>
  </nav>

  @yield('content')


</body>

</html>