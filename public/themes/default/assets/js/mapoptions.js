(function(window, google, mapster) {
  'use strict';
  mapster.MAP_OPTIONS = {
    center : {lat : 2.9774985999999997, lng : 101.63869199999999},
    zoom : 13,
    disableDefaultUI : false, // hides defualt UIs eg the zoom bar etc
    scrollwheel : true, // stop ap from automatically capturing scrollwheel
    draggable : true,
    mapTypeId : google.maps.MapTypeId.ROADMAP, // to road and and satellite map
                                               // .SATELLITE .ROADMAP .HYBRID
    // maxZoom : 11,
    // minZoom : 9,
    zoomControlOptions : {
      position : google.maps.ControlPosition.BOTTOM_LEFT,
      style : google.maps.ZoomControlStyle.SMALL //.DEFAULT, .SMALL
    },
    panControlOptions : {
      position : google.maps.ControlPosition.LEFT_BOTTOM,
    },
    cluster : {
      options : {
        styles : [
          {
            url : '/icons/m2.png',
            height : 56,
            width : 55,
            textColor : '#fff',
            textSize : 18
          },
          {
            url : '/icons/m1.png',
            height : 56,
            width : 55,
          }
        ]
      }
    }
  };

}(window, google, window.Mapster || (window.Mapster = {})));
