 
   
    <!-- JavaScripts -->
   
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    
    <div id="snackbar" class="mdl-js-snackbar mdl-snackbar">
  <div class="mdl-snackbar__text"></div>
   <button class="mdl-snackbar__action" type="button"></button>
</div>

      {{--   <div class="mdl-mini-footer android-footer" style="background:#81C784;">
        <div  class="mdl-color-text--grey-900" style="text-align: center; width:100%; font-weight:300; font-size: 16px;" >Swing Tips Golf &copy; 2017</div> 
        </div> --}}
        <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>

        <script src="http://vjs.zencdn.net/5.10.4/video.js"></script>
        <script type="text/javascript">
        	$(".custom_select").select2({
		  maximumSelectionLength: 1,
		  placeholder: 'Search Swing Tips Golf...'
		});
            $('.custom_select').on('select2:opening', function (evt) {
            $('.select2-search__field').off('keydown');
                if($('.select2-search__field').val() && 
                    $('.select2-search__field').val().length > 0 ){
                    //console.log('allow');
                $('.select2-search__field').on('keydown',function(e){
                    //console.log(e.keyCode);
                    if(!$('.select2-search__field').val()||(e.keyCode == 8 && $('.select2-search__field').val().length<2)){
                        //console.log('close');
                        $('.select2-search__field').trigger('click');
                    }
                });
                }else{
                    evt.preventDefault();
                }

                });

            
    		$('.custom_select').on('change',function(){
    			console.log('change');
    			var $this = $(this);
    			console.log($this.val());
    			if($this.val()){
    			window.location.href = $this.val();
    		}
    		});
        var path = window.location.pathname;
        console.log(path);
     // if(path.indexOf('login') != -1){
     //     $('.login').css('border-bottom', '#03A9F4 3px solid');
     // }else if(path.indexOf('logout') != -1){
     //    $('.logout').css('border-bottom', '#03A9F4 3px solid');
     // }else if(path.indexOf('register') != -1){ 
     //    $('.register').css('border-bottom', '#03A9F4 3px solid');
     // }else if(path == '/profile'){
     //    $('.profile').css('border-bottom', '#03A9F4 8px solid');
     // }else if(path == '/notifications'){
     //    $('.notifications').css('border-bottom', '#03A9F4 8px solid');
     // }else if(path == '/dashboard'){
     //    $('.dashboard').css('border-bottom', '#03A9F4 8px solid');
     // }  
        
        // $('video').attr('preload', 'none');
        // $('video').attr('poster', '{{url("/imgs/golf_sunset.png")}}');
        </script>
        </div>
</body>
</html>


