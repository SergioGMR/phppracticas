<?php
	$sections = secciones();
	$rutas = rutas();

	if (!empty($rutas)) {
		if (in_array($rutas[0], $sections)) {
			$seccion = $rutas[0];
			if ($seccion == 'weather' && (!empty($rutas[1]))) {
				$ciudad = $rutas[1];
				if (!empty($rutas[2])) {
					$pais = $rutas[2];
				}
			}
			return compact('seccion', 'pais', 'ciudad');
		} else {
			$error = $rutas[0];
			return $error;
		}
	}
