<?php require_once '../includes/weather.php' ?>
<section class="resume-section p-3 p-lg-5 d-flex d-column" id="weather">
    <div class="container">
        <form method="post" action="weather">
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
				echo '<h2 class="mb-0">' . $weather->name . ' |';
				echo '<span class="text-primary">|' . $weather->sys->country . '</span>';
				echo '</h1>';
				echo '<h2 class="mb-0">';
				echo $weather->weather[0]->description;
				echo '<img width="100" height="100"
                     src="https://openweathermap.org/img/w/' . $weather->weather[0]->icon . '.png"
                     class="img-circle"/>';
				echo '<span class="text-primary">' . $weather->wind->speed . ' Km/h | ' . $direccion . '</span>';
				echo '</h2>';
				echo '<h3 class="mb-0">';
				echo '<span class="text-primary"> Temperatura: ' . $weather->main->temp . 'ºC | Mínima: '
					. $weather->main->temp_min . 'ºC | Máxima: ' . $weather->main->temp_max . 'ºC | Humedad: '
					. $weather->main->humidity . '%</span>';
				echo '</h3>';
				echo '<ul class="list-inline list-social-icons mb-0">';
				echo '<li class="list-inline-item">';
				echo '<img src="/../img/sunrise.png" height="50" width="50"/>' . $sunrise;
				echo '<img src="/../img/sunset.png" height="50" width="50"/>' . $sunset;
				echo '</li>';
				echo '</ul>';
			}
		?>
    </div>
</section>
<script>
    function initMap() {
        $("#map").css("width", "70vw");
        $("#map").css("height", "37vh");
        var ciudad = {lat: <?php echo $weather->coord->lat ?>, lng: <?php echo $weather->coord->lon ?>};
        var mapOptions = {
            zoom: 13,
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgKz2F98ZXivyuk1PZe1C10JXqHKO1Tbg&callback=initMap"
        async defer></script>