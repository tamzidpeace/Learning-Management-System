@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Latest Tutorial</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <table class="table table-bordered">
                        <tr class="info">
                            <th>#</th>
                            <th>Name</th>
                            
                        </tr>
                    
                        @php
                            $count = 1;
                        @endphp
                    
                        @foreach ($tutorials as $tutorial)
                        <tr>
                            <td> {{$count++}} </td>
                            <td>
                                 <a href="/teacher/tutorials/details/{{$tutorial->id}}">{{$tutorial->title}}</a>
                             </td>
                            
                        </tr>
                        @endforeach
                    
                    </table>                    

                    <a href="/lms/be_a_teacher">Become a Teacher</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
