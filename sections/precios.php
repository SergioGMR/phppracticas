<section class="resume-section p-3 p-lg-5 d-flex flex-column" id="precios">
	<?php
		require_once '../includes/extras.php';
		require_once '../includes/db.php';
		
		$conn = conectar_db('localhost', 'root', '', 'shop');
		
		
		$sql = "SELECT c.category_name cat, b.title titulo, b.price precio
				FROM books b INNER JOIN categories c
				ON b.category_id = c.category_id";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			
			$cat_ant = "";
			$subtotal = 0;
			$contador = 0;
			$total = 0;
			$primera = true;
			
			echo '<table class="table table-dark">';
			
			while ($fila = $result->fetch_assoc()) {
				
				
				if ($primera) {
					$primera = false;
					$cat_ant = $fila['cat'];
					echo "<tr><td>" . $fila['cat'] . "</td></tr>";
					
				}
				
				if (($fila['cat'] != $cat_ant) && !$primera) {
					$cat_ant = $fila['cat'];
					
					echo "<tr><td></td><td class='bg-light text-dark'>SUBTOTAL: </td><td class='bg-light text-dark'>" . $subtotal . " €</td></tr>";
					echo "<tr><td>" . $fila['cat'] . "</td></tr>";
					
					$total += $subtotal;
					$subtotal = 0;
				}
				echo "<tr><td></td><td>" . $fila['titulo'] . "</td><td>" . $fila['precio'] . " €</td></tr>";
				$subtotal += (float)$fila['precio'];
			}
			$total += $subtotal;
			echo "<tr><td></td><td class='bg-light text-dark'>SUBTOTAL: </td><td class='bg-light text-dark'>" . $subtotal . " €</td></tr>";
			echo "<tr><td></td><td class='bg-info text-dark'>TOTAL: </td><td class='bg-info text-dark'>" . $total . " €</td></tr>";
			echo '</table>';
		}
		
		$result->free();
		$conn->close();
	
	?>
</section>