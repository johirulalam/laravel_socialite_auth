<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

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

    //user Profile Edit
    public function EditProfile()
    {
        $data = [];
        $data['user'] = Auth::user();
        return view('edituser', $data);
    }

    public function UpdateProfile(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,id,:id',           
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
         if ($validator ->fails()) 
        {
            return redirect()
                        ->back()
                        ->withErrors($validator )
                        ->withInput();
        }

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('/user/profile')->with('message', 'Profile Updated');
        
    }


    public function EditProfileByAdmin($email)
    {
        $data = [];
        $data['user'] = User::where('email', $email)->first();
        return view('edituserbyadmin', $data);
    }

    public function UpdateProfileByAdmin(Request $request, $email)
    {
        if (Auth::user()->role==99) {
                $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,id,:id',
            ]);
            if ($validator ->fails()) 
            {
                return redirect()
                            ->back()
                            ->withErrors($validator )
                            ->withInput();
            }

            $user = User::where('email', $email)->first();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            return redirect()->back()->with('message', 'User Profile Updated');
        }
        
    }
}
