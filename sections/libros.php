<section class="resume-section p-3 p-lg-5 d-flex flex-column" id="libros">
	<?php
		require_once '../includes/db.php';
		
		$conn = conectar_db('localhost', 'root', '', 'shop');

		$sql = "SELECT book_id, title, author, price FROM books";
		$result = $conn->query($sql);
		$fila[] = $result->fetch_assoc();

		if ($result->num_rows > 0) {
			echo '<table class="table table-dark">';
			echo '<thead>';
			foreach ($fila as $clave => $valor) {
				echo '<tr>';
				foreach ($valor as $c => $v) {
					echo '<th scope="col">' . strtoupper($c) . '</th>';
				}
				echo '<th scope="col">ACCIONES</th>';
			}
			echo '</tr>';
			echo '</thead>';
			echo '<tbody>';

			// output data of each row
			unset($result);
			$result = $conn->query($sql);
			$contador = 0;

			while ($row = $result->fetch_assoc()) {
				$contador++;
				echo '<tr id="' . $contador . '">';
				foreach ($row as $key => $value) {
					echo '<td id="' . $key . '-' . $contador . '">' . $value . '</td>';
				}
				echo '<td><form method="post"><button role="button" name="edit" class="btn btn-warning"><i class="fa fa-pencil"></i></button> | 
                      <button class="btn btn-danger" name="delete"><i class="fa fa-trash"></i></button>
                      </form></td>';
				echo '</tr>';
			}
			echo '</tbody>';
			echo '</table>';
		} else {
			echo "0 results";
		}
		$result->free();
		$conn->close();

	?>
</section>