<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$cedula = (isset($_POST['cedula'])) ? $_POST['cedula'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$apellido = (isset($_POST['apellido'])) ? $_POST['apellido'] : '';
$telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
$direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '';
$correo = (isset($_POST['correo'])) ? $_POST['correo'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO cliente (cedula, nombre, apellido, telefono, direccion, correo) VALUES('$cedula', '$nombre', '$apellido', '$telefono', '$direccion', '$correo') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT id, cedula, nombre, apellido, telefono, direccion, correo FROM cliente ORDER BY idCliente DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE cliente SET cedula='$cedula', nombre='$nombre', apellido='$apellido', telefono='$telefono', direccion='$direccion', correo='$correo' WHERE idCliente='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id, cedula, nombre, apellido, telefono, direccion, correo FROM cliente WHERE idCliente='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM cliente WHERE idCliente='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;  
              
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;