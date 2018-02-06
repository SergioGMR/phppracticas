<?php
	$key = 'YOUR_API_KEY-OPENWEATHERMAP';

	//$lat = '28.09520';
	//$lon = '-15.41678';

	if (isset($_POST['ciudad'])) {

		$ciudad = str_replace(' ', '+', $_POST['ciudad']);

	} else if (isset($ciudad)) {

		$ciudad = str_replace(' ', '+', $ciudad);

	} else {

		$ciudad = 'Las+Palmas+De+Gran+Canaria';

	}


	/* MEDIANTE NOMBRE CIUDAD */
	
	$url = 'https://api.openweathermap.org/data/2.5/weather?q=' . $ciudad . '&units=metric&type=accurate&lang=es&appid=' . $key;
	$forecast_url = 'https://api.openweathermap.org/data/2.5/forecast?q=' . $ciudad . '&type=accurate&units=metric&lang=es&cnt=4&appid=' . $key;


	try {
		$weather = json_decode(@file_get_contents($url));
		$forecast = json_decode(@file_get_contents($forecast_url));
		
		if (is_object($weather) && is_object($forecast)) {
			if (isset($weather->wind->deg)) {
				$viento = ($weather->wind->deg);
				
				if (($viento > 0) && ($viento <= 30)) {
					$direccion = "Norte";
				} elseif (($viento > 30) && ($viento <= 60)) {
					$direccion = "Nort Este";
				} elseif (($viento > 60) && ($viento <= 90)) {
					$direccion = "Este";
				} elseif (($viento > 90) && ($viento <= 120)) {
					$direccion = "Este";
				} elseif (($viento > 120) && ($viento <= 150)) {
					$direccion = "Sur Este";
				} elseif (($viento > 150) && ($viento <= 180)) {
					$direccion = "Sur";
				} elseif (($viento > 180) && ($viento <= 210)) {
					$direccion = "Sur";
				} elseif (($viento > 210) && ($viento <= 240)) {
					$direccion = "Sur Oeste";
				} elseif (($viento > 240) && ($viento <= 270)) {
					$direccion = "Oeste";
				} elseif (($viento > 270) && ($viento <= 300)) {
					$direccion = "Oeste";
				} elseif (($viento > 300) && ($viento <= 330)) {
					$direccion = "Nort Oeste";
				} elseif (($viento > 330) && ($viento <= 360)) {
					$direccion = "Norte";
				} else {
					$direccion = $viento;
				}
			}

			$sunrise = date("H:i:s", $weather->sys->sunrise);
			$sunset = date("H:i:s", $weather->sys->sunset);
			
			if (isset($viento)) {
				return compact('weather', 'sunrise', 'sunset', 'direccion', 'forecast');
			} else {
				return compact('weather', 'sunrise', 'sunset', 'forecast');
			}


		} else {

			if (isset($_POST['ciudad'])) {

				return $error = $_POST['ciudad'];

			}
		}
	} catch (Exception $exception) {
		return $error = $exception->getMessage();
	}

	/* MEDIANTE COORDENADAS */