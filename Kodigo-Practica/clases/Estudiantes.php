<?php

require "./clases/Conexion.php";

class Estudiante extends Conexion{
    //asignamos los atributos de la tabla estudiantes
    protected $id;
    protected $nombre;
    protected $direccion;
    protected $telefono;
    protected $carnet;
    protected $correo;
    protected $password;
    protected $id_bootcamp;

    //metodo para obtener los bootcamps
    public function getBootcamps(){
        //llamamos el metodo que contiene la informacion de la base de datos
        $pdo = $this->conectar();
        //select * from table

        //generamos la consulta sql
        $consulta = $pdo->query("SELECT * FROM bootcamps");
        //ejecutando la consulta sql
        $consulta->execute(); //me manda un arreglo de los bootcamps que hay en la base de datos []

        //asignamos en php que la informacion de la consulta es un arreglo que vamos a iterar
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC); //arreglo de objetos
        return $resultado;
    }

    //metodo para obtener materia
    public function getMaterias(){
        //llamamos el metodo que contiene la informacion de la base de datos
        $pdo = $this->conectar();
        //select * from table

        //generamos la consulta sql
        $consulta = $pdo->query("SELECT * FROM materias");
        //ejecutando la consulta sql
        $consulta->execute(); 
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC); //arreglo de objetos
        return $resultado;
    }

    #metodo para guardar al estudiante y sus materias
    public function guardar(){

        //isset()
        if(isset($_POST['nombre'], $_POST['direccion'], $_POST['telefono'], $_POST['carnet'], $_POST['correo'], $_POST['bootcamp'], $_POST['materias'])){
            
            //asignacion de los atributos con los datos del form y bd
            $this->nombre = $_POST['nombre'];
            $this->direccion = $_POST['direccion'];
            $this->telefono = $_POST['telefono'];
            $this->carnet = $_POST['carnet'];
            $this->correo = $_POST['correo'];
            #asignamos un password por default para el estudiante
            $this->password = "Kodigo2023";
            $this->id_bootcamp = $_POST['bootcamp'];
            #el estado 1 hace referencia a "activo"
            $estado = 1;
            #el rol 3 hace referencia a "estudiante"
            $rol = 3;

            $pdo = $this->conectar();
            //insertar al estudiante
            $query1 = $pdo->prepare("INSERT INTO estudiantes(nombre,direccion,telefono,carnet,correo,password,id_bootcamp,id_estado,id_rol) VALUES (?,?,?,?,?,?,?,?,?)");
            #el signo de ? va hacer referencia al argumento (valor) que voy a colocar para cada campo / nombre = ?

            #mandamos los valores del form a la consulta del insert en un arreglo y ejecutamos
            $resultado = $query1->execute(["$this->nombre","$this->direccion","$this->telefono","$this->carnet","$this->correo","$this->password","$this->id_bootcamp","$estado","$rol"]);

            #condicionamos si la consulta fue un exito (si lo fue, mandamos a llamar el ultimo id del estudiante)

            //true / false
            if($resultado){
                #consulta para devolver el ultimo id del estudiante
                $query2 = $pdo->query("SELECT id FROM estudiantes ORDER BY id DESC LIMIT 1");
                //ejecutar la consulta
                $query2->execute(); //objeto (id = valor)
                #asignamos el resultado de la consulta en un arreglo
                $alumno = $query2->fetch(PDO::FETCH_ASSOC);
                //$alumno = ["id" => 100]
                //capturamos el valor del id
                $id_estudiante = $alumno["id"]; //100

                #iteramos el arreglo de las materias para guardar en la tabla de detalle
                $arreglo_materias = $_POST['materias'];
                for($i = 0; $i < count($arreglo_materias); $i++){
                    #registramos en la tabla detalle por cada iteracion
                    $query3 = $pdo->prepare("INSERT INTO detalle_estudiante_materia(id_estudiante, id_materia) VALUES (?,?)");

                    $query3->execute([$id_estudiante, $arreglo_materias[$i]]);
                }

                //redireccionando a la vista de la tabla de estudiantes

                //header('location = ./estudiantes_activos.php');
                echo "<script>
                    window.location = './estudiantes_activos.php'
                </script>";
            }
        }
    }

    #metodo para obtener todos los estudiantes activos, asincronos, reubicacion
    public function obtenerEstudiantes(){
        $pdo = $this->conectar();

        $query = $pdo->query("SELECT estudiantes.id, estudiantes.nombre, estudiantes.carnet, estudiantes.correo, bootcamps.bootcamp, estado.estado FROM estudiantes INNER JOIN bootcamps ON estudiantes.id_bootcamp = bootcamps.id INNER JOIN estado ON estudiantes.id_estado = estado.id WHERE estado.estado != 'desercion'");

        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC); //arreglo de objetos
        return $resultado;
    }

    #metodo para obtener un estudiante por id
    public function obtenerById(){
        if(isset($_POST['id_estudiante'])){
            $this->id = $_POST['id_estudiante'];

            $pdo = $this->conectar();
            $query = $pdo->query("SELECT id, nombre, direccion, telefono, correo FROM estudiantes WHERE id = $this->id");

            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC); //arreglo de objetos
            return $resultado;
        }
    }

    #metodo para actualizar estudiante por su id
    public function actualizar(){
        if(isset($_POST['id_estudiante'], $_POST['nombre'], $_POST['direccion'], $_POST['telefono'], $_POST['correo'])){
            $this->nombre = $_POST['nombre'];
            $this->direccion = $_POST['direccion'];
            $this->telefono = $_POST['telefono'];
            $this->correo = $_POST['correo'];
            $this->id = $_POST['id_estudiante'];

            $pdo = $this->conectar();
            $query = $pdo->prepare("UPDATE estudiantes SET nombre = ?, direccion = ?, telefono = ?, correo = ? WHERE id = ?");

            $resultado = $query->execute(["$this->nombre","$this->direccion","$this->telefono","$this->correo","$this->id"]);

            //si es un exito (true) redireccionamos a la vista de los estudiantes
            if($resultado){
                echo "<script>
                    window.location = './estudiantes_activos.php'
                </script>";
            }else{
                echo "Error al actualizar al estudiante";
            }
        }
    }

    #metodo para seleccionar el estado
    public function estadoByAsincronoActivoDesercion(){
        $pdo = $this->conectar();
        $query = $pdo->query("SELECT * FROM estado WHERE id = 2 OR id = 4 OR id = 1");
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC); //[]
        return $resultado;
    }

    #actualizando el estado del estudiante
    public function actualizarEstado(){
        if(isset($_POST['id_estudiante'], $_POST['estado'])){
            $this->id = $_POST['id_estudiante'];
            $estado = $_POST['estado'];

            $pdo = $this->conectar();
            $query = $pdo->prepare("UPDATE estudiantes SET id_estado = ? WHERE id = ?");
            $resultado = $query->execute([$estado,$this->id]); //true o false
            //true
            if($resultado){
                echo "<script>
                    window.location = './estudiantes_activos.php'
                </script>";
            }else{
                echo "Error al cambiar el estado";
            }
        }
    }

    #actualizando el estado del estudiante
    public function actualizarReubicacion(){
        if(isset($_POST['id_estudiante'], $_POST['bootcamp'])){
            $this->id = $_POST['id_estudiante'];
            $estado = 3; //representa en la bd a "reubicacion"
            $this->id_bootcamp = $_POST['bootcamp'];

            $pdo = $this->conectar();
            $query = $pdo->prepare("UPDATE estudiantes SET id_estado = ?, id_bootcamp = ? WHERE id = ?");
            $resultado = $query->execute([$estado,$this->id_bootcamp,$this->id]); //true o false
            //true
            if($resultado){
                echo "<script>
                    window.location = './estudiantes_activos.php'
                </script>";
            }else{
                echo "Error al reubicar el estudiante";
            }
        }
    }

    #perfil del estudiante en base al inicio de sesion
    public function verPerfil(){
        /**SELECT estudiantes.nombre, estudiantes.carnet, estudiantes.direccion, estudiantes.telefono, estudiantes.correo, bootcamps.bootcamp FROM estudiantes INNER JOIN bootcamps ON estudiantes.id_bootcamp = bootcamps.id WHERE estudiantes.id = $_SESSION['id_estudiante']; */

        $id = $_SESSION['id_estudiante'];
        $pdo = $this->conectar();
        $query = $pdo->query("SELECT estudiantes.nombre, estudiantes.carnet, estudiantes.direccion, estudiantes.telefono, estudiantes.correo, bootcamps.bootcamp FROM estudiantes INNER JOIN bootcamps ON estudiantes.id_bootcamp = bootcamps.id WHERE estudiantes.id = $id");
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC); //[]
        return $resultado;
    }
}

?>