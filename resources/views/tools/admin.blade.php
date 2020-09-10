@extends('layouts.master')

@section('content')
<div class="row">
      <div class="col">
        <h4>Users and assigned permissions</h4>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                      <th>Id</th>
                       <th>Name</th>
                       <th>Email</th>
                       <th>Status</th>
                       <th>User</th>
                       <th>Admin</th>
                       <th>Action</th>
                     </tr>
             </thead>
             <tbody>
                 @foreach( $users as $user )
                 <tr>
                   <form action="{{route('tools_assign')}}" method="post">
                   <td>{{ $user->id }}</td>
                   <td>{{ $user->name}} </td>
                   <td>{{ $user->email }} <input type="hidden" name="email" value="{{$user->email}}"></td>
                   <td>
                     @if ($user->isOnline())
                    <strong>Online</strong>
                     @else
                     Offline
                     @endif
                   </td>
                   <td><input type="checkbox" {{ $user->hasRole('User') ? 'checked' : '' }} name="role_user"> </td>
                   <td><input type="checkbox" {{ $user->hasRole('Admin') ? 'checked' : '' }} name="role_admin"></td>
                   {{ csrf_field() }}
                   <td><button type="submit" class="btn btn-outline-primary btn-sm">Assign</button></td>
                 </form>
                 </tr>

                 @endforeach
              </tbody>
          </table>
      </div>
</div>
@endsection
