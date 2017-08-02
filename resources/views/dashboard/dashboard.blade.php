@extends('layouts.app_nogrid')

@section('content')
@include('dashboard.scripts')
<div style="width:90%" class="mdl-grid">
<div id="dataTable" class="mdl-card mdl-shadow--2dp is-casting-shadow"></div>

</div>
<script type="text/javascript">
var response;
var distances = [];
var destinations = [];
  function findDistance(origin, destinations2, num) {
        var geocoder = new google.maps.Geocoder;
        var service = new google.maps.DistanceMatrixService;
        service.getDistanceMatrix({
          origins: origin,
          destinations: destinations2,
          travelMode: google.maps.TravelMode.DRIVING,
          unitSystem: google.maps.UnitSystem.IMPERIAL,
          avoidHighways: false,
          avoidTolls: false
        }, function(response2, status) {
          response = response2.rows[0].elements;
          for(var i = 0;i<response.length;i++){
            if(response[i] && response[i].distance && response[i].distance.text){
            distances[i+ num] = (response[i].distance.text);
        }else{
            distances[i+ num] = (200);
          }
        }
        if(num < destinations.length){
        findDistance(origin, destinations.splice(num+24,num+24+24), num+24);
        }else{
            
            var all = $("#dataTable").jqxDataTable('getRows');
            for(var t = 0;t<all.length;t++){
                var current = all[t];
                current.distance = distances[t];
                if(parseInt(distances[t]) > 0){
                    current.distance = parseInt(distances[t]);
                }
                $("#dataTable").jqxDataTable('updateRow', current.uid, current);

            }
        }
        });
      }

        $(document).ready(function () {
            // prepare the data

            var data = new Array();
            var firstNames = [];
            var lastNames = [];
            var names = []
            var imgs = [];
            var bios = [];
            var ratings = [];
            var ids = [];
            var rates = [];
            var yoes = [];
            var lats = [];
            var lngs = [];
            var addresss = [];
            var playlists = [];
            
            
            @foreach($pros as $key=>$pro)
            firstNames.push('{{$pro->firstname}}');
            lastNames.push('{{$pro->lastname}}');
            names.push('{{$pro->firstname." ".$pro->lastname}}');
            imgs.push('{{$pro->propic}}');
            bios.push('{{$pro->bio}}');
            ratings.push(parseInt(5*Math.random())+1);
            ids.push('{{$pro->id}}');
            rates.push(parseInt('{{$pro->rate}}'));
            yoes.push(parseInt('{{$pro->yoe}}'));
            lats.push('{{$pro->lat}}');
            lngs.push('{{$pro->lng}}');
            addresss.push('{{$pro->address}}');
            var lat_lng = {lat:parseFloat('{{$pro->lat}}'),lng:parseFloat('{{$pro->lng}}')};
            destinations.push(lat_lng);
            var small = [];
            @foreach($pro->playlists as $playlist)
            var obj = {
                id: '{{$playlist->id}}',
                title: '{{$playlist->title}}',
                description: '{{$playlist->description}}'
            }
            small.push(obj);
            @endforeach
            if(small && small.length > 0){
            playlists.push(small);
            }
            console.log(playlists);
            @endforeach
            var user_lat_lng = {lat:parseFloat('{{$user->lat}}'),lng:parseFloat('{{$user->lng}}')};
            var subDestinations = destinations.slice(0,25);
            findDistance([user_lat_lng], subDestinations, 0);
            
            var k = 0;
            for (var i = 0; i < firstNames.length; i++) {
                var row = {};
                row["firstname"] = firstNames[k];
                row["lastname"] = lastNames[k];
                row["name"] = names[k];
                row["bio"] = bios[k];
                row["rating"] = ratings[k];
                row["img"] = imgs[k];
                row["id"] = ids[k];
                row["rate"] = rates[k];
                row["yoe"] = yoes[k];
                row['playlists'] = playlists[k];
                data[i] = row;
                k++;
            }
            var source =
            {
                localData: data,
                dataType: "array"
            };
            // initialize the row details.
            var initRowDetails = function (id, row, element, rowinfo) {
                var tabsdiv = null;
                var information = null;
                var notes = null;
                var playlist = null;
                // update the details height.
                rowinfo.detailsHeight = 200;
                element.append($("<div style='margin: 10px;'><ul style='margin-left: 30px;'><li class='title'>Title</li><li>Bio</li><li>Prerecorded Lessons</li></ul><div class='information'></div><div class='notes'></div><div class='playlist'></div></div>"));
                tabsdiv = $(element.children()[0]);
                tabsdiv.css('overflow', 'hidden');
                if (tabsdiv != null) {
                    information = tabsdiv.find('.information');
                    notes = tabsdiv.find('.notes');
                    playlist = tabsdiv.find('.playlist');
                    var title = tabsdiv.find('.title');
                    title.text(row.firstname);
                    var container = $('<div style="margin: 5px;"></div>')
                    container.appendTo($(information));
                    var photocolumn = $('<div style="float: left; width: 33%;"></div>');
                    var leftcolumn = $('<div style="float: left; width: 33%;"></div>');
                    var rightcolumn = $('<div style="float: left; width: 33%;"></div>');
                    container.append(photocolumn);
                    container.append(leftcolumn);
                    container.append(rightcolumn);
                    var photo = $("<div class='jqx-rc-all' style='margin: 10px;'><b>Photo:</b></div>");
                    var image = $("<div style='margin-top: 10px;'></div>");
                    var imgurl = row.img;
                    var img = $('<img height="110" src="' + imgurl + '"/>');
                    image.append(img);
                    image.appendTo(photo);
                    photocolumn.append(photo);
                    var firstname = "<div style='margin: 10px;'><b>First Name:</b> " + row.firstname + "</div>";
                    var lastname = "<div style='margin: 10px;'><b>Last Name:</b> " + row.lastname + "</div>";
                    var rating = "<div style='margin: 10px;'><b>Rating:</b> " + row.rating + " Stars</div>";
                    var rate = "<div style='margin: 10px;'><b>Rate:</b> $" + row.rate + "</div>";
                    var yoe = "<div style='margin: 10px;'><b>Years of experience:</b> " + row.yoe + "</div>";
                    var profile = "<div style='margin: 10px;'><a class='mdl-button mdl-js-button  mdl-js-ripple-effect mdl-button--accent' href='" + "{{url('/locker/')}}" +"/"+ row.id+"'>Go To Profile </a></div>";
                    var testimonials = "<div style='margin: 10px;'><a class='mdl-button mdl-js-button  mdl-js-ripple-effect mdl-button--primary' href='" + "{{url('/testimonials/')}}" +"/"+ row.id+"'>View Testimonials</a></div>";
                    var add = "<div style='margin: 10px;'><a class='mdl-button mdl-js-button  mdl-js-ripple-effect' href='" + "{{url('/watch/')}}" +"/"+ row.id+"'>Add to watchlist</a></div>";
                    var testimonials = "<div style='margin: 10px;'><a class='mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--accent' href='" + "{{url('/testimonials/')}}" +"/"+ row.id+"'>View Testimonials</a></div>";
                    $(leftcolumn).append(firstname);
                    $(leftcolumn).append(lastname);
                    $(leftcolumn).append(rating);
                    $(leftcolumn).append(rate);
                    $(leftcolumn).append(yoe);
                    $(rightcolumn).append(profile);
                    $(rightcolumn).append(testimonials);
                    $(rightcolumn).append(add);
                    var notescontainer = $('<div style="white-space: normal; margin: 5px;"><span>' + row.bio + '</span></div>');
                      

                    var playlist_li = "<ul class='mdl-list'></ul>";
                    if(row.playlists){
                    for(var o = 0;o<row.playlists.length;o++){
                        var cur = row.playlists[o];
                        console.log(cur);
                        playlist_li += '<li class="mdl-list__item mdl-list__item--three-line">';
                        playlist_li += '<span class="mdl-list__item-primary-content">';
                        playlist_li += '<span>'+ cur.title + '</span>';
                        playlist_li += '<span class="mdl-list__item-text-body">';
                        playlist_li += cur.description;
                        playlist_li += '</span></span>';
                        playlist_li += '<span class="mdl-list__item-secondary-content">';
                        playlist_li += '<a class="mdl-list__item-secondary-action" href="'+ '/'+row.id+'/'+cur.id+'/view' +'"><i class="material-icons">exit_to_app</i></a>'
                        playlist_li += '</span></li>';
                    }
                }
                  var morecontainer = $('<div style="white-space: normal; margin: 5px;">' + playlist_li + '</div>');
                    $(notes).append(notescontainer);
                    $(playlist).append(morecontainer);
                   $(tabsdiv).jqxTabs({ width: "85%", theme: 'light', height: 185 });
                }
            }
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#dataTable").jqxDataTable(
            {
                width: '99%',
                source: dataAdapter,
                pageable: true,
                pageSize: 20,
                rowDetails: true,
                sortable: true,
                scrollBarSize: 10,
                theme: 'light',
                pagerMode: "advanced",
                filterable: true,
                filterMode: "simple",
                ready: function () {
                    // expand the first details.
                    $("#dataTable").jqxDataTable('showDetails', 0);
                },
                initRowDetails: initRowDetails,
                columns: [
                      { text: 'First Name', dataField: 'name', width: '19%' },
                      { text: 'Rating', dataField: 'rating', width: '20%'},
                      { text: 'Years of experience', dataField: 'yoe', width: '20%' },
                      { text: 'Rate', dataField: 'rate', width: '20%' },
                      { text: 'Distance(miles)', dataField: 'distance', width: '20%' }
                ]
            });
        });
    </script>
    <style type="text/css">
    .jqx-tabs-content-element {

      overflow: hidden;
    }
    td{
    font-size: 19px !important;
    font-weight: 100 !important;
    font-family: 'Lata';
      
    }
    .mdl-card__supporting-text{
      width: 99%;
    }
    .playlist{
        overflow: auto;
    }
    #columntabledataTable{
    font-weight: 100 !important;
    font-size: 23px !important;
    font-family: 'Lata';
    }
    #filterdataTable{
      font-weight: 100 !important;
    font-size: 20px !important;
    font-family: 'Lata';
    }
    body{
      background: #F5F5F5;
    }
    </style>
     <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjqXaqZGf1niS-niV4YPXt9CiAwRZCAxQ">
    </script>
@endsection