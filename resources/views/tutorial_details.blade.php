@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                {{-- header --}}
                <div class="card-header">

                    <p style="margin-top:10px;" align='right'>
                        @if(!$enrole)
                        <a href="/home/tutorial/purchase/{{ $tutorial->id }}" type="button" class="btn btn-primary">
                            Buy Now
                        </a>
                        @endif
                        @if ($enrole || $owner)
                        <a href="#" type="button" class="btn btn-success">
                            Enroled
                        </a>
                        @endif
                    </p>

                    <img style="margin-top:-70px;" src="{{$tutorial->link}}" alt="" class="img-thumbnail img-responsive"
                        height="200" width="200">
                    <p style="margin-top:10px;">{{ $tutorial->title }}</p>
                    <p>Created By: {{$tutorial->user->name}}</p>
                    <p><small> {{ $tutorial->description }} </small></p>
                    <p><small>{{ $tutorial->category->name }}</small></p>
                    <p>$0.00</p>

                </div>
                {{-- body  --}}
                <div class="card-body">

                    <table class="table table-bordered">
                        <tr class="info">
                            <th>#</th>

                            <th>Tutorial</th>
                            <th>Play</th>
                            {{-- <th>Check Box</th> --}}

                        </tr>

                        @php
                        $count = 1;
                        @endphp

                        @foreach ($videos as $video)
                        <tr>
                            <td> {{$count++}} </td>
                            <td>{{$video->name}}</td>

                            @if ($enrole || $owner)
                            <td>
                                <video width="250" height="100" controls>
                                    <source src="{{ $video->link }}">
                                </video>
                            </td> 
                            @endif

                            @if (!$enrole)
                                <td>Buy to watch</td>
                            @endif
                            

                        </tr>
                        @endforeach

                    </table>

                    {{ $videos->links() }}

                </div>

            </div>
        </div>
    </div>
</div>


@endsection