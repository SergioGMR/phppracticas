<?php
	
	require_once '../includes/extras.php';
	require_once '../includes/Movies.php';
	
	if (isset($_POST['titulo'])) {
		$peliculas = new Movies();
		$titulo = concatenarEspacios($_POST['titulo']);
		$peliculas = $peliculas->movieSearch($titulo);
		//$pelicula = $pelicula->results[0];
	}
?>

<section class="resume-section p-5" id="pelicula">
    <div class="container">
        <form method="post" action="peliculas">
            <div class="form-group">
                <small id="peliculaHelper" class="form-text text-muted">
                    Escibe el título de la pelicula a buscar
                </small>
                <input class="col-lg-10" type="text" name="titulo" value="" placeholder="Dedpool..."/>
                <button type="submit" role="button" class="btn btn-dark text-primary">Buscar<i class="fa fa-search"></i>
                </button>
            </div>
        </form>
		
		<?php
			if (isset($_POST['idPelicula'])) {
				$pelicula = new Movies();
				$pelicula = $pelicula->movieId($_POST['idPelicula']);
				
				//dd($pelicula);
				
				
				if (isset($pelicula)) {
					echo '<div class="card bg-dark">';
					echo '<img class="card-img" src="http://image.tmdb.org/t/p/w1280' . $pelicula->backdrop_path . '" alt="' . $pelicula->original_title . '">';
					echo '<div class="card-img-overlay m-0">';
					echo '<h2 class="card-title text-secondary p-2" style="background-color: rgba(0,0,0,0.7)">Titulo: <span class="text-white">' . $pelicula->title . ' </span><p>Duración: <span class="text-white">' . $pelicula->runtime . ' \'</span></p></h2>';
					
					echo '<h5 class="card-text text-secondary p-2" style="background-color: rgba(0,0,0,0.7)">Sinopsis: <span class="text-white">' . $pelicula->overview . '</span></h5>';
					echo '<h5 class="card-text text-secondary p-2" style="background-color: rgba(0,0,0,0.7)">Trailers: ';
					echo '<p class="text-center">';
					foreach ($pelicula->videos->results as $video) {
						echo '<a href ="https://www.youtube.com/watch?v=' . $video->key . '" class="text-danger" target="_blank"><i class="fa fa-youtube-play fa-3x align-text-top"></i></a> ';
					}
					echo '</p>';
					echo '</h5>';
					echo '</div>';
					echo '</div>';
				}
				
			}
			
			if (!empty($peliculas)) {
				if ($peliculas->total_results > 8)
					$total = 8;
				else
					$total = $peliculas->total_results;
				
				echo '<div class="row">';
				for ($i = 0; $i < $total; $i++) {
					echo '<div class="card col-3 p-0">';
					
					if ($peliculas->results[ $i ]->poster_path != null)
						echo '<img class="card-img-top" src="http://image.tmdb.org/t/p/w185' . $peliculas->results[ $i ]->poster_path . '" alt="' . $peliculas->results[ $i ]->title . '"/>';
					else
						echo '<img class="card-img-top" src="../img/null.jpg" width="196px" height="294px" alt="' . $peliculas->results[ $i ]->title . '"/>';
					
					echo '<div class="card-body">';
					echo '<h5 class="card-title">' . $peliculas->results[ $i ]->title . '</h5>';
					echo '<p class="card-text text-truncate">' . $peliculas->results[ $i ]->overview . '</p>';
					echo '</div>';
					echo '<div class="card-footer d-flex justify-content-center">';
					echo '<form role="form" method="post" action="peliculas">';
					echo '<button class="btn btn-sm bg-success" role="submit" id="idPelicula" name="idPelicula" value="' . $peliculas->results[ $i ]->id . '">Esta</button>';
					echo '</form>';
					echo '</div>';
					echo '</div>';
				}
				
				echo '</div>';
			}
		?>
    </div>
</section>