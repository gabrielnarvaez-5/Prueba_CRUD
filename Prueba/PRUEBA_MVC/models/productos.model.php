<?php
// Incluye la configuración de la base de datos
require_once('../config/config.php');

class Productos
{
    // Obtener todos los productos
    public function todos()
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `Productos`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Obtener un producto por ID
    public function uno($producto_id)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `Productos` WHERE `producto_id` = '$producto_id'";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Insertar un nuevo producto
    public function insertar($nombre, $descripcion, $precio, $stock)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `Productos` (`nombre`, `descripcion`, `precio`, `stock`) VALUES ('$nombre', '$descripcion', $precio, $stock)";
            if (mysqli_query($con, $cadena)) {
                return $con->insert_id;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    // Actualizar un producto
    public function actualizar($producto_id, $nombre, $descripcion, $precio, $stock)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `Productos` SET `nombre`='$nombre', `descripcion`='$descripcion', `precio`=$precio, `stock`=$stock WHERE `producto_id` = $producto_id";
            if (mysqli_query($con, $cadena)) {
                return $producto_id;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    // Eliminar un producto
    public function eliminar($producto_id)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `Productos` WHERE `producto_id` = $producto_id";
            if (mysqli_query($con, $cadena)) {
                return 1;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
}
?>
