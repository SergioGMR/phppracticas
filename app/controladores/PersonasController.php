<?php
	
	namespace App\Controladores;
	
	use App\Modelos\Persona;
	
	class PersonasController {
		
		public function test($nombre, $nif) {
			
			$persona = new Persona($nombre, $nif);
			return $persona;
		}
		
	}