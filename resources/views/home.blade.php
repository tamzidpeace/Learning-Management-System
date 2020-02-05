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
                    
                    @foreach ($tutorials as $tutorial)
                    <div>
                       

                        <li class="list-group-item">
                            <div class="">
                                <img style="height:250px; width:500px;" class="img-thumbnail"
                                    src="{{ $tutorial->link }} " alt="">
                            </div>

                            <div class="">
                                <a href="/home/tutorial/details/{{ $tutorial->id }}">
                                    <h3> {{$tutorial->title}} </h3>
                                </a>
                                <h5> By: {{$tutorial->user->name}} </h4>
                                <h6>  {{$tutorial->description}} </h4>
                                <h6> {{ $tutorial->category->name }} </h6>
                                <h5>   $0.00</h5>
                            </div>
                        </li>

                    </div>
                    @endforeach                    

                    <a href="/lms/be_a_teacher">Become a Teacher</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
