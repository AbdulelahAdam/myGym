<title>Register | MyGym</title>
@extends('dashboard')


@section('content')

<script>
  $(document).ready(function() {
    $("#membershipDays").hide();
    $("#membership").change(function() {
    let selectedVal = $("#membership option:selected").val();
    let dayVal = $("#memberDays").val();
    if(selectedVal === "inputDays") {
      $("#membershipDays").show();
    }
    else{
      $("#membershipDays").hide();
    }
    let subtotal = 0;

    switch(selectedVal){
      case "1 Month":
        subtotal += 400;
        break;
      case "3 Months":
        subtotal += 1000;
        break;
      case "6 Months":
        subtotal += 2000;
        break;
      case "1 Year":
        subtotal += 4000;
        break;
     
      default:
        subtotal = 0;
        break;
    }
    
    $('#subtotal').html(subtotal + " EGP");

  });
});
</script>

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

      <div class="mb-4">
        <label for="membership" class="sr-only">Membership</label>

        <select name="membership" id="membership" name='membership'
          class="bg-gray-100 border-2 w-full mb-2 p-4 rounded-lg @error('phone') border-red-500 @enderror"
          value="{{old('phone')}}">

          <option value="membershipPeriod" selected='true' disabled>Membership Period</option>
          <option value="1 Month">1 month</option>
          <option value="3 Months">3 months</option>
          <option value="6 Months">6 months</option>
          <option value="1 Year">1 year</option>
          <option value="inputDays">Input Days</option>
        </select>

        <div id="membershipDays">
          <label for="memberDays" class="sr-only">Days of Membership </label>
          <input class="bg-gray-100 border-2 w-mid mb-2 p-4 rounded-lg flex justify-center" type="number" name="memberDays" id="memberDays" min="1" max="20" placeholder="Days .."  @error('member_days') border-red-500 @enderror />
          <span class="text-red-500 text-sm">A single day of membership is worth 4EGP</span>
        </div>

        @error('membership')
        <div class="text-red-500 mt-2 text-sm">
          <span>Select a membership period!</span>
        </div>
        @enderror

        @error('member_days')
        <div class="text-red-500 mt-2 text-sm">
          {{ $message }}
        </div>
        @enderror
      </div>


      <div class="mb-4">
        <label for="subtotal" class="font-bold text-2xl">Subtotal: </label>
        <span id="subtotal" name='subtotal' class="text-green-600 font-bold text-2xl">0 EGP</span>

      </div>

      <div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Register
          Member</button>
      </div>

    </form>
  </div>

</div>


@endsection