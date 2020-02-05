@extends('admin_layout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div style="margin-left:20px;" class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @php
                    $user = Auth::user();
                    @endphp

                    {!! Form::open(['method' => 'POST', 'action' => 'AdminController@addCategory', 'files'=> true]) !!}

                    <div style="margin-top:15px;"class="form-group">
                        {!! Form::label('name', 'Category') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('SAVE', ['class' => 'btn btn-success']) !!}
                    </div>

                    {!! Form::close() !!}

                    

                    <table class="table table-bordered">
                        <tr class="info">
                            <th>#</th>
                            <th>Name</th>
                            
                        </tr>

                        @php
                        $count = 1;
                        @endphp

                        @foreach ($categories as $category)
                        <tr>
                            <td> {{$count++}} </td>
                            <td> {{$category->name}} </td>
                        </tr>
                        @endforeach

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection