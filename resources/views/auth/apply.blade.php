@extends('layouts.app')

@section('content')
<div class="mdl-cell mdl-cell--12-col mdl-color--light-blue-50 mdl-card mdl-shadow--2dp">
<div class="mdl-card__title mdl-color-text--red-400 special_accent">
    <h2 class="mdl-card__title-text">Become a Swing Tips Golf Pro!</h2>
  </div>
                    <form role="form" method="POST" action="{{ url('/apply') }}">
                        {{ csrf_field() }}

                        @include('auth.shared_register')

                    <div class="input" style="display:block;">
                    <div style="width:100%;">
                    <div class="input_label">Years as a Pro</div>
                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input"  value="{{ old('yoe') }}" type="number" min="0" name="yoe" id="yoe">
                                <label class="mdl-textfield__label" for="yoe">Years of Experience</label>
                         </div>
                         </div>
                         <div style="width:90%;">
                    <div class="input_label">Link to your Website</div>
                         <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input"  value="{{ old('website') }}" type="text" name="website" id="website" >
                                <label class="mdl-textfield__label" for="website">Website</label>
                         </div>
                         </div>
                    </div>{{-- end .input --}}

                    <div class="input">
                    <div class="input_label">Experience as a Pro</div>
                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            @if(old('experience'))
                            <textarea class="mdl-textfield__input" name="experience" id="experience" required>
                                {{ old('experience') }}
                                </textarea>
                            @else
                            <textarea class="mdl-textfield__input" name="experience" id="experience" required></textarea>
                            @endif

                                <label class="mdl-textfield__label" for="experience">Experience</label>
                         </div>
                    </div>
                    {{-- end .input --}}
                    {{-- <div class="input">
                    <div class="input_label">Why would you like to be a pro at Swingtips?</div>
                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <textarea class="mdl-textfield__input" name="why" id="why" required>{{ old('why') }}</textarea>
                                <label class="mdl-textfield__label" for="why">Why Swingtips?</label>
                         </div>
                    </div> --}}

                    {{-- end .input --}} 

                    <div class="input" style="display:block;">
                         <div style="width:100%; margin-left:15px;">
                        <input type="hidden" name="accepts_lessons" value="1">
                    <div class="input_label">Accept Student SwingTips?
                    <br><br>
                    <span style="font-size:14px;">Swing Tips Golf has a feature called a Swing Tip, where a student will video there swing from 1 or 2 different angles and you, as a pro will dissect that swing and provide voiceover, all for a fee you can set.</span>
                    </div>
                         <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                 <select style="" required id='accepts_swingtips' class="accepts_swingtips" name="accepts_swingtips">
                                <option value="1" selected>Yes</option>
                                <option value="0">Not Now</option>
                                 </select>
                         </div>
                         </div>
                    </div>{{-- end .input --}}

                    <div class="input software_input">
                    <div class="input_label">Name of the software you are using for Swing Tip Video Lessons
                    <br><br>
                    <span style="font-size:14px;">To accept Swing Tips, a software package is required that must have, as a minimum, a voice over feature with drawing tools and basic exporting capabilities. However it is highly recomended that the software have side by side comparison capabilities. We encourage Swing Tips Pros to use the best softwares in the market, so they cn get better ratings and charge more.</span></div>
                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" name="software" type="text" id="software" value="{{ old('software') }}">
                                <label class="mdl-textfield__label" for="software">Name of Software</label>
                         </div>
                    </div>{{-- end .input --}} 
            <div class="input">
                <button type="submit" style="margin:auto;" class="mdl-button mdl-js-button mdl-button--raised mdl-color--green-400 mdl-color-text--grey-50 form_submit">
                    Continue Registration
                </button>
            </div>
                            
</div>
<script type="text/javascript">
    $('#accepts_swingtips, #accepts_lessons').select2();
    $('#accepts_swingtips').on('change', function(event) {
    if($('#accepts_swingtips option:selected').val() == '0')
        $('.software_input').hide();
    else $('.software_input').show();
    });

    $('.onlynonpro').hide();
</script>
@endsection
