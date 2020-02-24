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
                            Upload
                        </a>
                    </p>
                    <img style="margin-top:-70px;" src="{{$tutorial->link}}" alt="" class="img-thumbnail img-responsive"
                        height="200" width="200">
                    <p style="margin-top:10px;">{{ $tutorial->title }}</p>
                    <p><small> {{ $tutorial->description }} </small></p>
                    <a href="/tutorial/details/{{ $tutorial->id }}/sections" type="button"
                        class="btn btn-primary">Sections</a>

                </div>
                {{-- body  --}}
                <div class="card-body">

                    

                        @php
                        $count = 1;
                        @endphp

                        

                        @foreach ($sections as $section)
                        <strong> <p>{{ $section->name }}</p> </strong>
                        
                        

                        @foreach ($videos as $video)

                        @if ($section->id == $video->section_id)

                        <p>{{ $video->name }}</p>
                        @if ($video->video == 'yt')
                        <iframe width="250" height="100" src=" {{ $video->link }} ">
                        </iframe>
                        @elseif($video->video == 'file')
                        
                        <a href=" {{ $video->link }} ">{{ $video->name }} </a>
                        
                        @else
                        <video width="250" height="100" controls>
                            <source src="{{ $video->link }}">
                        </video>
                        @endif
                            
                        @endif
                        
                            

                        @endforeach
                            
                        @endforeach
                        
                            

                        

                        
                        
                        {{-- @for ($i = 0; $i < 3; $i++)
                         
                            <p> sec </p>
                          @foreach ($videos as $video) <tr>
                            @if ( $video->section_id)
                            <td> {{$count++}} </td> <td>{{$video->name}}</td>

                            <td>
                                @if ($video->video == 'yt')
                                <iframe width="250" height="100" src=" {{ $video->link }} ">
                                </iframe>
                                @else
                                <video width="250" height="100" controls>
                                    <source src="{{ $video->link }}">
                                </video>
                                @endif

                            </td>

                            <td> {{ $video->section_id }} </td>
                            @endif

                            </tr>

                            @endforeach

                            @endfor --}}






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