<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class GuestController extends Controller
{
    //

    public function userlist()
    {
    	$data = [];
        $data['users'] = User::where('role', 1)->get();
        return view('userlist', $data);
    }
}
