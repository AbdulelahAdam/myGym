<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use PhpParser\Node\Scalar\String_;
use Psy\Util\Str;


class RegisterController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    public function store(Request $request){
        $membershipPeriod = null;
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|min:8|max:15',
            'membership' => 'required',
            'memberDays' => 'min:1|max:20',
        ]);

        //dd($request);

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
               
                $request->membership = ($request->memberDays . " Days");
                break;
        }

        Member::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'membership_period' => $request->membership,
            'membership_from' => Carbon::now(),
            'membership_to' => $membershipPeriod,
        ]);

        auth()->attempt($request->only('email', 'phone_number'));

        return redirect()->route('dashboard');
        
    }
}
