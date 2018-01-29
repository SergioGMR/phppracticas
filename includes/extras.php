<?php
	function dd($array)
	{
		var_dump($array);
		exit();
	}

	function jd($array)
	{
		echo json_encode($array, true);
		exit();
	}

	function getCurrentUri()
	{
		$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
		$uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
		if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
		$uri = '/' . trim($uri, '/');
		return $uri;
	}

	function secciones()
	{
		chdir("sections");
		$pre = glob("*.php");
		foreach ($pre as $pre2) {
			$sections[] = substr($pre2, 0, -4);
		}
		return $sections;
	}

	function rutas()
	{
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

	function json_objeto($array)
	{
		echo json_encode($array);
	}

	function json_assoc($array)
	{
		echo json_encode($array, true);
	}