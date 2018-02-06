<section class="resume-section p-3 p-lg-5 d-flex flex-column" id="precios">
	<?php
		require_once '../includes/extras.php';
		require_once '../includes/db.php';
		
		$conn = conectar_db('localhost', 'root', '', 'colegio');
		
		$sql = "SELECT g.nombre grupo, a.nombre nombre, a.apellidos apellidos, a.nacimiento fecha
				FROM alumnos a INNER JOIN grupos g
				ON a.id_grupo = g.id
				ORDER BY a.id_grupo";
		
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			
			$grupo_anterior = "";
			$primera = true;
			
			$total = $contador = $edades = $contadorTotal = 0;
			
			echo '<table class="table table-info"><tbody>';
			
			while ($fila = $result->fetch_assoc()) {
				
				if ($primera) {
					$primera = false;
					$grupo_anterior = $fila['grupo'];
					echo "<tr><td>" . $fila['grupo'] . "</td></tr>";
					
				}
				
				if ($fila['grupo'] != $grupo_anterior) {
					$grupo_anterior = $fila['grupo'];
					
					echo "<tr ><td></td><td class='bg-light'>Media de la clase </td><td class='bg-light'>" . $media . "</td></tr>";
					echo "<tr><td>" . $fila['grupo'] . "</td></tr>";
					
					$total += $edades;
					$contadorTotal += $contador;
					$contador = 0;
					$edades = 0;
					
				}
				
				$edad = busca_edad($fila['fecha']);
				
				echo "<tr><td></td><td>" . strtoupper($fila['nombre']) . " " . strtoupper($fila['apellidos']) . "</td><td>" . $edad . "</td></tr>";
				$edades += $edad;
				$contador++;
				$media = (int)($edades / $contador);
			}
			echo "<tr ><td></td><td class='bg-light'> subtotal </td><td class='bg-light'>" . $media . "</td></tr>";
			$total += $edades;
			$contadorTotal += $contador;
			$mediaTotal = (int)($total / $contadorTotal);
			echo "<tr><td></td><td class='bg-success text-dark'> Media total </td><td class='bg-success text-dark'>" . $mediaTotal . "</td></tr>";
			echo "</tbody></table>";
		}
		
		$result->free();
		$conn->close();
	
	?>
</section>