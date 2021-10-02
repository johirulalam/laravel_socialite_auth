<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    //User Profile
    public function UserProfile(Request $request)
    {
    	$data = [];
    	$data['user'] = Auth::user();
    	//dd($data);
    	return view('userprofile', $data);
    }
}
