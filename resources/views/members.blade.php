@extends('dashboard')

@section('content')

<div class="flex justify-center">
  <div class="w-8/12">
    <div class="flex justify-center mt-5 ">
      <input id="search" name="search"
        class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        type="search" placeholder="Search..." />
    </div>
    <div class="bg-white p-6 rounded-lg mt-6" id="memberNames">
      @if ($members->count())
      @foreach ($members as $member)
      <div class="mb-7">
        <a href="{{ route('profiles.member', $member) }}">
          <p class="text-white-500 font-bold text-2xl inline">{{ $member->name }}</p>
        </a>
        <p class="text-white-500 font-bold text-sm">Phone Number: {{ $member->phone_number }}</p>
        <p class="text-white-500 font-bold text-sm">Membership Period: {{ $member->membership_period }}</p> 
        @if($member->membership_status == "Cancelled")
          <p class="font-bold text-sm">Expires in: <span class="text-red-600 font-bold text-sm">Cancelled!!</span></p>

        @elseif (Carbon\Carbon::parse($member->membership_to)->isPast())
          <p class="font-bold text-sm">Expires in: <span class="text-red-600 font-bold text-sm">Expired!!</span></p>

        @else
          <p class="font-bold text-sm">Expires in: <span class="text-green-600 font-bold text-sm">{{
            Carbon\Carbon::parse($member->membership_to)->diffForHumans() }}</span></p>          
        @endif
        
        
        <hr>
      </div>
      @endforeach

      @else
      <p class="text-white-500">There are no members registered in this gym!</p>
      @endif

      {{ $members->links() }}
    </div>
  </div>
</div>


<script>
  $(document).ready(function(){
    $('#search').on('keyup', function(){
      let value = $(this).val();

      $.ajax({
        type: 'GET',
        url: "/",
        data: {'search': value},
        success: function(data){
          $('#memberNames').html(data);
        }

      });


    });
  });
</script>

@endsection