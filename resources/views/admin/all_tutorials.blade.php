@extends('admin_layout')

@section('content')


<h1>All Tutorials</h1>

<table class="table table-bordered">
    <tr class="info">
        <th>#</th>
        <th>Title</th>
        <th>Teacher</th>
        <th>Category</th>
        <th>Description</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    @php
    $count = 1;
    @endphp

    @foreach ($tutorials as $pt)
    <tr>
        <td> {{$count++}} </td>
        <td>
            <a style="color:blue;" href="/admin/tutorial/details/{{$pt->id }}"> <b>{{  $pt->title  }} </b> </a>
        </td>
        <td> {{$pt->user->name}} </td>
        <td> {{$pt->category->name}} </td>
        <td> {{$pt->description}} </td>
        <td> {{ $pt->status }} </td>
        <td>

            {!! Form::open(['method' => 'delete', 'action' => ['AdminController@deleteTutorial', $pt->id],
            'files'=> true]) !!}

            <div class="form-group">
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            </div>

            {!! Form::close() !!}

        </td>

    </tr>
    @endforeach

</table>






@include('includes.flash')

@endsection</h1>