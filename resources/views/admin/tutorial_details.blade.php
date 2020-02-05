@extends('admin_layout')


@section('content')

<div style="margin-left:30px; margin-top:30px;" class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                {{-- header --}}
                <div class="card-header">
                    <p style="margin-top:0px;" align='right'>

                        <a href="/teacher-tutorial/upload-video/{{ $pt->id }}" type="button" class="btn btn-primary">
                            Upload New Video
                        </a>
                    </p>
                    <img style="margin-top:-70px;" src="{{$pt->link}}" alt="" class="img-thumbnail img-responsive"
                        height="200" width="200">
                    <p style="margin-top:10px;">{{ $pt->title }}</p>
                    <p><small> {{ $pt->description }} </small></p>
                    <p><a href="/admin/tutorial/enroled-students/{{ $pt->id }}" class="btn btn-info">Enroled Students</a></p>

                </div>
                {{-- body  --}}
                <div class="card-body">

                    <table class="table table-bordered">
                        <tr class="info">
                            <th>#</th>

                            <th>Tutorial</th>
                            <th>Play</th>
                            <th>Action</th>
                            {{-- <th>Check Box</th> --}}

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
                            <td>
                                {{-- <a href="/admin/tutorial/delete/{{ $video->id }}" class="btn btn-danger">Delete
                                    Video</a> --}}

                                {!! Form::open(['method' => 'delete', 'action' => ['AdminController@deleteVideo', $video->id],
                                'files'=> true]) !!}

                                <div class="form-group">
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                </div>

                                {!! Form::close() !!}

                            </td>
                        </tr>

                        @endforeach

                    </table>

                    {{ $videos->links() }}

                    @if ($pt->status == 'pending')
                    <p align='right'>

                        {!! Form::open(['method' => 'patch', 'action' => ['AdminController@publish', $pt->id],
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