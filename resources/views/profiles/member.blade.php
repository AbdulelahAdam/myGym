@extends('dashboard')

@section('content')

<div>
  <div class="w-full">
    <div class="mt-5">
      <div class="bg-white p-6 rounded-lg mt-6" id="memberNames">
        <div class="mb-7">
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

      </div>
    </div>
  </div>
</div>

@endsection