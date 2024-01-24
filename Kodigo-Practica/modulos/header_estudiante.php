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
        <h1 class="text-light"><a href="#"></a></h1>
        </div>

        <nav id="navbar" class="nav-menu navbar">
        <ul>
            <li>
                <a href="#" class="nav-link scrollto active"><i class="bx bx-home"></i> <span>Home</span></a>
            </li>
            <li>
                <form action="" method="post">
                    <input type="submit" class="btn btn-danger px-2" name="cerrar_sesion" value="Cerrar Sesion">
                </form>

                <?php cerrarSesion(); ?>
            </li>
        </ul>
        </nav>
    </div>
</header>