<?php
    //metodo para cerrar sesion
    function cerrarSesion(){
        if(isset($_POST['cerrar_sesion'])){
            //destruimos las sesiones creadas (nombre_admin, id_admin)
            session_destroy();
            header("location: ./index.php");
        }
    }
?>
<i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

<header id="header">
    <div class="d-flex flex-column">

        <div class="profile">
            <img src="assets/img/profile-logo.png" alt="" class="img-fluid rounded-circle">
            <!-- mandamos a llamar la session que tiene el nombre del usuario -->
            <h1 class="text-light"><a href="#"></a><?php echo $_SESSION['nombre_admin']; ?></h1>
        </div>

        <nav id="navbar" class="nav-menu navbar">
            <ul>
                <li>
                    <a href="../home_admin.php" class="nav-link scrollto active"><i class="bx bx-home"></i>
                        <span>Home</span></a>
                </li>
                <li>
                    <a href="./estudiantes_activos.php" class="nav-link scrollto"><i class="bx bxs-user-detail"></i>
                        <span>Gestion Estudiantes</span></a>
                </li>
                <li>
                    <a href="./coaches_activos.php" class="nav-link scrollto"><i class="bx bx-book-content"></i>
                        <span>Gestion Profesores</span></a>
                </li>
                <li>
                <div class="row justify-content-center align-items-center">
                    <div class ="col-auto">
                        <form action="" method="post">
                            <input type="submit" class="btn btn-danger px-2" name="cerrar_sesion" value="Cerrar Sesion">
                        </form>
                    </div>
                </div>
                    <?php cerrarSesion(); ?>
                </li>
            </ul>
        </nav>
    </div>
</header>