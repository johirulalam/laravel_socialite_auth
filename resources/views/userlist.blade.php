@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div style="text-align: center; margin-bottom: 10px;" class="card-header">User List</div>
                <div>
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">User Name</th>
                          <th scope="col">User Email</th>
                          <th scope="col">Joined Date</th>
                          @auth              
                          <th scope="col">Action</th>
                          @endauth

                        </tr>
                      </thead>
                      <tbody>
                        <?php $cnt = 1;?>

                        @foreach($users as $user)
                        
                        <tr>
                        <td>{{$cnt++}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{date('d-m-Y', strtotime($user->created_at));}}</td>
                        @auth
                        @if(Auth::User()->role==99 || Auth::user()->email==$user->email)
                        <td>
                            <a href="{{route('admin.edit.user', $user->email)}}" class="btn btn-sm btn-info">Edit</a>
                        </td>
                        @endif
                        @endauth
                        </tr>

                        @endForeach
                        
                      </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
