var map;
function initMap() {
	map = new google.maps.Map(document.getElementById('map'), {
		center: {lat: 48.2335427, lng: 16.412597},
		zoom: 15
	});
}