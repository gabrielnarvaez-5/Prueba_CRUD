<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

// TODO: controlador de productos

require_once('../models/productos.model.php');
error_reporting(0);
$productos = new Productos;

switch ($_GET["op"]) {
    case 'todos': // Cargar todos los datos de los productos
        $datos = array();
        $datos = $productos->todos();
        $todos = [];
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno':
        $producto_id = isset($_GET["producto_id"]) ? $_GET["producto_id"] : null;

        if ($producto_id) {
            $datos = array();
            $datos = $productos->uno($producto_id);
            $res = mysqli_fetch_assoc($datos);
            echo json_encode($res);
        } else {
            echo json_encode(['error' => 'ID del producto no existe']);
        }
        break;

    case 'insertar':
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $precio = $_POST["precio"];
        $stock = $_POST["stock"];

        $datos = array();
        $datos = $productos->insertar($nombre, $descripcion, $precio, $stock);
        echo json_encode($datos);
        break;

    case 'actualizar':
        $producto_id = $_POST["producto_id"];
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $precio = $_POST["precio"];
        $stock = $_POST["stock"];


        $datos = array();
        $datos = $productos->actualizar($producto_id, $nombre, $descripcion, $precio, $stock);
        echo json_encode($datos);
        break;
 
    case 'eliminar':
        $producto_id = $_POST["producto_id"];
        $datos = array();
        $datos = $productos->eliminar($producto_id);
        echo json_encode($datos);
        break;
}
