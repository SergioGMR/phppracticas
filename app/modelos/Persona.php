<?php
	
	namespace App\Modelos;
	
	
	class Persona {
		private $nombre;
		private $nif;
		
		public function __construct($nombre, $nif) {
			$this->nombre = (string)$nombre;
			$this->nif = (int)$nif;
		}
	}
