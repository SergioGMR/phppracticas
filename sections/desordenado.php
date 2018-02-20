<?php require_once '../includes/extras.php' ?>
<section class="resume-section p-3 p-lg-5 d-flex d-column" id="desordenado">
    <div class="my-auto">
		<?php
			$array = generaAssocDesdeDesordenado('../includes/desordenado.txt');
			
			foreach ($array as $key => $value) {
				foreach ($value as $k => $v) {
					echo "<p>Clave $key => $v</p>";
				}
			}
		?>
    </div>
</section>