<?php
// Incluye la configuración de la base de datos
require_once('../config/config.php');

class Proveedores
{
    // Obtener todos los proveedores
    public function todos()
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `Proveedores`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Buscar proveedores por nombre
    public function buscarPorNombre($nombre)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();

        // Usar LIKE 
        $nombre = mysqli_real_escape_string($con, $nombre);
        $cadena = "SELECT * FROM `Proveedores` WHERE `nombre` LIKE '%$nombre%'";
        $datos = mysqli_query($con, $cadena);
        
        $con->close();
        return $datos;
    }


    // Insertar un nuevo proveedor
    public function insertar($nombre, $direccion, $telefono, $email)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `Proveedores` (`nombre`, `direccion`, `telefono`, `email`) VALUES ('$nombre', '$direccion', '$telefono', '$email')";
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

    // Actualizar la información de un proveedor
    public function actualizar($proveedor_id, $nombre, $direccion, $telefono, $email)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `Proveedores` SET `nombre`='$nombre', `direccion`='$direccion', `telefono`='$telefono', `email`='$email' WHERE `proveedor_id` = $proveedor_id";
            if (mysqli_query($con, $cadena)) {
                return $proveedor_id;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    // Eliminar un proveedor
    public function eliminar($proveedor_id)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `Proveedores` WHERE `proveedor_id` = $proveedor_id";
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
        $cadena = "SELECT * FROM `Productos` WHERE `producto_id` = $producto_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Insertar un nuevo producto
    public function insertar($nombre, $descripcion, $precio, $stock, $proveedor_id)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `Productos` (`nombre`, `descripcion`, `precio`, `stock`, `proveedor_id`) VALUES ('$nombre', '$descripcion', $precio, $stock, $proveedor_id)";
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
    public function actualizar($producto_id, $nombre, $descripcion, $precio, $stock, $proveedor_id)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `Productos` SET `nombre`='$nombre', `descripcion`='$descripcion', `precio`=$precio, `stock`=$stock, `proveedor_id`=$proveedor_id WHERE `producto_id` = $producto_id";
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
