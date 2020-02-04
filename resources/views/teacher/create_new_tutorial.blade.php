@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Create New Tutorial</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @php
                    $user = Auth::user();
                    @endphp

                    {!! Form::open(['method' => 'POST', 'action' => 'TeacherController@save', 'files'=> true]) !!}

                    <div class="form-group">
                        {!! Form::label('title', 'Title') !!}
                        {!! Form::text('title', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('category', 'Category') !!}
                        {!! Form::select('category', ['' => 'Choice Option'] + $categories , ['class' => 'form-control',]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('cover', 'Cover Image:') !!}
                        {!! Form::file('cover', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('desc', 'Description') !!}
                        {!! Form::textarea('desc' , null, ['class' => 'form-control', 'rows'=>'4']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Create', ['class' => 'btn btn-success']) !!}
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection