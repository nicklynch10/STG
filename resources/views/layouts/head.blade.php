<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Swing Tips Golf</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,200,300,400,500,600,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.green-light_blue.min.css" />
    <!-- <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-light_blue.min.css" /> -->
    <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <script src="https://player.vimeo.com/api/player.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
     {{-- <link href="http://vjs.zencdn.net/5.10.4/video-js.css" rel="stylesheet">

  If you'd like to support IE8 --}}
 {{--  <script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script> --}}
  
<meta name="mobile-web-app-capable" content="yes">
    <link rel='shortcut icon' href='{{Storage::disk('s3')->url('layout/logo.png')}}' type='image/png'/ >

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">
    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">


    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,200,300,400,500,600,700,800,900">
   
    <!-- Styles -->
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
@include('layouts.style')
  <script type="text/javascript">
  /**
 * You first need to create a formatting function to pad numbers to two digits…
 **/
function twoDigits(d) {
    if(0 <= d && d < 10) return "0" + d.toString();
    if(-10 < d && d < 0) return "-0" + (-1*d).toString();
    return d.toString();
}

/**
 * …and then create the method to output the date string as desired.
 * Some people hate using prototypes this way, but if you are going
 * to apply this to more than one Date object, having it as a prototype
 * makes sense.
 **/
function toMysqlFormat(date) {
    return date.getFullYear() + "-" + twoDigits(1 + date.getMonth()) + "-" + twoDigits(date.getDate()) + " " + twoDigits(date.getHours()) + ":" + twoDigits(date.getMinutes()) + ":" + twoDigits('00');
};
    function tooltip(message){
       var snackbarContainer = document.querySelector('#snackbar');
       snackbarContainer.MaterialSnackbar.showSnackbar({message:message});
    }

    function round5(x)
{
    return Math.round(x/5)*5;
}
function toTimeFormat(x){
  if(x == 0)return "12:00 AM";
  if(x < 1)return"12:30 AM";
  if(x == 12)return "12:00 PM";
  if(x > 12 && x < 13)return"12:30 PM";
  if(x >= 13){
    return addThirty(x-12) + " PM";
  }
    return addThirty(x) + " AM";
}
function addThirty(x){
  if(x%1 == 0) return x+":00";
  return Math.round(x-.5)+":30";
}
</script>

</head>