<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create User
        $user =  User::where('email', 'siamhasan@gmail.com')->first();
        if(is_null($user))
        {
        	$user = new User();
        	$user->name = "Siam Hasan";
        	$user->email = "siamhasan@gmail.com";
        	$user->password = Hash::make('siamhasan');
        	$user->save();
        }
    }
}
