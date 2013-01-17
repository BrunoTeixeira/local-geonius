
function create_map(map_lat, map_lng) {

  // Geolocation Coordinates
  var latlng = new google.maps.LatLng(map_lat, map_lng);

  // Map Controls/Style Options
  var myOptions = {
    zoom: 15,
    center: latlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP,

    panControl: false,

    zoomControl: true,
    zoomControlOptions: {
      style: google.maps.ZoomControlStyle.DEFAULT
    },
    
    mapTypeControl: false,
    scaleControl: false,
    streetViewControl: false,
    overviewMapControl: false
  };

  var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

  // Create marker given the latitude & longitude
  var marker = new google.maps.Marker({
      position: latlng,
      title:"Hello World!",
      animation: google.maps.Animation.DROP
  });

  marker.setMap(map);
}
