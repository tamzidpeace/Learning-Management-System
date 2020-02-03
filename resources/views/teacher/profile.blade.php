@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @php
                    $user = Auth::user();
                    @endphp

                    {!! Form::open(['method' => 'POST', 'action' => 'TeacherController@profileEdit', 'files'=> true]) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('email', 'Email') !!}
                        {!! Form::text('email' , $user->email, ['class' => 'form-control', 'disabled' => 'disabled',]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('expert', 'Expertise') !!}
                        {!! Form::textarea('expert' , $teacher->expert, ['class' => 'form-control', 'rows'=>'2']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('about', 'About') !!}
                        {!! Form::textarea('about' , $teacher->about, ['class' => 'form-control', 'rows'=>'4']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('SAVE', ['class' => 'btn btn-success']) !!}
                    </div>


                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection