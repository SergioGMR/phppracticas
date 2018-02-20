<?php require_once '../includes/weather.php' ?>
<section class="resume-section p-5" id="weather">
    <div class="container">
	    <?php
		    if (!isset($error)) {
			    echo '<h3>' . $weather->name . ' |';
			    echo '<span class="text-primary">|' . $weather->sys->country . '|</span>';
			    echo '|' . $weather->weather[0]->description;
			    echo '<img width="50" height="50"
                     src="https://openweathermap.org/img/w/' . $weather->weather[0]->icon . '.png"
                     class="img-circle"/>';
			    if (isset($viento))
				    echo '<span class="text-primary">' . $weather->wind->speed . ' Km/h | ' . $direccion . '</span>';
			    else
				    echo '<span class="text-primary">' . $weather->wind->speed . ' Km/h </span>';
			    echo '<img src="/../img/sunrise.png" height="30" width="30"/>' . $sunrise;
			    echo '<img src="/../img/sunset.png" height="30" width="30"/>' . $sunset;
			    echo '</h3>';
		    }
	    ?>
        <form method="post" action="clima">
            <div class="form-group">
                <small id="ciudadHelper" class="form-text text-muted">
                    Escribe el nombre de una ciudad con sus espacios: Las Palmas De Gran Canaria. Puedes añadir el país.
                    (la ciudad,ES)
                </small>
                <input class="col-lg-10" type="text" name="ciudad" value="" placeholder="Las Palmas De Gran Canaria"/>
                <button type="submit" role="button" class="btn btn-dark text-primary">Buscar<i class="fa fa-search"></i>
                </button>
            </div>
        </form>
		<?php
			if (isset($error)) {
				include('../404.php');
			} else {
				echo '<div id="map"></div>';
				echo '<h3 class="mb-0">';
				
				echo '</h3>';
				echo '<h3 class="mb-0">';
				echo '<img src="../img/weather/temperature.png"/> ' . $weather->main->temp . 'ºC |';
				echo '<img src="../img/weather/descending-temperature.png"/> ' . $weather->main->temp_min . 'ºC |';
				echo '<img src="../img/weather/ascending-temperature.png"/> ' . $weather->main->temp_max . 'ºC |';
				echo '<img src="../img/weather/humidity.png"/>	' . $weather->main->humidity . ' %';
				echo '</h3>';
				echo '<div class="card-group">';
				for ($i = 0; $i < 4; $i++) {
					echo '<div class="card bg-light text-dark col-3">';
					echo '<img class="card-img" src="https://openweathermap.org/img/w/' . $forecast->list[ $i ]->weather[0]->icon . '.png"';
					echo 'alt="' . $forecast->list[ $i ]->weather[0]->description . '" >';
					echo '<div class="card-img-overlay">';
					echo '<h4 class="card-title">' . $forecast->list[ $i ]->weather[0]->description . '</h4>';
					echo '<p class="card-text"><img src="../img/weather/descending-temperature.png"/> ' . $forecast->list[ $i ]->main->temp_min . ' Cº</p>';
					echo '<p class="card-text"><img src="../img/weather/ascending-temperature.png"/> ' . $forecast->list[ $i ]->main->temp_max . ' Cº</p>';
					echo '</div>';
					echo '</div>';
				}
				echo '</div>';
			}
		?>
    </div>
</section>
<script>
    function initMap() {
        $("#map").css("width", "65vw");
        $("#map").css("height", "35vh");
        var ciudad = {lat: <?php echo $weather->coord->lat ?>, lng: <?php echo $weather->coord->lon ?>};
        var mapOptions = {
            zoom: 12,
            minZoom: 10,
            maxZoom: 18,
            center: ciudad,
            scaleControl: true,
            mapTypeId: 'hybrid'
        };
        var map = new google.maps.Map(document.getElementById('map'), mapOptions);
        var marker = new google.maps.Marker({
            position: ciudad,
            map: map
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=APIKEY-GOOGLEMAPS&callback=initMap"
        async defer></script>