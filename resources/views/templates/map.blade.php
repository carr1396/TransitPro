
<div class="floating-panel floating-panel-locations" id="floating-panel">
  <div class="form-group">
    <span class="label label-default">Start</span>
    <button type="button" name="showCurrDirections" id="showCurrDirections" class="btn btn-xs btn-success">Show Currently Seletecd  Directions</button>
    <select class="form-control" name="optionStartingLocation" id="optionStartingLocation">
      @foreach($district->locations as $place)
        <option value="{{$place->address}}">{{$place->name}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <span class="label label-default">End</span>
    <button type="button" name="removeDirections" id="removeDirections" class="btn btn-xs btn-danger">Remove Directions</button>
    <select class="form-control" name="optionEndingLocation" id="optionEndingLocation">
      @foreach($district->locations as $place)
        <option value="{{$place->address}}">{{$place->name}}</option>
      @endforeach
    </select>
  </div>

</div>
<div class="floating-panel floating-panel-routes">
  <div class="form-group" style="padding: 3px;">
    <span class="label label-default">Or Choose Transit Route</span>
    <button type="button" name="currRouteDirections" id="currRouteDirections" class="btn btn-xs btn-info">Show Directions Of Current Route</button>
    <select class="form-control" name="optionTransitRoute" id="optionTransitRoute">
      @foreach($troutes as $route)
        <option value="{{$route->id}}">( {{$route->name}} ) {{$route->start->name}} &#x02192; {{$route->end->name}}</option>
      @endforeach

    </select>
  </div>
</div>
<div class="map-canvas" id="map-canvas"></div>
@include ('footer')
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script src="{{theme('js/markerclusterer.js')}}" charset="utf-8"></script>
<script src="{{theme('js/mapster.js')}}" charset="utf-8"></script>
<script src="{{theme('js/mapoptions.js')}}" charset="utf-8"></script>
<script src="{{theme('js/jquery.ui.mapster.js')}}" charset="utf-8"></script>
<script type="text/javascript">
  $(document).ready(function() {

    toastr.options.closeButton = true;

    // var mapCanvas = document.getElementById('map-canvas');
    var optionStartLocation = document.getElementById('optionStartingLocation');
    var optionEndLocation = document.getElementById('optionEndingLocation');
    var optionTransitRoute = document.getElementById('optionTransitRoute');
    var district = window.district;
    var troutes = window.troutes;
    var locations = district.locations || [];

    var lat = Number(district.latitude);
    var lng = Number(district.longitude);
    var mapOptions = Mapster.MAP_OPTIONS;
    mapOptions.lat =lat;
    mapOptions.lng=lng;
    var $mapster = $('#map-canvas').mapster(mapOptions);

    //mark all locations
    function displayDistrictLocationsAsMarkers(){
      locations.forEach(function(place){
        // console.log(place);
        $mapster.mapster('addMarker', {
          lat : Number(place.latitude),
          lng :  Number(place.longitude),
          content:'<div><h4>'+place.address+'</h4><p>'+place.description+'</p></div>'});
      });
    }
    displayDistrictLocationsAsMarkers();
    var displayRouteOnMap = function displayRouteOnMap(start, end){
      $mapster.mapster('calculateAndDisplayRoute', {
        start: start,
        end: end,
        travelMode:'DRIVING'}, function(status, message){
          if(status==='OK'){
            toastr.success('Directions Successfully Found');
          }
          else{
            toastr.error('Directions request failed due to '+ message, 'Error!', {timeOut: 5000});
          }
        });
    };
    var onLocationChangeHandler = function onStartOrEndLocationChanged(e){
      displayRouteOnMap(optionStartLocation.value,optionEndLocation.value);
    };
    var onTRouteChangeHandler = function onTRouteChangeHandler(e){
      for (var i = 0; i < troutes.length; i++) {
        if(troutes[i].id == optionTransitRoute.value){
          var t = troutes[i];
          // console.log(t);
          displayRouteOnMap(t.start.address, t.end.address);
          break;
        }
      }
    };

    //add the listener to location selector elements
    optionStartLocation.addEventListener('change', onLocationChangeHandler, false);
    optionEndLocation.addEventListener('change', onLocationChangeHandler, false);

    optionTransitRoute.addEventListener('change', onTRouteChangeHandler, false);
    $('#currRouteDirections').click(function(event) {
      onTRouteChangeHandler(event);
    });
    $('#showCurrDirections').click(function(event) {
      onLocationChangeHandler(event);
    });
    $('#removeDirections').click(function(event) {
      $mapster.mapster('clearDirections');
      displayDistrictLocationsAsMarkers();
    });


  });
</script>
