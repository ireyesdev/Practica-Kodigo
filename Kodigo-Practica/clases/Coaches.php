<?php

require "./clases/Conexion.php";

class Coaches extends Conexion{
    //asignamos los atributos de la tabla coachs
    protected $id;
    protected $nombre;
    protected $direccion;
    protected $titulo;
    protected $correo;
    protected $password;
    protected $id_bootcamp;
    protected $id_materia;

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

    #metodo para guardar al coach y sus materias
    public function guardar(){

        //isset()
        if(isset($_POST['nombre'], $_POST['direccion'], $_POST['titulo'], $_POST['correo'],$_POST['materia'], $_POST['bootcamps'])){
            
            //asignacion de los atributos con los datos del form y bd
            $this->nombre = $_POST['nombre'];
            $this->direccion = $_POST['direccion'];
            $this->titulo = $_POST['titulo'];
            $this->correo = $_POST['correo'];
            $this->password = "Kodigo2024";
            $this->id_materia = $_POST['materia'];
            $this->id_bootcamp = $_POST['bootcamps'];


            #el estado 1 hace referencia a "activo"
            $estado = 1;
            #el rol 2 hace referencia a "coaches"
            $rol = 2;

            $pdo = $this->conectar();
            //insertar al coach
            $query1 = $pdo->prepare("INSERT INTO coaches(nombre,direccion,titulo,correo,password,id_materia,id_estado,id_rol) VALUES (?,?,?,?,?,?,?,?)");
            #el signo de ? va hacer referencia al argumento (valor) que voy a colocar para cada campo / nombre = ?

            #mandamos los valores del form a la consulta del insert en un arreglo y ejecutamos
            $resultado = $query1->execute(["$this->nombre","$this->direccion","$this->titulo","$this->correo","$this->password","$this->id_materia","$estado","$rol"]);

            #condicionamos si la consulta fue un exito (si lo fue, mandamos a llamar el ultimo id del coach)

            //true / false
            if($resultado){
                #consulta para devolver el ultimo id del coach
                $query2 = $pdo->query("SELECT id FROM coaches ORDER BY id DESC LIMIT 1");
                //ejecutar la consulta
                $query2->execute(); //objeto (id = valor)
                #asignamos el resultado de la consulta en un arreglo
                $coach = $query2->fetch(PDO::FETCH_ASSOC);
                //$alumno = ["id" => 100]
                //capturamos el valor del id
                $id_coaches = $coach["id"]; //100

                #iteramos el arreglo de las materias para guardar en la tabla de detalle
                $arreglo_bootcamps = $_POST['bootcamps'];
                for($i = 0; $i < count($arreglo_bootcamps); $i++){
                    #registramos en la tabla detalle por cada iteracion
                    $query3 = $pdo->prepare("INSERT INTO detalle_bootcamp_coach(id_coach, id_bootcamp) VALUES (?,?)");

                    $query3->execute([$id_coaches, $arreglo_bootcamps[$i]]);
                }

                //redireccionando a la vista de la tabla de coaches

                //header('location = ./coaches_activos.php');
                echo "<script>
                    window.location = './coaches_activos.php'
                </script>";
            }
        }
    }

    #metodo para obtener todos los coachs activos, asincronos, reubicacion
    public function obtenerCoaches(){
        $pdo = $this->conectar();

        $query = $pdo->query("SELECT coaches.id, coaches.nombre, coaches.direccion, coaches.titulo, coaches.correo, materias.materia, estado.estado FROM coaches INNER JOIN materias ON coaches.id_materia = materias.id INNER JOIN estado ON coaches.id_estado = estado.id WHERE estado.estado != 'desercion'");

        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC); //arreglo de objetos
        return $resultado;
    }

    #metodo para obtener un coach por id
    public function obtenerById(){
        if(isset($_POST['id_coach'])){
            $this->id = $_POST['id_coach'];

            $pdo = $this->conectar();
            $query = $pdo->query("SELECT id, nombre, direccion, titulo, correo FROM coaches WHERE id = $this->id");

            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC); //arreglo de objetos
            return $resultado;
        }
    }

    #metodo para actualizar coach por su id
    public function actualizar(){
        if(isset($_POST['id_coach'], $_POST['nombre'], $_POST['direccion'], $_POST['titulo'], $_POST['correo'])){
            $this->nombre = $_POST['nombre'];
            $this->direccion = $_POST['direccion'];
            $this->titulo = $_POST['titulo'];
            $this->correo = $_POST['correo'];
            $this->id = $_POST['id_coach'];

            $pdo = $this->conectar();
            $query = $pdo->prepare("UPDATE coaches SET nombre = ?, direccion = ?, titulo = ?, correo = ? WHERE id = ?");

            $resultado = $query->execute(["$this->nombre","$this->direccion","$this->titulo","$this->correo","$this->id"]);

            //si es un exito (true) redireccionamos a la vista de los coachs
            if($resultado){
                echo "<script>
                    window.location = './coaches_activos.php'
                </script>";
            }else{
                echo "Error al actualizar al coach";
            }
        }
    }

    #metodo para seleccionar el estado
    public function estadoByAsincronoActivoDesercion(){
        $pdo = $this->conectar();
        $query = $pdo->query("SELECT * FROM estado WHERE id = 5 OR id = 4 OR id = 1");
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC); //[]
        return $resultado;
    }

    #actualizando el estado del coach
    public function actualizarEstado(){
        if(isset($_POST['id_coach'], $_POST['estado'])){
            $this->id = $_POST['id_coach'];
            $estado = $_POST['estado'];

            $pdo = $this->conectar();
            $query = $pdo->prepare("UPDATE coaches SET id_estado = ? WHERE id = ?");
            $resultado = $query->execute([$estado,$this->id]); //true o false
            //true
            if($resultado){
                echo "<script>
                    window.location = './coaches_activos.php'
                </script>";
            }else{
                echo "Error al cambiar el estado";
            }
        }
    }

    #actualizando el estado del coach
    public function actualizarReubicacion(){
        if(isset($_POST['id_coach'], $_POST['bootcamp'])){
            $this->id = $_POST['id_coach'];
            $estado = 3; //representa en la bd a "reubicacion"
            $this->id_bootcamp = $_POST['bootcamp'];

            $pdo = $this->conectar();
            $query = $pdo->prepare("UPDATE coachs SET id_estado = ?, id_bootcamp = ? WHERE id = ?");
            $resultado = $query->execute([$estado,$this->id_bootcamp,$this->id]); //true o false
            //true
            if($resultado){
                echo "<script>
                    window.location = './coachs_activos.php'
                </script>";
            }else{
                echo "Error al reubicar el coach";
            }
        }
    }

    #perfil del coach en base al inicio de sesion
    public function verPerfil(){
        /**SELECT coachs.nombre, coachs.carnet, coachs.direccion, coachs.telefono, coachs.correo, bootcamps.bootcamp FROM coachs INNER JOIN bootcamps ON coachs.id_bootcamp = bootcamps.id WHERE coachs.id = $_SESSION['id_coach']; */

        $id = $_SESSION['id_coach'];
        $pdo = $this->conectar();
        $query = $pdo->query("SELECT coaches.nombre, coaches.direccion, coaches.titulo, coaches.correo, materias.materia FROM coaches INNER JOIN materias ON coaches.id_materia = materias.id WHERE coaches.id = $id");
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC); //[]
        return $resultado;
    }
}

?>