@extends('layouts.app')

@section('content')

<div class="mdl-card__title mdl-color-text--red-400 special_accent">
    <h2 class="mdl-card__title-text">Join Swing Tips Golf</h2>
  </div>
                    <form role="form" method="POST" class="mdl-cell mdl-cell--12-col " action="{{ url('/register/save') }}">
                        {{ csrf_field() }}

                        @include('auth.shared_register')       
<div class="mdl-cell--12-col" style="background: white; width: 100%; box-shadow: 0px 1px 1px black; padding: 30px 0px;">
<button type="submit" style="font-size: 25px; line-height: 25px; padding: 0px 0px;" class="form_submit onlynonpro mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-cell--6-col">
      Sign Up!
    </button>
</div>
<script type="text/javascript">
    $('.address_title').text('Address You Would Like Lessons Near');
</script>
@endsection
