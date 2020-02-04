@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                {{-- header --}}
                <div class="card-header">
                    <p style="margin-top:0px;" align='right'>

                        <a href="/teacher-tutorial/upload-video/{{ $tutorial->id }}" type="button"
                            class="btn btn-primary">
                            Upload New Video
                        </a>
                    </p>
                    <img style="margin-top:-70px;" src="{{$tutorial->link}}" alt="" class="img-thumbnail img-responsive"
                        height="200" width="200">
                    <p style="margin-top:10px;">{{ $tutorial->title }}</p>
                    <p><small> {{ $tutorial->description }} </small></p>

                </div>
                {{-- body  --}}
                <div class="card-body">

                    <table class="table table-bordered">
                        <tr class="info">
                            <th>#</th>

                            <th>Tutorial</th>
                            <th>Play</th>

                        </tr>

                        @php
                        $count = 1;
                        @endphp

                        @foreach ($videos as $video)
                        <tr>
                            <td> {{$count++}} </td>
                            <td>{{$video->name}}</td>

                            <td>
                                <video width="250" height="100" controls>
                                    <source src="{{ $video->link }}">
                                </video>
                            </td>
                        </tr>
                        @endforeach

                    </table>

                    {{ $videos->links() }}

                    @if ($tutorial->status == 'created')
                    <p align='right'>

                        {!! Form::open(['method' => 'patch', 'action' => ['TeacherController@publish', $tutorial->id],
                        'files'=> true]) !!}

                        <div class="form-group">
                            {!! Form::submit('Publish', ['class' => 'btn btn-primary']) !!}
                        </div>

                        {!! Form::close() !!}

                    </p>
                    @endif


                </div>

            </div>
        </div>
    </div>
</div>


@endsection