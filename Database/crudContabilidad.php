<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
$servicio = (isset($_POST['servicio'])) ? $_POST['servicio'] : '';
$detalle = (isset($_POST['detalle'])) ? $_POST['detalle'] : '';
$tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
$precio = (isset($_POST['precio'])) ? $_POST['precio'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO contabilidad (fecha, servicio, detalle, tipo, precio) VALUES('$fecha', '$servicio', '$detalle', '$tipo', '$precio') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT id, fecha, servicio, detalle, tipo, precio FROM contabilidad ORDER BY idContabilidad DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE contabilidad SET fecha='$fecha', servicio='$servicio', detalle='$detalle', tipo='$tipo', ='precio$precio' WHERE idContabilidad='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id, fecha, servicio, detalle, tipo, precio FROM contabilidad WHERE idContabilidad='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM contabilidad WHERE idContabilidad='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
