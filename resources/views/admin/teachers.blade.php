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

    @foreach ($teachers as $teacher)
    <tr>
        <td> {{$count++}} </td>
        <td> {{$teacher->name}} </td>
        <td> {{$teacher->role->name}} </td>
        <td> {{$teacher->email}} </td>
        <td> {{$teacher->created_at}} </td>
        
    </tr>
    @endforeach

</table>
    
@endsection