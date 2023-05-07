<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        $output = '';

        if ($request->ajax()) {
            $members = Member::where('name', 'LIKE', '%' . $request->search . '%')->get();

            if ($members) {
                $parsedDate = "";
                foreach ($members as $member) {
                    if (Carbon::parse($member->membership_to)->isPast())
                        $parsedDate = '<p class="font-bold text-sm">Expires in: <span class="text-red-500 font-bold text-sm">Expired!!</span></p><hr></div>';
                    else
                        $parsedDate = '<p class="font-bold text-sm">Expires in: <span class="text-red-500 font-bold text-sm">'.Carbon::parse($member->membership_to)->diffForHumans().'</span></p><hr></div>';

                    $output .= '<div class="mb-7">
                    <a href="members/'. $member->name .'">
                      <p class="text-white-500 font-bold text-2xl">'. $member->name .'</p>
                    </a>
                    <p class="text-white-500 font-bold text-sm">Phone Number: '. $member->phone_number .'</p>
                    <p class="text-white-500 font-bold text-sm">Membership Period: '. $member->membership_period .'</p>' . $parsedDate;
                    
                }
                if($output)
                    return response()->json($output);
                    
                return response()->json("No members found");
            }

            return view('members');
        }

        
    
        $members = Member::latest()->paginate(10);

        return view('members', [
            'members' => $members,
        ]);

        
    }
}
