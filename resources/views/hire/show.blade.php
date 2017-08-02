
@extends('layouts.app')
@section('content')
{{ csrf_field() }}
      @include('grid.top',["title"=>"Define your typical miss?"])

        {{$hire->field1}}
        <br>
        {{$hire->field2}}

        @include('grid.bottom')


    
    @include('grid.top',["title"=>"Anything else you would like to say","size"=>"6"])
    {{$hire->field3  or ""}}
    @include('grid.bottom')
                
                  
                    @foreach($videos as $key=>$video)
                    @if($video->user_id == $other->id)
                    @include('grid.video_format',['video'=>$video])
                    @endif
                    @endforeach

        @include('grid.top',["title"=>"Analysis of game"])
       {{$hire->field4}}
        @include('grid.bottom')

          @include('grid.top',["title"=>"How to improve"])
       {{$hire->field5}}
        @include('grid.bottom')

                    @foreach($videos as $key=>$video)
                    @if($video->user_id != $other->id)
                    @include('grid.video_format',['video'=>$video])
                    @endif
                    @endforeach
    
    @include('hire.style') 
@stop
