@extends('admin_layout')

@section('content')


<h1>Pending Tutorials</h1>

<table class="table table-bordered">
    <tr class="info">
        <th>#</th>
        <th>Title</th>
        <th>Teacher</th>
        <th>Category</th>
        <th>Description</th>
    </tr>

    @php
        $count = 1;
    @endphp

    @foreach ($pts as $pt)
    <tr>
        <td> {{$count++}} </td>
        <td> 
        <a style="color:blue;" href="/admin/tutorial/details/{{$pt->id }}"> <b>{{  $pt->title  }} </b>  </a>
        </td>
        <td> {{$pt->user->name}} </td>
        <td> {{$pt->category->name}} </td>
        <td> {{$pt->description}} </td>
        
    </tr>
    @endforeach

</table>






@include('includes.flash')
    
@endsection