<title>Register | MyGym</title>
@extends('dashboard')


@section('content')

<div class="flex justify-center">
  <div class="w-3/12 bg-white p-6 rounded-lg mt-6">
    <form action="{{route('register')}}" method="POST" class="p-3">
      @csrf
      <div class="mb-4">
        <label for="name" class="sr-only">Name</label>
        <input type="text" name="name" id="name" placeholder="Name"
          class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('name') border-red-500 @enderror"
          value="{{old('name')}}">


        @error('name')
        <div class="text-red-500 mt-2 text-sm">
          {{$message}}
        </div>
        @enderror
      </div>

      <div class="mb-4">
        <label for="email" class="sr-only">Email</label>
        <input type="text" name="email" id="email" placeholder="Email"
          class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('email') border-red-500 @enderror"
          value="{{old('email')}}">

        @error('email')
        <div class="text-red-500 mt-2 text-sm">
          {{$message}}
        </div>
        @enderror
      </div>


      <div class="mb-4">
        <label for="phone" class="sr-only">Phone Number</label>
  
        <input type="text" name="phone" id="phone" placeholder="Phone Number"
        class="bg-gray-100 border-2 w-full mb-2 p-4 rounded-lg @error('phone') border-red-500 @enderror"
        value="{{old('phone')}}">

        @error('phone')
        <div class="text-red-500 mt-2 text-sm">
          {{$message}}
        </div>
        @enderror
      </div>

      <div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Register Member</button>
      </div>

    </form>
  </div>

</div>


@endsection