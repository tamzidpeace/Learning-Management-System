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

    @foreach ($students as $student)
    <tr>
        <td> {{$count++}} </td>
        <td> {{$student->name}} </td>
        <td> {{$student->role->name}} </td>
        <td> {{$student->email}} </td>
        <td> {{$student->created_at}} </td>
        
    </tr>
    @endforeach

</table>
    
@endsection