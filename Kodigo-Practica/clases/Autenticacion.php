<?php  
require "./clases/Conexion.php";

class Autenticacion extends Conexion{
    protected $correo;
    protected $password;

    public function autenticarUsuario(){
        if(isset($_POST['email'], $_POST['password'])){
            $this->correo = $_POST['email'];
            $this->password = $_POST['password'];

            //nombre, correo, password, id, id_rol
            //select * from admin where correo = ? and password = ?
            $pdo = $this->conectar();

            //consulta administrador
            $query = $pdo->prepare("SELECT * FROM admin WHERE correo = ? AND password = ?");
            $query->execute(["$this->correo","$this->password"]);
            $usuario_admin = $query->fetch(PDO::FETCH_ASSOC); //[]
            //print_r($usuario_admin);

            //consulta estudiante
            $query2 = $pdo->prepare("SELECT id, nombre, correo, password, id_rol FROM estudiantes WHERE correo = ? AND password = ?");
            $query2->execute(["$this->correo","$this->password"]);
            $usuario_estudiante = $query2->fetch(PDO::FETCH_ASSOC);

            //consulta coach
            $query2 = $pdo->prepare("SELECT id, nombre, correo, password, id_rol FROM coaches WHERE correo = ? AND password = ?");
            $query2->execute(["$this->correo","$this->password"]);
            $usuario_coach = $query2->fetch(PDO::FETCH_ASSOC);


            //condicionamos si existe un arreglo con la info del usuario
            if(is_array($usuario_admin)){
                //crear las sesiones
                $_SESSION['nombre_admin'] = $usuario_admin['nombre'];
                $_SESSION['id_admin'] =  $usuario_admin['id'];

                header("location: ./home_admin.php");
            }else if(is_array($usuario_estudiante)){
                //crear las sesiones
                $_SESSION['nombre_estudiante'] = $usuario_estudiante['nombre'];
                $_SESSION['id_estudiante'] =  $usuario_estudiante['id'];

                header("location: ./home_estudiante.php");
            }else if(is_array($usuario_coach)){
                //crear las sesiones
                $_SESSION['nombre_coach'] = $usuario_coach['nombre'];
                $_SESSION['id_coach'] =  $usuario_coach['id'];

                header("location: ./home_coach.php");

            }else{
                echo "<div class='alert alert-danger' role='alert'>
                    Tus credenciales son incorrectas
                </div>";
            }
        }
    }
}

?>