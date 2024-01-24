<?php 
    //iniciando la sesion
    session_start();

    if(!isset($_SESSION['id_estudiante'])){
        include "./notFound.php";
    }else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>SISTEMA ACADEMIA KODIGO</title>
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php include "./modulos/header_estudiante.php";  
		require "./clases/Estudiantes.php";
		$estudiante = new Estudiante();
		$arreglo = $estudiante->verPerfil();
	?>
    <main id="main">
	<div class="container-fluid testimonial py-4">
		<div class="container py-5">
			<div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
				<h5 class="text-primary">Kodigo</h5>
				<h1>Perfil Estudiantil!</h1>
			</div>
			<?php foreach($arreglo as $alumno){ ?>
				<div class="testimonial-item border p-4">
					<div class="d-flex align-items-center">
						<div class="">
							<img src="./assets/img/programador.png" alt="">
						</div>
						<div class="ms-4">
							<h4 class="text-secondary"><?php echo $alumno['nombre']; ?></h4>
							<p class="m-0 pb-3"><?php echo $alumno['carnet']; ?></p>
							<p class="m-0 pb-3"><?php echo $alumno['bootcamp']; ?></p>
						</div>
					</div>
					<div class="border-top mt-4 pt-3">
						<p class="mb-0"><strong>Direccion: </strong> <?php echo $alumno['direccion']; ?></p>
						<p class="mb-0"><strong>Telefono: </strong> <?php echo $alumno['telefono']; ?></p>
						<p class="mb-0"><strong>Correo: </strong> <?php echo $alumno['correo']; ?></p>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</main>
    
    <?php include "./modulos/footer.php";  ?>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/typed.js/typed.umd.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>

<?php } ?>