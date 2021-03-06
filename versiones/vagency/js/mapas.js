// Initialize and add the map
function initMap() {
  // The location of Uluru
  const uluru = { lat: 41.6575155, lng: -0.9160625 };
  // The map, centered at Uluru
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 10,
    center: uluru,
  });
  // The marker, positioned at Uluru
  const marker = new google.maps.Marker({
    position: uluru,
    map: map,
  });
}
