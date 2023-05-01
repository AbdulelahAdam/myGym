<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index(){
        $members = Member::latest()->paginate(10);
            
        return view('members', [
            'members' => $members,
        ]);
    }

    public function search(Request $request){

            
        return view('dashboard');
    }
}
