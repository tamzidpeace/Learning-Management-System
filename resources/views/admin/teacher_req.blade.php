@extends('admin_layout')

@section('content')

<h1>Teachers Requests</h1>

<table class="table table-bordered">
    <tr class="info">
        <th>#</th>
        <th>Name</th>
        <th>Expertise</th>
        <th>About</th>
        <th>Status</th>
        <th>Action</th>
        <th>Action</th>
    </tr>

    @php
    $count = 1;
    @endphp

    @foreach ($reqs as $req)
    <tr>
        <td> {{$count++}} </td>
        <td> {{$req->name}} </td>
        <td> {{$req->expert}} </td>
        <td> {{$req->about}} </td>
        <td> {{$req->status}} </td>
        <td>
            {{-- accept button --}}
            {!! Form::open(['action' => ['AdminController@accept', $req->id], 'method' =>'patch']) !!}

            <div class="form-group">
                {!! Form::submit('Accept', ['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}

        </td>

        <td>
            {!! Form::open(['action' => ['AdminController@reject', $req->id], 'method' =>'delete']) !!}

            <div class="form-group">
                {!! Form::submit('Reject', ['class' => 'btn btn-danger']) !!}
            </div>

            {!! Form::close() !!}
        </td>

    </tr>
    @endforeach

</table>

@endsection