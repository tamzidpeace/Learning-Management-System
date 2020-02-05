@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Checkout</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <p>Price: $0.00</p>
                    <p>Total: $0.00</p>

                    {!! Form::open(['method' => 'post',
                    'action' => ['HomeController@purchaseNenrole'], 'files'=> true]) !!}

                    {{ Form::hidden('user_id', $user->id) }}
                    {{ Form::hidden('tutorial_id', $id) }}
                    <div class="form-group">
                        {!! Form::submit('Buy & Enrole', ['class' => 'btn btn-success']) !!}
                    </div>

                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>
</div>

@endsection