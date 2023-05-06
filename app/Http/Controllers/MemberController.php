<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function index(Member $member){
        
        return view('profiles.member',[
            'member' => $member,
        ]
    );
    }
}
