<title>{{ $member->name }} - myGym</title>
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
          @if($member->membership_status == "Cancelled")
            <p class="font-bold text-sm">Expires in: <span class="text-red-600 font-bold text-sm">Cancelled!!</span></p>

          @elseif (Carbon\Carbon::parse($member->membership_to)->isPast())
            <p class="font-bold text-sm">Expires in: <span class="text-red-500 font-bold text-sm">Expired!!</span></p>

          @else

            <p class="font-bold text-sm">Expires in: <span class="text-red-500 font-bold text-sm">{{
                Carbon\Carbon::parse($member->membership_to)->diffForHumans() }}</span></p>

          @endif

          <div class="mt-2">
            @if (Carbon\Carbon::parse($member->membership_to)->isPast() || $member->membership_status == "Cancelled")
              <a href="{{ route('profiles.renew', $member) }}">
                <button class="bg-green-500 text-white px-4 py-2 rounded font-medium mt-2">Renew
                  Membership</button>
              </a>

            @else
              <a href="{{ route('profiles.cancel', $member) }}">
                <button class="bg-red-500 text-white px-4 py-2 rounded font-medium mt-2">Cancel
                  Membership</button>
              </a>

            @endif
          </div>

        </div>

      </div>
    </div>
  </div>
</div>

@endsection