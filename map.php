<?php
$story_array = array();
$story_associative_array = array();
$s_query = new WP_Query(array(
    'post_type' => 'story',
    'posts_per_page' => -1,
));
?>

<?php if ($s_query->have_posts()) { ?>
    <?php while ($s_query->have_posts()) { ?>
        <?php $s_query->the_post(); ?>
        <?php $story_array = array(
            'link' => get_permalink(),
            'title' => get_the_title(),
            'community' => get_field('community'),
            'zip' => get_field('zip'),
        );
        array_push($story_associative_array, $story_array)

        ?>
    <?php } ?>
<?php } ?>
<?php wp_reset_postdata(); ?>

<div class="map-wrapper">
    <div id="controls" class="nicebox map-controls">
        <select id="census-variable">
            <option>Unemployment Benefit Paid</option>
        </select>
        <div class="legend" id="legend">
            <div class="census-min" id="census-min">min</div>
            <div class="color-key">
                <span id="data-caret">&#x25c6;</span>
            </div>
            <div class="census-max" id="census-max">max</div>
        </div>
    </div>

    <div id="map" class="map">
        Google map here
    </div>
</div>

<script>
    var storyArray = <?php echo json_encode($story_associative_array);?>;

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

        // var centerOfDesMoines = {lat: 41.5868, lng: -93.6250};
        // var storyLocations = [centerOfIowa, centerOfDesMoines];

        var strictIowaBounds = new google.maps.LatLngBounds(
            new google.maps.LatLng(40.566435, -96.495775),
            new google.maps.LatLng(43.493584, -90.698676)
        );

        map = new google.maps.Map(
            document.getElementById('map'), {zoom: 3, center: centerOfIowa});

        async function createStoryMapMarker(story) {
            let mycall = `https://public.opendatasoft.com/api/records/1.0/search/?dataset=us-zip-code-latitude-and-longitude&q=${story.zip}`

            await fetch(mycall)
            .then(response => response.json())
            .then(function(data) {
                var latLngObj = {
                    lat: data.records[0].geometry.coordinates[1],
                    lng: data.records[0].geometry.coordinates[0]
                }

                let marker = new google.maps.Marker({position: latLngObj, map: map});
                marker.addListener('click', function () {
                    window.location.href = story.link;
                });
                marker.addListener('mouseover', function () {
                  marker.setAnimation(google.maps.Animation.BOUNCE);
                });
                marker.addListener('mouseout', function () {
                  marker.setAnimation(null);
                });
                return;
            })
              .catch(error => console.error(error));
        }
        // this should be over each Story in  storyArray, hard-coded values for now
        for (var i = 0; i < storyArray.length; i++) {
          var marker = createStoryMapMarker(storyArray[i]);
        }

        map.fitBounds(strictIowaBounds, 0);
    }

    function loadMap() {
      return new Promise(function(resolve) {
        map.data.loadGeoJson('https://raw.githubusercontent.com/dsmHack/iowa-core/master/geojson/iowa_counties.json', {idPropertyName: 'name'}, function() {
          resolve();
        });
      });
    }

    function loadUnemploymentBenefitDollarsPerCounty() {
       // load the requested variable from the census API (using local copies)
       var xhr = new XMLHttpRequest();
       xhr.open('GET', 'https://data.iowa.gov/resource/aeyn-twxp.json');
       xhr.onload = function () {
           var censusData = JSON.parse(xhr.responseText);
           var mostRecentDate = censusData[0].month_ending;
           censusData.shift(); // the first row contains column names
           censusData.forEach(function (row) {
               if (row.month_ending === mostRecentDate) {
                   var censusVariable = parseFloat(row.benefits_paid);
                   var county_name = row.county_name;

                   // keep track of min and max values
                   if (censusVariable < censusMin) {
                       censusMin = censusVariable;
                   }
                   if (censusVariable > censusMax) {
                       censusMax = censusVariable;
                   }

                   let feature = map.data.getFeatureById(county_name);
                   if (typeof feature != 'undefined') {
                       // update the existing row with the new data
                        feature.setProperty('census_variable', censusVariable);
                        map.data.setStyle(styleFeature);
                        map.data.addListener('mouseover', mouseInToRegion);
                        map.data.addListener('mouseout', mouseOutOfRegion);
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
        map.data.forEach(function (row) {
            row.setProperty('census_variable', undefined);
        });
        document.getElementById('data-caret').style.display = 'none';
    }

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

        return {
            strokeWeight: outlineWeight,
            strokeColor: '#fff',
            zIndex: zIndex,
            fillColor: 'hsl(' + color[0] + ',' + color[1] + '%,' + color[2] + '%)',
            fillOpacity: 0.75,
            visible: showRow
        };
    }

    function mouseInToRegion(e) {
        e.feature.setProperty('state', 'hover');
        console.log(e.feature);

        var percent = (e.feature.getProperty('census_variable') - censusMin) /
            (censusMax - censusMin) * 100;

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

    jQuery(document).ready(function() {
      const necessaryFunctionWrapper = async function() {
        jQuery('#census-variable').change(function() {
          const censusChoice = jQuery(this).text().trim();
          if (censusChoice === 'Unemployment Benefit Paid') {
            loadUnemploymentBenefitDollarsPerCounty();
          }
        });
        await loadMap();
        jQuery('#census-variable').trigger('change');
      };
      necessaryFunctionWrapper();
    });

</script>
<script defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7Kyc9KMvnH5Kq61zueqOy3-38Me81siw&&callback=initMap">
</script>
