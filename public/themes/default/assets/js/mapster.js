// List.js
(function(window) {
  'use strict';
  var List = (function() {
    function List(params) { this.items = []; }
    List.prototype = {
      add : function addItemToList(item) { this.items.push(item); },
      remove : function removeItemFromList(item) {
        var indexOf = this.items.indexOf(item);
        if (indexOf !== -1) {
          this.items.splice(indexOf, 1);
        }
      },
      find : function findItemInList(callback, actionCallback) {
        var callbackReturn;
        var items = this.items, length = items.length, matches = [], i = 0;
        for (; i < items.length; i++) {
          callbackReturn = callback(items[i], i);
          if (callbackReturn) {
            matches.push(items[i]);
          }
        }
        if (actionCallback) {
          actionCallback.call(this, matches);
        }
        return matches;
      }
    };
    return List;
  }());
  List.create = function(params) { return new List(params); };
  window.List = List;
}(window));
// mapster
(function(window, google) {
  'use strict';
  var Mapster = (function() {
    function Mapster(containerElement, options) {
      this.googleMap = new google.maps.Map(containerElement, options);
      this.markers = List.create();
      this.directionService = new google.maps.DirectionsService;
      this.directionsDisplay =
          new google.maps.DirectionsRenderer({map : this.googleMap});

      if (options.cluster) {
        this.markerClusterer =
            new MarkerClusterer(this.googleMap, [], options.cluster);
      }
    }
    Mapster.prototype = {
      zoom : function(level) {
        if (this.googleMap) {
          if (!level)
            return this.googleMap.getZoom();
          this.googleMap.setZoom(level);
        }
      },
      _on : function(opts) {
        var self = this;
        google.maps.event.addListener(
            opts.containerElement, opts.event, function(e) {
              opts.callback.call(self, e, opts.containerElement);
            });
      },
      setPano : function(element, opts) {
        var panorama = new google.maps.StreetViewPanorama(element, opts);
        if (opts.events) {
          this._attachEvents(panorama, opts.events);
        }
        this.googleMap.setStreetView(panorama);
      },
      _attachEvents : function(obj, events) {
        var self = this;
        events.forEach(function(event) {
          self._on({
            containerElement : obj,
            event : event.name,
            callback : event.callback
          });
        });
      },
      addMarker : function(options) {
        var marker;
        var self = this;
        options.position = {lat : options.lat, lng : options.lng};
        marker = this._createMarker(options);
        if (options.events && options.events.length > 0) {
          options.events.forEach(function(event) {
            if (event.name === 'click') {
              options.overideDefaultClick = true;
            }
            self._on({
              containerElement : marker,
              event : event.name,
              callback : event.callback
            });
          });
        }
        if (options.content) {
          if (!options.overideDefaultClick) {
            self._on({
              containerElement : marker,
              event : 'click',
              callback : function(e) {
                var infoWindow =
                    new google.maps.InfoWindow({content : options.content});
                infoWindow.open(self.googleMap, marker);
              }
            });
          }
        }
        // this._addMarker(marker);
        if (this.markerClusterer) {
          this.markerClusterer.addMarker(marker);
        }
        this.markers.add(marker);
        return marker;
      },
      findBy : function findAMarkerOnAMapByProperty(callback) {
        return this.markers.find(callback);
      },
      removeBy : function findAndRemoveMarkerOnAMapByProperty(callback) {
        var self = this;
        return self.markers.find(callback, function(markers) {
          markers.forEach(function(marker) {
            if (self.markerClusterer) {
              self.markerClusterer.removeMarker(marker);
            } else {
              marker.setMap(null);
            }
            self.markers.remove(marker);
          });

        });
      },
      findMarkerByLat : function findAMarkerOnAMapByLatitude(lat) {
        var i = 0;
        for (; i < this.markers.length; i++) {
          if (this.markers[i].position.lat() === lat) {
            return this.markers[i];
          }
        }
        return null;
      },
      _createMarker : function privateDrawMarkerOnMap(options) {
        options.map = this.googleMap;
        return new google.maps.Marker(options);
      },
      showDirectionStepsOnMap : function showDirectionStepsOnMap(opts) {
        var self = this, i = 0;
        var route = opts.directions.routes[opts.routeIndex || 0]
                        .legs[opts.legIndex || 0];
        var steps = route.steps;
        steps.forEach(function(step) {
          self.addMarker({
            lat : step.start_location.lat(),
            lng : step.start_location.lng(),
            content : step.instructions
          });
        });

      },
      clearDirections : function clearDirections() {
        // http://stackoverflow.com/questions/7886110/removing-routes-rendered-on-a-google-map
        var self = this;
        this.removeBy(function(marker) { // remove existing markers
          return marker;
        });
        if (this.directionsDisplay != null) {
          this.directionsDisplay.setMap(null);
          this.directionsDisplay = null;
        }
        this.directionsDisplay =
            new google.maps.DirectionsRenderer({map : this.googleMap});

      },
      calculateAndDisplayRoute : function calculateAndDisplayRoute(opts,
                                                                   callback) {
        // console.log(opts);
        var self = this;
        this.removeBy(function(marker) { // remove existing markers
          return marker;
        });
        // https://developers.google.com/maps/documentation/javascript/examples/directions-travel-modes
        this.directionService.route(
            {
              origin : opts.start,
              destination : opts.end,
              travelMode : google.maps.TravelMode[opts.travelMode]
            },
            function(response, status) {
              // Route the directions and pass the response to a function to
              // create
              // markers for each step.
              if (status === google.maps.DirectionsStatus.OK) {
                // console.log(response);
                self.directionsDisplay.setDirections(response);
                self.showDirectionStepsOnMap(
                    {directions : response, routeIndex : 0, legIndex : 0});
                callback.call(this, 'OK', response);
              } else {
                callback.call(this, 'FAIL', status);
              }
            });
      }
    };
    return Mapster;
  }());
  Mapster.create = function(containerElement, options) {
    return new Mapster(containerElement, options);
  };
  window.Mapster = Mapster;
}(window, google));
//
