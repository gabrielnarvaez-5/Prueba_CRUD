<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

// TODO: controlador de proveedores

require_once('../models/proveedores.model.php');
error_reporting(0);
$proveedores = new Proveedores;

switch ($_GET["op"]) {
    case 'todos': // Cargar todos los datos de los proveedores
        $datos = array();
        $datos = $proveedores->todos();
        $todos = [];
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'buscarPorNombre':
        $nombre = isset($_GET["nombre"]) ? $_GET["nombre"] : '';
        
        if ($nombre) {
            $datos = $proveedores->buscarPorNombre($nombre);
            $resultados = array();
            while ($row = mysqli_fetch_assoc($datos)) {
                $resultados[] = $row;
            }
            header('Content-Type: application/json');
            echo json_encode($resultados);
        } else {
            echo json_encode([]);
        }
        break;


    case 'insertar':
        $nombre = $_POST["nombre"];
        $direccion = $_POST["direccion"];
        $telefono = $_POST["telefono"];
        $email = $_POST["email"];

        $datos = array();
        $datos = $proveedores->insertar($nombre, $direccion, $telefono, $email);
        echo json_encode($datos);
        break;

    case 'actualizar':
        $proveedor_id = $_POST["proveedor_id"];
        $nombre = $_POST["nombre"];
        $direccion = $_POST["direccion"];
        $telefono = $_POST["telefono"];
        $email = $_POST["email"];

        $datos = array();
        $datos = $proveedores->actualizar($proveedor_id, $nombre, $direccion, $telefono, $email);
        echo json_encode($datos);
        break;

    case 'eliminar':
        $proveedor_id = $_POST["proveedor_id"];
        $datos = array();
        $datos = $proveedores->eliminar($proveedor_id);
        echo json_encode($datos);
        break;
}
