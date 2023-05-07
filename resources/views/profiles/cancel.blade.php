<title>Cancel Membership | myGym</title>
@extends('dashboard')


@section('content')


<div class="flex justify-center">
  <div class="w-4/12 bg-white p-6 rounded-lg mt-6">
    <form action="{{route('profiles.cancel', $member)}}" method="POST" class="p-3">
      @csrf
      <div class="mb-4">
        <span class="flex justify-center font-bold text-lg mb-4 text-red-500 ">Canceling {{ $member->name }}'s membership</span>
        <p class="text-white-500 font-bold text-2xl">{{ $member->name }}</p>
          <p class="text-white-500 font-bold text-sm">Phone Number: {{ $member->phone_number }}</p>
          <p class="text-white-500 font-bold text-sm">Membership Period: {{ $member->membership_period }}</p>

          @if (Carbon\Carbon::parse($member->membership_to)->isPast())
          <p class="font-bold text-sm">Expires in: <span class="text-red-500 font-bold text-sm">Expired!!</span></p>

          @else

          <p class="font-bold text-sm">Expires in: <span class="text-red-500 font-bold text-sm">{{
              Carbon\Carbon::parse($member->membership_to)->diffForHumans() }}</span></p>

          @endif
      </div>
      <div>
        <button type="submit" class="bg-red-500 text-white px-4 py-3 rounded font-medium w-full">Cancel
          Membership</button>
      </div>

    </form>
  </div>

</div>


@endsection