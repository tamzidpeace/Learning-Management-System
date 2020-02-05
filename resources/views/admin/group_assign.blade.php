@extends('admin_layout')

@section('content')

{!! Form::open(['method' => 'post', 'action' => ['AdminController@assignTutorialSave'],
'files'=> true]) !!}

{{ Form::hidden('id', $id) }}

<table class="table table-bordered">
    <tr class="info">
        <th>Select</th>
        <th>Name</th>
    </tr>

    @foreach ($students as $student)
    <tr>

        <td>
            <div class="form-check">
                <input class="form-check-input big-checkbox" name="present[]" type="checkbox" value="{{$student->id}}"
                    id="defaultCheck1">
            </div>
        </td>

        <td>
            {{ $student->name }}
        </td>

    </tr>
    @endforeach
</table>

<div class="form-group">
    {!! Form::submit('Assign', ['class' => 'btn btn-primary']) !!}
</div>

{!! Form::close() !!}

@endsection