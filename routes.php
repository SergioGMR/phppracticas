<?php
	$sections = secciones();
	$rutas = rutas();

	if (!empty($rutas)) {
		if (in_array($rutas[0], $sections)) {
			$seccion = $rutas[0];
			if ($seccion == 'clima' && (!empty($rutas[1]))) {
				$ciudad = $rutas[1];
				if (!empty($rutas[2])) {
					$pais = $rutas[2];
				}
			}
			if (isset($ciudad))
				return compact('seccion', 'pais', 'ciudad');
			elseif (isset($pais))
				return compact('seccion', 'pais');
			else
				return compact('seccion');

		} else {
			$error = $rutas[0];
			return $error;
		}
	}
