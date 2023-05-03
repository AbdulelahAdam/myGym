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
        <p class="text-white-500 font-bold text-2xl">{{ $member->name }}</p>
        <p class="text-white-500 font-bold text-sm">Phone Number: {{ $member->phone_number }}</p>
        <p class="text-white-500 font-bold text-sm">Membership Period: {{ $member->membership_period }}</p> 
        <p class="font-bold text-sm">Expires in: <span class="text-red-500 font-bold text-sm">{{ $member->membership_to }}</span></p> 
        
        
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