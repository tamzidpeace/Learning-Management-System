@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-offset-2 col-md-9">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Become A Teacher</h5>

                {!! Form::open(['method' => 'POST', 'action' => 'TeacherController@request', 'files'=> true]) !!}

                <div class="form-group">
                    {!! Form::label('expert', 'Your Expertise Areas') !!}
                    {!! Form::textarea('expert', null, ['class' => 'form-control', 'rows'=>'2']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('about', 'About Yourself') !!}
                    {!! Form::textarea('about' , null, ['class' => 'form-control', 'rows'=>'4']) !!}
                </div>

                
                <div class="form-group">
                    {!! Form::submit('Proceed', ['class' => 'btn btn-primary btn-block']) !!}
                </div>


                {!! Form::close() !!}

            </div>
        </div>


    </div>

</div>


@endsection