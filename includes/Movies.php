<?php
	
	class Movies {
		protected $base_url = 'https://api.themoviedb.org/3/';
		protected $key = 'YOU_API_KEY-THEMOVIEDBORG';
		protected $img_url = 'http://image.tmdb.org/t/p/';
		protected $idioma = '&language=es-ES';
		protected $adult = '&include_adult=false';
		
		public function movieSearch($titulo) {
			$base_url = $this->base_url;
			$key = $this->key;
			$idioma = $this->idioma;
			$adult = $this->adult;
			
			$secondPath = 'search/movie';
			
			try {
				$response = json_decode(@file_get_contents($base_url . $secondPath . '?api_key=' . $key . '&page=1&include_image_language=es&query=' . $titulo . $idioma . $adult));
				if (is_object($response))
					return $response;
			} catch (Exception $e) {
				$error = $e->getMessage();
				return $error;
			}
			
		}
		
		public function videosId($id) {
			$base_url = $this->base_url;
			$key = $this->key;
			$idioma = $this->idioma;
			$secondPath = 'movie/' . $id . '/videos';
			
			try {
				$response = json_decode(@file_get_contents($base_url . $secondPath . '?api_key=' . $key . $idioma));
				if (is_object($response))
					return $response;
			} catch (Exception $e) {
				$error = $e->getMessage();
				return $error;
			}
			
			
		}
		
		public function movieId($id) {
			$base_url = $this->base_url;
			$key = $this->key;
			$idioma = $this->idioma;
			$secondPath = 'movie/';
			
			try {
				$response = json_decode(@file_get_contents($base_url . $secondPath . $id . '?api_key=' . $key . '&include_image_language=es' . $idioma . '&append_to_response=videos'));
				if (is_object($response))
					return $response;
			} catch (Exception $e) {
				$error = $e->getMessage();
				return $error;
			}
			
			
		}
	}