<?php ?>
<h2>
  <div id="map" class="map">
    GOOGLE MAP HERE
  </div>
  <script>
      function initMap() {
        var centerOfIowa = {lat: 41.8780, lng: -93.0977};
        var centerOfDesMoines = {lat: 41.5868, lng: -93.6250};
        var storyLocations = [centerOfIowa, centerOfDesMoines];

        var strictIowaBounds = new google.maps.LatLngBounds(
          new google.maps.LatLng(40.566435, -96.495775),
          new google.maps.LatLng(43.493584, -90.698676)
        );

        var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 3, center: centerOfIowa});

        for (var location = 0; location < storyLocations.length; location++) {
          var marker = new google.maps.Marker({position: storyLocations[location], map: map});
          marker.addListener('click', function() {
            // TODO: Add link to story
          });
        }

        map.fitBounds(strictIowaBounds, 0);
      }
    </script>
    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdgNID2pjCD3zbLeJHuuWEHd_UYBW-S94&callback=initMap">
    </script>
</h2>
