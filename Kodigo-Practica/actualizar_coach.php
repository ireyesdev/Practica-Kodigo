<?php 
    //iniciando la sesion
    session_start();
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
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php include "./modulos/header.php";  
        require "./clases/Coaches.php";

        //instanciamos la clase Estudiantes
        $coaches = new Coaches();
        $datos = $coaches->obtenerById();
    ?>

    <main id="main">
        <section class="container">
            <h1>Editar Datos</h1>

            <form action="" method="POST">
                <?php foreach($datos as $coach) { ?>

                <input type="hidden" name="id_coach" value="<?php echo $coach['id']; ?>">

                <label for="">Nombre Completo</label>
                <input type="text" class="form-control" name="nombre" value="<?php echo $coach["nombre"]; ?>">

                <label for="">Direccion</label>
                <input type="text" class="form-control" name="direccion" value="<?php echo $coach["direccion"]; ?>">

                <label for="">Titulo</label>
                <input type="text" class="form-control" name="titulo" value="<?php echo $coach["titulo"]; ?>">

                <label for="">Correo</label>
                <input type="text" class="form-control" name="correo" value="<?php echo $coach["correo"]; ?>">

                <input type="submit" class="btn btn-dark mt-4" value="Actualizar Datos">

                <?php } ?>
            </form>

            <?php $coaches->actualizar(); ?>
        </section>
    </main>
    <?php include "./modulos/footer.php";  ?>

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/typed.js/typed.umd.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>