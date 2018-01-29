<section class="resume-section p-3 p-lg-5 d-flex d-column" id="weather">
    <div class="my-auto">
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

        <div id="map"></div>
        <h2 class="mb-0">NOMBRE |
            <span class="text-primary">| PAIS</span>
        </h2>
        <h2 class="mb-0">
            CLIMA
            <img width="100" height="100"
                 src="https://openweathermap.org/img/w/ . $weather->weather[0]->icon . .png"
                 class="img-circle"/>
            <span class="text-primary">  Km/h | DIRECCION</span>
        </h2>
        <h3 class="mb-0">
            <span class="text-primary"> Temperatura: ºC | Mínima: ºC | Máxima: ºC | Humedad: %</span>
        </h3>
        <ul class="list-inline list-social-icons mb-0">
            <li class="list-inline-item">
                <img src="/../img/sunrise.png" height="50" width="50"/> amanecer
                <img src="/../img/sunset.png" height="50" width="50"/> atardecer
            </li>
        </ul>
    </div>
</section>
<script>
    function getIp() {
        return $.getJSON('https://extreme-ip-lookup.com/json', function (data) {
            return data;
        });
    }

    var resultado = getIp();

    var latitud = Number(resultado.lat);
    var longitud = Number(resultado.lon);

    function initMap() {
        $("#map").css("width", "70vw");
        $("#map").css("height", "37vh");
        var ciudad = {lat: latitud, lng: longitud};
        var mapOptions = {
            zoom: 13,
            minZoom: 10,
            maxZoom: 18,
            center: ciudad,
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