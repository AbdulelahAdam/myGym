<title>Extend Member | myGym</title>
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
  <div class="w-4/12 bg-white p-6 rounded-lg mt-6">
    <form action="{{route('profiles.renew', $member)}}" method="POST" class="p-3">
      @csrf
      <div class="mb-4">
        <span class="flex justify-center font-bold text-lg mb-4 text-red-500 ">Renewing {{ $member->name }}'s membership</span>
        <label for="membership" class="sr-only">Membership</label>

        <select name="membership" id="membership" name='membership'
          class="bg-gray-100 border-2 w-full mb-2 p-4 rounded-lg @error('membership') border-red-500 @enderror"
          value="{{old('membership')}}">

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
          <span class="text-red-500 text-sm">A single day of membership is worth 4 EGP</span>
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
        <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Renew
          Membership</button>
      </div>

    </form>
  </div>

</div>


@endsection