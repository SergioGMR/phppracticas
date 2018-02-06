<?php
	
	function limpiar($titulo) {
		$titulo = htmlspecialchars(htmlentities(trim($titulo)));
		return $titulo;
	}
	
	function concatenarEspacios($titulo) {
		$pre = limpiar($titulo);
		
		$titulo = str_replace(' ', '+', $pre);
		
		return $titulo;
	}
	
	function busca_edad($fecha_nacimiento) {
		$dia = date("d");
		$mes = date("m");
		$ano = date("Y");
		
		
		$dianaz = date("d", strtotime($fecha_nacimiento));
		$mesnaz = date("m", strtotime($fecha_nacimiento));
		$anonaz = date("Y", strtotime($fecha_nacimiento));


//si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual
		
		if (($mesnaz == $mes) && ($dianaz > $dia)) {
			$ano = ($ano - 1);
		}

//si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual
		
		if ($mesnaz > $mes) {
			$ano = ($ano - 1);
		}
		
		//ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad
		
		$edad = ($ano - $anonaz);
		
		
		return $edad;
		
	}
	
	function dd($array) {
		var_dump($array);
		exit();
	}
	
	function jd($array) {
		var_dump(json_decode($array, true));
		exit();
	}
	
	function getCurrentUri() {
		$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
		$uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
		if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
		$uri = '/' . trim($uri, '/');
		return $uri;
	}
	
	function secciones() {
		chdir("sections");
		$pre = glob("*.php");
		foreach ($pre as $pre2) {
			$sections[] = substr($pre2, 0, -4);
		}
		return $sections;
	}
	
	function rutas() {
		$base_url = getCurrentUri();
		$routes = [];
		$rutas = [];
		$routes = explode('/', $base_url);
		array_shift($routes);
		foreach ($routes as $route) {
			if (trim($route) != '')
				array_push($rutas, $route);
		}
		return $rutas;
	}
	
	function json_objeto($array) {
		echo json_encode($array);
	}
	
	function json_assoc($array) {
		echo json_encode($array, true);
	}
	
	function pruebaFichero($fich) {
		
		if (!file_exists($fich)) {
			echo "Fichero no encontrado " . $fich;
			die();
		}
		$file = fopen($fich, "r");
		while (!feof($file))
			echo fgets($file) . "<br />";
		fclose($file);
	}
	
	function leerOrdenadoC1($rutaFichero) {
		// abrir el fichero
		$fich_desc = fopen($rutaFichero, 'r');
		$c1_total = 0;
		$c1_subtotal = 0;
		$registro = fgets($fich_desc); // lectura del primer
		
		while (!feof($fich_desc)) {
			$campo = explode("#", $registro)[0];
			$campo_ant = $campo;
			
			while (!feof($fich_desc) && ($campo == $campo_ant)) {
				$campo = explode("#", $registro)[0];
				$c1_subtotal += (int)explode("#", $registro)[1];
				$registro = fgets($fich_desc); // leer siguiente ...
			}
			$campo = explode("#", $registro)[0];
			$c1_subtotal += (int)explode("#", $registro)[1];
			$c1_total += $c1_subtotal;
			echo 'El total de ' . $campo_ant . ' es: ' . $c1_subtotal . '</br>';
			$registro = fgets($fich_desc); // leer siguiente ...
			//echo $campo . '</br>';
		}
		echo 'La suma total es: ' . $c1_total;
		fclose($fich_desc);
	}