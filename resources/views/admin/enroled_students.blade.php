@extends('admin_layout')

@section('content')

<h1>Enroled Students</h1>


{!! Form::open(['method' => 'post', 'action' => ['AdminController@groupAssign'], 'files'=> true]) !!}

{{ Form::hidden('students', $students) }}
{{ Form::hidden('tutorial_id', $tutorial->id) }}

<div class="form-group">
    {!! Form::submit('Group Assignment', ['class' => 'btn btn-primary']) !!}
</div>

{!! Form::close() !!}


<table class="table table-bordered">
    <tr class="info">
        <th>#</th>
        <th>Name</th>
        <th>Action</th>
    </tr>

    @php
    $count = 1;
    @endphp

    @foreach ($students as $student)
    <tr>
        <td> {{$count++}} </td>
        <td> {{$student->name}} </td>
        <td>
            {!! Form::open(['method' => 'post', 'action' => ['AdminController@assignTutorial'],
            'files'=> true]) !!}

            {{ Form::hidden('user_id', $student->id) }}
            {{ Form::hidden('tutorial_id', $tutorial->id) }}

            <div class="form-group">
                {!! Form::submit('Assign', ['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </td>

    </tr>
    @endforeach

</table>

@endsection