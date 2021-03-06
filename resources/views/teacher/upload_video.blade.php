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

                    {!! Form::open(['method' => 'POST', 'action' => ['TeacherController@upload', $tutorial->id], 'files'=> true]) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('video', 'Video/File') !!}
                        {!! Form::file('video', null, ['class' => 'form-control']) !!}
                    </div>
                    <p>or</p>
                    <div class="form-group">
                        {!! Form::label('video_link', 'Video Link') !!}
                        {!! Form::text('video_link', null, ['class' => 'form-control']) !!}
                    </div>

                    

                    <div class="form-group">
                        {!! Form::label('section', 'Section') !!}
                        {!! Form::select('section', ['' => 'Choice Option'] + $sections , ['class' => 'form-control',]) !!}
                    </div>


                    <div class="form-group">
                        {!! Form::submit('Upload', ['class' => 'btn btn-success']) !!}
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection