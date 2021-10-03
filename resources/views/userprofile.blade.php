@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div style="text-align: center; margin-bottom: 10px;" class="card-header">User Profile</div>
                @if(session()->get('message'))
                    <div class="alert alert-success" role="alert">
                        <strong>Success: </strong>{{session()->get('message')}}
                    </div>
                @endif
                <div>
                    <a href="{{route('user.edit')}}">Edit Profile</a>
                    <ul style="list-style-type: none;">
                        <li style=" text-align:  center;">
                        @if( empty(Auth::user()->image))
                                <img src="{{Auth::user()->avatar }}" alt="{{Auth::user()->name}}" style="border: 1px solid #cccccc; border-radius: 5px; width: 100px; height: auto; margin-right: 7px;">
                            @else
                                <img src="../images/{{Auth::user()->image }}" alt="{{Auth::user()->name}}" style="border: 1px solid #cccccc; border-radius: 5px; width: 100px; height: auto; margin-right: 7px;">
                            @endif
                        </li>
                        <li>Name: {{$user->name}}</li>
                        <li>Email: {{$user->email}}</li>
                        <li>Joined In: {{date('d-m-Y', strtotime($user->created_at));}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
