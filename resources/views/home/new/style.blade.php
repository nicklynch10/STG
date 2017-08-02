<style type="text/css">
body::before {
    background-size: cover;
    background-attachment: fixed;
    content: '';
    will-change: transform;
    z-index: -1;
    left: 0;
    right: 0;
    bottom: 0;
    top: 0;
    position: fixed;
}
body::before {
    background-image: url('{{Storage::disk('s3')->url('stock/stock7.jpg')}}');
  }

h3{
  font-family: 'Lato' !important;
}

.bigtitle{
  line-height: 80px;
   font-size: 70px;
   text-shadow: 3px 3px 1px black !important;
   text-align: center;
   width: 100%;
   font-weight: 300;
   font-family: 'Lato';
}

.slideshow{
  background: background-image: url('{{Storage::disk('s3')->url('stock/stock7.jpg')}}');
  height: 500px; 
  width:100%;
}


.demo-blog .coffee-pic .mdl-card__media, .coffee-pic{
  /*background-image: url('{{Storage::disk('s3')->url('stock/stock1.jpg')}}');*/
  background: rgba(0,0,0,.2) !important;
  background: radial-gradient(ellipse, rgba(0,0,0,.3), rgba(0,0,0,.4),rgba(0,0,0,.3),rgba(0,0,0,.01), rgba(0,0,0,0)) !important;
  width: 100%;
  /*rgb(64,196,255);*/
}


.about_tab_button{
  padding: 0px !important;
  margin: 0px !important;
min-width: 100px !important;
font-size: 25px !important;
 line-height: 60px !important;
  height: 60px !important;
   width: 25% !important;
}
</style>