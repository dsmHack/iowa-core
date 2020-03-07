<?php ?>
<head>   
  
  <style>
      html, body, #map { height: 100%; margin: 0; padding: 0; overflow: hidden; }
        .nicebox {
          position: absolute;
          text-align: center;
          font-family: "Roboto", "Arial", sans-serif;
          font-size: 13px;
          z-index: 5;
          box-shadow: 0 4px 6px -4px #333;
          padding: 5px 10px;
          background: rgb(255,255,255);
          background: linear-gradient(to bottom,rgba(255,255,255,1) 0%,rgba(245,245,245,1) 100%);
          border: rgb(229, 229, 229) 1px solid;
        }
        #controls {
          top: 10px;
          left: 110px;
          width: 360px;
          height: 45px;
        }
        #data-box {
          top: 10px;
          left: 500px;
          height: 45px;
          line-height: 45px;
          display: none;
        }
        #census-variable {
          width: 360px;
          height: 20px;
        }
        #legend { display: flex; display: -webkit-box; padding-top: 7px }
        .color-key {
          background: linear-gradient(to right,
            hsl(5, 69%, 54%) 0%,
            hsl(29, 71%, 51%) 17%,
            hsl(54, 74%, 47%) 33%,
            hsl(78, 76%, 44%) 50%,
            hsl(102, 78%, 41%) 67%,
            hsl(127, 81%, 37%) 83%,
            hsl(151, 83%, 34%) 100%);
          flex: 1;
          -webkit-box-flex: 1;
          margin: 0 5px;
          text-align: left;
          font-size: 1.0em;
          line-height: 1.0em;
        }
        #data-value { font-size: 2.0em; font-weight: bold }
        #data-label { font-size: 2.0em; font-weight: normal; padding-right: 10px; }
        #data-label:after { content: ':' }
        #data-caret { margin-left: -5px; display: none; font-size: 14px; width: 14px}
    </style></head>
<h2>
  <div id="map" class="map">
    GOOGLE MAP HERE
  </div>
<script>
var mapStyle = [{
        'stylers': [{'visibility': 'off'}]
      }, {
        'featureType': 'landscape',
        'elementType': 'geometry',
        'stylers': [{'visibility': 'on'}, {'color': '#fcfcfc'}]
      }, {
        'featureType': 'water',
        'elementType': 'geometry',
        'stylers': [{'visibility': 'on'}, {'color': '#bfd4ff'}]
      }];
      var map;
      var censusMin = Number.MAX_VALUE, censusMax = -Number.MAX_VALUE;

      function initMap() {
        var centerOfIowa = {lat: 41.8780, lng: -93.0977};
        var centerOfDesMoines = {lat: 41.5868, lng: -93.6250};
        var storyLocations = [centerOfIowa, centerOfDesMoines];

        var strictIowaBounds = new google.maps.LatLngBounds(
          new google.maps.LatLng(40.566435, -96.495775),
          new google.maps.LatLng(43.493584, -90.698676)
        );

         map = new google.maps.Map(
            document.getElementById('map'), {zoom: 3, center: centerOfIowa});

        for (var location = 0; location < storyLocations.length; location++) {
          var marker = new google.maps.Marker({position: storyLocations[location], map: map});
          marker.addListener('click', function() {
            // TODO: Add link to story
          });
        }

        map.fitBounds(strictIowaBounds, 0);

        loadMapShapes();
      }

      function loadMapShapes() {
          // load US state outline polygons from a GeoJson file
          map.data.loadGeoJson('https://raw.githubusercontent.com/dsmHack/iowa-core/master/geojson/iowa_counties.json', {idPropertyName:'name'},
          loadCensusData());
      }

      function loadCensusData() {
    // load the requested variable from the census API (using local copies)
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'https://data.iowa.gov/resource/aeyn-twxp.json');
    xhr.onload = function() {
        var censusData = JSON.parse(xhr.responseText);
        var mostRecentDate = censusData[0].month_ending;
        censusData.shift(); // the first row contains column names
        censusData.forEach(function(row) {
            if(row.month_ending===mostRecentDate){
                var censusVariable = parseFloat(row.benefits_paid);
                var county_name = row.county_name;

                // keep track of min and max values
                if (censusVariable < censusMin) {
                    censusMin = censusVariable;
                }
                if (censusVariable > censusMax) {
                    censusMax = censusVariable;
                }

                let feature =  map.data.getFeatureById(county_name);
                if(typeof feature != 'undefined'){
                  
                  // update the existing row with the new data
                feature.setProperty('census_variable', censusVariable);
                      map.data.setStyle(styleFeature);
                  }

            }   
        });

        // update and display the legend
        document.getElementById('census-min').textContent =
            censusMin.toLocaleString();
        document.getElementById('census-max').textContent =
            censusMax.toLocaleString();
    };
    xhr.send();
    }

      /** Removes census data from each shape on the map and resets the UI. */
      function clearCensusData() {
        censusMin = Number.MAX_VALUE;
        censusMax = -Number.MAX_VALUE;
        map.data.forEach(function(row) {
          row.setProperty('census_variable', undefined);
        });
        document.getElementById('data-box').style.display = 'none';
        document.getElementById('data-caret').style.display = 'none';
      }

      /**
       * Applies a gradient style based on the 'census_variable' column.
       * This is the callback passed to data.setStyle() and is called for each row in
       * the data set.  Check out the docs for Data.StylingFunction.
       *
       * @param {google.maps.Data.Feature} feature
       */
      function styleFeature(feature) {
        var low = [5, 69, 54];  // color of smallest datum
        var high = [151, 83, 34];   // color of largest datum

        // delta represents where the value sits between the min and max
        var delta = (feature.getProperty('census_variable') - censusMin) /
            (censusMax - censusMin);

        var color = [];
        for (var i = 0; i < 3; i++) {
          // calculate an integer color based on the delta
          color[i] = (high[i] - low[i]) * delta + low[i];
        }

        // determine whether to show this shape or not
        var showRow = true;
        if (feature.getProperty('census_variable') == null ||
            isNaN(feature.getProperty('census_variable'))) {
          showRow = false;
        }
        
        
        var outlineWeight = 0.5, zIndex = 1;
        
        /*if (feature.getProperty('state') === 'hover') {
          outlineWeight = zIndex = 2;
        }*/

        return {
          strokeWeight: outlineWeight,
          strokeColor: '#fff',
          zIndex: zIndex,
          fillColor: 'hsl(' + color[0] + ',' + color[1] + '%,' + color[2] + '%)',
          fillOpacity: 0.75,
          visible: showRow
        };
      }

      /**
       * Responds to the mouse-in event on a map shape (state).
       *
       * @param {?google.maps.MouseEvent} e
       */
      function mouseInToRegion(e) {
        // set the hover state so the setStyle function can change the border
        e.feature.setProperty('state', 'hover');

        var percent = (e.feature.getProperty('census_variable') - censusMin) /
            (censusMax - censusMin) * 100;

        // update the label
        document.getElementById('data-label').textContent =
            e.feature.getProperty('NAME');
        document.getElementById('data-value').textContent =
            e.feature.getProperty('census_variable').toLocaleString();
        document.getElementById('data-box').style.display = 'block';
        document.getElementById('data-caret').style.display = 'block';
        document.getElementById('data-caret').style.paddingLeft = percent + '%';
      }

      /**
       * Responds to the mouse-out event on a map shape (state).
       *
       * @param {?google.maps.MouseEvent} e
       */
      function mouseOutOfRegion(e) {
        // reset the hover state, returning the border to normal
        e.feature.setProperty('state', 'normal');
      }

    </script>
    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7Kyc9KMvnH5Kq61zueqOy3-38Me81siw&&callback=initMap">
    </script>
</h2>
