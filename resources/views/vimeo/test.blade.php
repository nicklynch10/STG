@extends('layouts.app')

@section('content')
<div id="player"></div>
{{$vid->vim_id}}
<script src="https://player.vimeo.com/api/player.js"></script>
<script>
    var options = {
        id: "{{$vid->vim_id}}"
    };

    var player = new Vimeo.Player('player', options);

    player.setVolume(0);

    player.on('play', function() {
        console.log('played the video!');
    });

</script>
<a href="{{$vid->download_link_hd}}" download="yourfile.mp4">download me</a>
<a href="{{$vid->download_link_sd}}" download="Your File">download me</a>
@endsection