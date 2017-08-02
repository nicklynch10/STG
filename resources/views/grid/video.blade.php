 					
					@if(isset($video))
 					<video style="width: 100%;" controls>
                      <source src="{{ url($video->url)}}" type="video/mp4">
                      <source src="{{ url($video->url)}}" type="video/ogg">
                    Your browser does not support the video tag.
                    </video>
                    @endif