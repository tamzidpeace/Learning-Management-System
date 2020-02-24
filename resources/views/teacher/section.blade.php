@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                {{-- header --}}
                <div class="card-header">

                    {!! Form::open(['method' => 'POST', 'action' => 'TeacherController@addSection', 'files'=> true]) !!}
                    <strong><p>Add new Section</p></strong>
                    <div style="margin-top:15px;" class="form-group">
                        {!! Form::label('name', 'Section Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>

                    <div style="margin-top:15px;" class="form-group">
                        {!! Form::label('serial', 'Serial') !!}
                        {!! Form::number('serial', 0, ['class' => 'form-control']) !!}
                    </div>

                    {{ Form::hidden('tutorial_id', $tutorial->id) }}

                    <div class="form-group">
                        {!! Form::submit('SAVE', ['class' => 'btn btn-success']) !!}
                    </div>

                    {!! Form::close() !!}

                    <hr>

                    <Strong>  Sections of {{ $tutorial->title }} </Strong> 

                </div>
                {{-- body  --}}
                <div class="card-body">

                    <table class="table table-bordered">
                        <tr class="info">
                            <th>#</th>

                            <th>Section</th>
                            <th>Serial No</th>
                            {{-- <th>Check Box</th> --}}

                        </tr>

                        @php
                        $count = 1;
                        @endphp

                        @foreach ($sections as $section)
                         <tr>
                            <td> {{$count++}} </td>
                        <td>{{$section->name}}</td>

                        <td>
                            {{ $section->serial_no }}
                        </td>

                        </tr>
                        @endforeach

                    </table>

                </div>

            </div>
        </div>
    </div>
</div>


@endsection