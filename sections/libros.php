<section class="resume-section p-3 p-lg-5 d-flex flex-column" id="libros">
	<?php
		require_once '../includes/db.php';

		$sql = "SELECT book_id, title, author, price FROM books";
		$result = $conn->query($sql);
		$fila[] = $result->fetch_assoc();

		if ($result->num_rows > 0) {
			echo '<table class="table table-dark">';
			echo '<thead>';
			foreach ($fila as $clave => $valor) {
				echo '<tr>';
				foreach ($valor as $c => $v) {
					echo '<th scope="col">' . $c . '</th>';
				}
			}
			echo '</tr>';
			echo '</thead>';
			echo '<tbody>';
			// output data of each row
			while ($row = $result->fetch_assoc()) {
				echo '<tr>';
				foreach ($row as $key => $value) {
					echo '<td>' . $value . '</td>';
				}
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