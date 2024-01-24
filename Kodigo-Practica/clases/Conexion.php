<?php

//clase que nos ayudara a conectarnos a la base de datos
class Conexion{
    /**
     * mysqli() / new Mysqli
     * PDO
     */

    public function conectar(){
        try{
            /**
             * gestor de bd,servidor,nombre de bd,usuario, password
             */
            $conexion = "mysql:host=localhost;dbname=sistema_kodigo_fsj19;charset=utf8";
            $opciones = [
                //llamamos la clase PDO para el manejo de excepciones y errores
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false
            ];
    
            //creamos la instancia de PDO (conectarnos), asignamos usuario y password y las opciones para la conexion
            $pdo = new PDO($conexion, "root","",$opciones);
            return $pdo;
            
        }catch(PDOException $e){
            echo "Error de conexion: " . $e->getMessage();
            exit();
        }
    }
}

?>