<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Member $member){
        
        return view('profiles.member',[
            'member' => $member,
        ]
    );
    }

    public function renew(Member $member){
        
        return view('profiles.renew',[
            'member' => $member,
        ]
    );
    }

    public function cancel(Member $member){
        
        return view('profiles.cancel',[
            'member' => $member,
        ]
    );
    }

    
    public function store(Request $request, Member $member){

        $this->validate($request, [
            'membership' => 'required'
        ]);
        
        $membershipPeriod = null;

        switch($request->membership){
            case "1 Month":
                $membershipPeriod = Carbon::now()->addMonth();
                break;

            case "3 Months":
                $membershipPeriod = Carbon::now()->addMonths(3);
                break;

            case "6 Months":
                $membershipPeriod = Carbon::now()->addMonths(6);
                break;

            case "1 Year":
                $membershipPeriod = Carbon::now()->addYear();
                break;

            case "inputDays":
                $membershipPeriod = Carbon::now()->addDays($request->memberDays);
               
                $request->membership = ($request->memberDays . " Day(s)");
                break;
        }

        $member->update([
            'membership_period' => $request->membership,
            'membership_from' => Carbon::now(),
            'membership_to' => $membershipPeriod,
            'membership_status' => null,
        ]);


        return redirect()->route('dashboard');
        
    }


    public function remove(Request $request, Member $member){
        
        $member->update([
            'membership_status' => "Cancelled",
        ]);

        return redirect()->route('dashboard');
    }
}
