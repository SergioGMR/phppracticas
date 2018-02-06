<?php
	
	function conectar_db($servidor, $usuario, $pass, $db) {
		
		$conn = new mysqli($servidor, $usuario, $pass, $db);
		
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		return $conn;
		
	}