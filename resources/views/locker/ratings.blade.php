@if($is_pro)
<div style="font-size:18px;">
<b>Average Rating: </b>
 &nbsp;&nbsp;{{$pro->avg_rating()}} Stars
 <br>
</div>
@endif
<table class="mdl-data-table mdl-js-data-table rate-table mdl-shadow--2dp"  style="width:100%; font-size:18px;">
  <thead>
    <tr>
      <th style="width:20%;text-align:center; font-size:20px;">Rating</th>
      <th style="width:80%;text-align:center; font-size:20px;" class="mdl-data-table__cell--non-numeric">Description</th>
    </tr>
  </thead>
  <tbody>
    @foreach($pro->ratings_pro as $rating)
    <tr>
      <td style="width:20%; text-align:center;">{{$rating->rating}} Stars</td>
      <td style="width:80%; text-align:center;" class="mdl-data-table__cell--non-numeric">{{$rating->description}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
