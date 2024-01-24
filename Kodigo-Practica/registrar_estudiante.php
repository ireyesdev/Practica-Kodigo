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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php include "./modulos/header.php";  
        require "./clases/Estudiantes.php";

        //instanciamos la clase Estudiantes
        $estudiantes = new Estudiante();
        $arreglo_bootcamps = $estudiantes->getBootcamps();
        //print_r($arreglo_bootcamps);
        $arreglo_materias = $estudiantes->getMaterias();
    ?>
    
    <main id="main">
        <section class="container">
            <h1>Registro de Estudiantes</h1>

            <form action="" method="POST">
                <label for="">Nombre Completo</label>
                <input type="text" class="form-control" name="nombre" required>

                <label for="">Direccion</label>
                <input type="text" class="form-control" name="direccion" required>

                <label for="">Telefono</label>
                <input type="number" class="form-control" name="telefono" required>

                <label for="">Carnet</label>
                <input type="text" class="form-control" name="carnet" required>

                <label for="">Correo</label>
                <input type="text" class="form-control" name="correo" required>

                <label for="">Seleccione Bootcamp</label>
                <select name="bootcamp" class="form-control" id="">
                    <option value="">...</option>
                    <!--- iteramos los bootcamps que hay en la bd -->
                    <?php
                        foreach($arreglo_bootcamps as $bootcamp){
                    ?>
                        <option value="<?php echo $bootcamp["id"]; ?>"><?php echo $bootcamp["bootcamp"]; ?></option>
                    <?php } ?>
                </select>

                <label for="">Seleccione Materias</label><br>
                <?php
                        foreach($arreglo_materias as $materia){
                    ?>
                        <input type="checkbox" name="materias[]" value="<?php echo $materia["id"]; ?>"> <?php echo $materia["materia"]; ?>
                <?php } ?>
                <br>
                <input type="submit" class="btn btn-dark mt-4" value="Guardar Datos">
            </form>

            <?php $estudiantes->guardar(); ?>
        </section>
    </main>
    <?php include "./modulos/footer.php";  ?>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/typed.js/typed.umd.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>