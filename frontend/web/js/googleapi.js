$(function(){
    var Lat = $('#GoogleLat').html();
    var Lng = $('#GoogleLng').html();
    if(Lat !== undefined && Lng !== undefined){
        GoogleMapSetup(Lat, Lng);
    }
});

function GoogleMapSetup(Lat, Lng){
    var LatLng = new google.maps.LatLng(Lat, Lng);
    var mapOptions = {
    center: LatLng,
    zoom: 18,
    mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
    var marker = new google.maps.Marker({
      position: LatLng,
      map: map,
      title: "destination here"
    });
}