 </div>
 @if(isset($button_dir) && isset($button_name))
  <div class="mdl-card__actions mdl-card--border">
    <a href="{{$button_dir or 'home'}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
      {{$button_name or ""}}
    </a>
  </div>
  @endif
</div>
</div>
