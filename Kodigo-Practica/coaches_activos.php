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
        $coach = new Coaches();
        $arreglo_coaches = $coach->obtenerCoaches();
        $arreglo_estado = $coach->estadoByAsincronoActivoDesercion();
        $arreglo_bootcamps = $coach->getBootcamps();
    ?>

    <main id="main">
        <section class="container">
            <h1>Gestion de Coaches</h1>

            <a href="./registrar_coach.php" class="btn btn-primary mb-3">Registrar</a>

            <table class="table">
                <thead>
                    <th>Coach</th>
                    <th>Direccion</th>
                    <th>Titulo</th>
                    <th>Correo</th>
                    <th>Materias</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    <?php foreach($arreglo_coaches as $item) { ?>
                    <tr>
                        <td><?php echo $item['nombre']; ?></td>
                        <td><?php echo $item['direccion']; ?></td>
                        <td><?php echo $item['titulo']; ?></td>
                        <td><?php echo $item['correo']; ?></td>
                        <td><?php echo $item['materia']; ?></td>
                        <td><?php echo $item['estado']; ?></td>
                        <td>
                            <form action="./actualizar_coach.php" method="post">
                                <!-- input que captura el id de cada coach -->
                                <input type="hidden" name="id_coach" value="<?php echo $item['id']; ?>">
                                <input type="submit" class="btn btn-primary" value="Editar">
                            </form>
                        </td>
                        <td>
                            <button class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#ModalEstado<?php echo $item['id']; ?>">Estado</button>
                        </td>
                        <td>
                            <button class="btn btn-dark" data-bs-toggle="modal"
                                data-bs-target="#ModalReubicacion<?php echo $item['id']; ?>">Reubicar</button>
                        </td>
                    </tr>

                    <!-- Modal del estado -->
                    <div class="modal fade" id="ModalEstado<?php echo $item['id']; ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cambio de Estado</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="" method="POST">
                                    <div class="modal-body">
                                        <!-- mando el id del coach -->
                                        <input type="hidden" name="id_estudiante" value="<?php echo $item['id']; ?>">

                                        <h5><?php echo $item['nombre']; ?></h5>
                                        <p><strong>Estado: </strong>Activo</p>
                                        <label for="" class="form-label">Cambio de Estado</label>
                                        <select name="estado" id="" class="form-control">
                                            <?php foreach($arreglo_estado as $estado){ ?>
                                            <option value="<?php echo $estado['id']; ?>">
                                                <?php echo $estado['estado']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                        <input type="submit" class="btn btn-danger" value="Cambiar Estado">
                                    </div>
                                </form>

                                <?php $coach->actualizarEstado(); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Modal de reubicaciones-->
                    <div class="modal fade" id="ModalReubicacion<?php echo $item['id']; ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Reubicar Estudiante</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="" method="POST">
                                    <div class="modal-body">
                                        <!-- mando el id del coach -->
                                        <input type="hidden" name="id_estudiante" value="<?php echo $item['id']; ?>">
                                        <h5><?php echo $item['nombre']; ?></h5>
                                        <p><strong>Bootcamp Actual: </strong> <?php echo $item['bootcamp']; ?></p>

                                        <label for="" class="form-label">Cambiar Bootcamp</label>
                                        <select name="bootcamp" class="form-control" id="">
                                            <option value="">...</option>
                                            <!--- iteramos los bootcamps que hay en la bd -->
                                            <?php
                                                    foreach($arreglo_bootcamps as $bootcamp){
                                                ?>
                                            <option value="<?php echo $bootcamp["id"]; ?>">
                                                <?php echo $bootcamp["bootcamp"]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                        <input type="submit" class="btn btn-danger" value="Reubicar Estudiante">
                                    </div>
                                </form>

                                <?php $coach->actualizarReubicacion(); ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </main>
    <?php include "./modulos/footer.php";  ?>

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/typed.js/typed.umd.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>