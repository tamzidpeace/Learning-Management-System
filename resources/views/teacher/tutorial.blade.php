@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                {{-- header --}}
                <div class="card-header">
                    Tutorials
                    <p style="margin-top:-30px;" align='right'>
                        <a href="/teacher-tutorial/create-new" type="button" class="btn btn-primary">Create New
                            Tutorial</a>
                    </p>
                </div>
                {{-- body  --}}
                <div class="card-body">

                    <table class="table table-bordered">
                        <tr class="info">
                            <th>#</th>
                            <th>Title</th>
                            <th>About</th>
                            <th>Status</th>


                        </tr>

                        @php
                        $count = 1;
                        @endphp

                        @foreach ($tutorials as $tu)
                        <tr>
                            <td> {{$count++}} </td>
                            <td> 
                                <a href="#">{{$tu->title}}</a>
                             </td>
                            <td> {{$tu->description  }} </td>
                            <td> {{ $tu->status }} </td>
                        </tr>
                        @endforeach

                    </table>


                </div>

            </div>
        </div>
    </div>
</div>


@endsection