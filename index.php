<?php require_once 'includes/extras.php' ?>
<?php require_once 'routes.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
	<?php require_once 'includes/favicons.php' ?>

    <title>SergioGMR | PHP</title>

	<?php require_once 'includes/css.php' ?>
    <!-- Bootstrap core JavaScript -->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

</head>

<body id="page-top">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
    <a class="navbar-brand js-scroll-trigger" href="/">
        <span class="d-block d-lg-none">Inicio</span>
        <span class="d-none d-lg-block">
          <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="/img/familyguy.png" alt="">
        </span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
			<?php
				foreach ($sections as $section) {
					echo '<li class="nav-item">';
					echo '<a class="nav-link js-scroll-trigger" href="/' . $section . '">' . strtoupper($section) . '</a>';
					echo '</li>';
				}
			?>
        </ul>
    </div>
</nav>

<div class="container-fluid p-0">

	<?php
		try {
			if (!empty($seccion)) {
				if (isset($seccion)) {
					include "sections/" . $seccion . ".php";
				} else {
					include '404.php';
				}
			} else {
				include "sections/about.php";
			}
		} catch (Exception $exception) {

		}
	?>
</div>
<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Custom scripts for this template -->
<script src="/js/resume.min.js"></script>
</body>

</html>
