<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="shortcut icon" href="icons.png">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Clien BUMR Seluruh Indonesia</title> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootflat/2.0.4/css/bootflat.css">
<style type="text/css">
  body {
    padding-top: 10px;
    background-color: #fafbfa;
  }
</style>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0qQtSGpxqkXWMkpgTjRLHH7ejYcAEUhk&callback=initMap"
  type="text/javascript"></script>
 <script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 5.058178, lng: 97.259846},
          zoom: 13
        });

        // Menggunakan fungsi HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            marker = new google.maps.Marker({
              position: pos,
              map: map,
              icon: 'location.png',
              title: 'Posisi Kamu',
              animation: google.maps.Animation.DROP,
            });

            map.setCenter(pos);

            var user_location = position.coords.latitude+","+position.coords.longitude;
            var url = "tampil.php";
            var jarak = 1;
            var info = [];
            $.ajax({
                url: url,
                data: "position="+encodeURI(user_location)+"&jarak="+jarak,
                dataType: 'json',
                cache: true,
                success: function(msg){
                  for(i=0; i < msg.data.kafe.length;i++){
                    var point = new google.maps.LatLng(parseFloat(msg.data.kafe[i].latitude),parseFloat(msg.data.kafe[i].longitude));
                    tanda = new google.maps.Marker({
                        position: point,
                        map: map,
                        icon: "place.png",
                        animation: google.maps.Animation.DROP,
                        title: msg.data.kafe[i].nama_kafe
                    });
                  }
                }
            });

          }, function() {
            handleLocationError(true, map.getCenter());
          });
        } else {
          handleLocationError(false, map.getCenter());
        }
      }

      function showPlaces() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -2.548926, lng: 118.0148634},
          zoom: 13
        });

        // Menggunakan fungsi HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            marker = new google.maps.Marker({
              position: pos,
              map: map,
              icon: 'location.png',
              title: 'Posisi Kamu',
              animation: google.maps.Animation.DROP,
            });

            map.setCenter(pos);
            var user_location = position.coords.latitude+","+position.coords.longitude;
            var url = "tampil.php";
            var jarak = document.getElementById("jarak").value;

            $.ajax({
                url: url,
                data: "position="+encodeURI(user_location)+"&jarak="+jarak,
                dataType: 'json',
                cache: true,
                success: function(msg){
                  for(i=0; i < msg.data.kafe.length;i++){
                    var point = new google.maps.LatLng(parseFloat(msg.data.kafe[i].latitude),parseFloat(msg.data.kafe[i].longitude));
                    tanda = new google.maps.Marker({
                        position: point,
                        map: map,
                        icon: "place.png",
                        animation: google.maps.Animation.DROP,
                        title: msg.data.kafe[i].nama_kafe
                    });
                  }
                }
            });

          }, function() {
            handleLocationError(true, map.getCenter());
          });
        } else {
          handleLocationError(false, map.getCenter());
        }
      }
      function handleLocationError(browserHasGeolocation, pos) {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -2.548926, lng: 118.0148634},
          zoom: 13
        });
        var infoWindow = new google.maps.InfoWindow({map: map});
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
      }

      google.maps.event.addDomListener(window, 'load', initMap);
    </script>
</head> 
<body> 
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <legend><h3 style="color:#434a54">Cari Client BUMR Terdekat</h3></legend>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-9">
        <div id="map" style="width:100%; height:600px;"></div>
      </div>

      <div class="col-lg-3">
        <form class="form-vertical" method="post" action="#">
          <div class="form-group">
            <label>Radius / Jarak</label>
            <select id="jarak" name="jarak" class="form-control">
              <option value="">-- Silahkan Pilih Radius / Jarak --</option>
              <option value="1">1 KM</option>
              <option value="2">2 KM</option>
              <option value="3">3 KM</option>
              <option value="4">4 KM</option>
              <option value="5">5 KM</option>
              <option value="6">6 KM</option>
              <option value="7">7 KM</option>
              <option value="8">8 KM</option>
              <option value="9">9 KM</option>
              <option value="10">10 KM</option>
              <option value="11">11 KM</option>
              <option value="12">12 KM</option>
              <option value="13">13 KM</option>
              <option value="14">14 KM</option>
              <option value="15">15 KM</option>
              <option value="16">16 KM</option>
              <option value="17">17 KM</option>
              <option value="18">18 KM</option>
              <option value="19">19 KM</option>
              <option value="20">20 KM</option>
              <option value="21">21 KM</option>
              <option value="22">22 KM</option>
              <option value="23">23 KM</option>
              <option value="24">24 KM</option>
              <option value="25">25 KM</option>
              <option value="26">26 KM</option>
              <option value="27">27 KM</option>
              <option value="28">28 KM</option>
              <option value="29">29 KM</option>
              <option value="30">30 KM</option>
            </select>
          </div>
         
          <div class="form-group">
            <button id="cari" type="button" class="btn btn-primary" onclick="showPlaces();">Cari Tempat</button>
            <button id="cari" type="button" class="btn btn-success"> Back Home</button></br>
          </div>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <hr>
        <footer>
         <p>&copy; 2018 by <a href="#">Badan Usaha Milik Rakyat</a></p>
        </footer>
      </div>
    </div>
  </div>

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>