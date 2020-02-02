@extends('admin_layout')

@section('content')

<h1>Users</h1>

<table class="table table-bordered">
    <tr class="info">
        <th>#</th>
        <th>Name</th>
        <th>Role</th>
        <th>Email</th>
        <th>Joined</th>
    </tr>

    @php
        $count = 1;
    @endphp

    @foreach ($users as $user)
    <tr>
        <td> {{$count++}} </td>
        <td> {{$user->name}} </td>
        <td> {{$user->role->name}} </td>
        <td> {{$user->email}} </td>
        <td> {{$user->created_at}} </td>
        
    </tr>
    @endforeach

</table>
    
@endsection