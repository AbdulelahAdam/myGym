<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Member;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|min:8|max:15',
        ]);

        //dd($request);
        Member::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone,
        ]);

        auth()->attempt($request->only('email', 'phone_number'));

        return redirect()->route('dashboard');
        
    }
}
