 				@foreach($user->video as $video)
 				@if(isset($video->title))
                     @include('grid.top',["title"=>$video->title, "size"=>6])
                @else
                 @include('grid.top',["size"=>6])
                @endif
                    @include('grid.video',['video'=>$video])
                        {{$video->description}}
                        {{$display or ""}}
                      @include('grid.bottom')
                

                    @endforeach