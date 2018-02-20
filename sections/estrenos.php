<section class="resume-section p-5" id="estrenos">
    <div class="container">
        <div clas="col"><h2 class="text-uppercase justify-content-center">próximos estrenos</h2></div>
        <div class="row" id="peliculas">

        </div>
    </div>
</section>
<script>
    var url = "https://api.themoviedb.org/3/movie/upcoming?api_key=a2eb494ab16f1465babbd806d265fb9b&language=es-ES&region=es";
    $.getJSON(url, function (data) {

        var response = data.results;
        $(response).each(function () {
            var fecha = new Date(this.release_date);
            var options = {year: 'numeric', month: 'numeric', day: 'numeric'};
            fecha = fecha.toLocaleDateString('es-ES', options);

            $('#peliculas').append('<div class="card col-4 p-0 m-5">' +
                '<img class="card-img" src="https://image.tmdb.org/t/p/w342' + this.poster_path + '" alt="' + this.title + '">' +
                '<div class="card-img-overlay">' +
                '<h5 class="card-title text-white p-2" style="background-color: rgba(0,0,0,0.7)" >Título: ' + this.title + '</h5>' +
                '<h5 class="card-text text-white p-2" style="background-color: rgba(0,0,0,0.7)" >Estreno: ' + fecha + '</h5>' +
                '</div>' +
                '</div>');
            console.log(this.title);
        })
    });
</script>