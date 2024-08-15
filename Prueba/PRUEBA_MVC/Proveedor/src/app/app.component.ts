//-------------------------------------------------------------------------

import { Component, OnInit } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { ProveedorService } from './Services/proveedor.service';
import { ProductosService } from './Services/productos.service';
import { Proveedor } from './Interfaces/proveedor';
import { Productos } from './Interfaces/productos';

//import Swal from 'sweetalert2';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [RouterOutlet],
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
})
export class AppComponent implements OnInit {
  title = 'Lista de Proveedores';

  listaProveedores: Proveedor[] = [];
  listaProductos: Productos[] = []; 
  proveedorEncontrado: Proveedor | null = null;
  productoEncontrado: Productos | null = null;

  constructor(
    private servicioProveedor: ProveedorService,
    private servicioProducto: ProductosService
  ) {}

  ngOnInit() {
    this.cargarProveedores();
    this.cargarProductos();
    const initialId = '123'; // ID inicial
    this.buscarProductoPorId(initialId);
    this.buscarProveedorPorNombre(initialId);
  }

  // Proveedores
  cargarProveedores() {
    this.servicioProveedor.todos().subscribe((data) => {
      this.listaProveedores = data;
    });
  }

  eliminarProveedor(idProveedor: number) {
    this.servicioProveedor.eliminar(idProveedor).subscribe(() => {
      this.cargarProveedores();
    });
  }

  actualizarProveedor(id: number, nombre: string, direccion: string, telefono: string, email: string) {
    const proveedor: Proveedor = {
      proveedor_id: id,
      nombre,
      direccion,
      telefono,
      email
    };

    this.servicioProveedor.actualizar(proveedor).subscribe({
      next: (response) => {
        console.log('Proveedor actualizado:', response);
        alert('Proveedor actualizado exitosamente');
      },
      error: (error) => {
        alert('Error al actualizar proveedor');
        console.error('Error al actualizar proveedor:', error);
      }
    });
  }

  verDescripcionProv(event: Event, proveedor: Proveedor) {
    const input = event.target as HTMLInputElement;
    proveedor.email = input.value;
  }

  buscarProveedorPorNombre(nombre: string) {
    this.servicioProveedor.buscarPorNombre(nombre).subscribe({
      next: (data) => {
        console.log("Proveedor encontrado:", data);
        this.proveedorEncontrado = data;
      },
      error: (error) => {
        console.error("Error al buscar proveedor:", error);
        this.proveedorEncontrado = null; // En caso de error, no hay proveedor
      }
    });
  }

  insertarProveedor(nombre: string, direccion: string, telefono: string, email: string) {
    console.log("nombre: ",nombre, " Direccion: ",direccion)
    const nuevoProveedor: Proveedor = {
      proveedor_id: -1, // Asignar un valor predeterminado
      nombre,
      direccion,
      telefono,
      email
    };
  
    this.servicioProveedor.insertar(nuevoProveedor).subscribe({
      next: (response) => {
        console.log('Proveedor insertado:', response);
        alert('Proveedor ingresado exitosamente');
      },
      error: (error) => {
        console.error('Error al insertar el proveedor:', error);
      }
    });
  }
  

  // Productos
  cargarProductos() {
    this.servicioProducto.todos().subscribe((data) => {
      this.listaProductos = data;
    });
  }

  eliminarProducto(idProducto: number) {
    this.servicioProducto.eliminar(idProducto).subscribe(() => {
      this.cargarProductos();
    });
  }

  buscarProductoPorId(id: string) {
    const idNumber = Number(id); // Convertir el ID de string a número
    if (isNaN(idNumber)) {
      console.error('ID no válido');
      return;
    }
    this.servicioProducto.uno(idNumber).subscribe({
      next: (data) => {
        console.log("Producto encontrado:", data);
        this.productoEncontrado = data; 
      },
      error: (error) => {
        console.error("Error al buscar producto:", error);
      }
    });
  }

  insertarProducto(nombre: string, descripcion: string, precioStr: string, stockStr: string) {
    const precio = Number(precioStr); // Convertir el valor a número
    const stock = Number(stockStr); // Convertir el valor a número
  
    // Verificar que las conversiones
    if (isNaN(precio) || isNaN(stock)) {
      alert('Por favor, ingrese valores válidos para el precio y el stock.');
      return;
    }
  
    const nuevoProducto: Productos = {
      producto_id: -1, // Asignar un valor
      nombre,
      descripcion,
      precio,
      stock
    };
  
    this.servicioProducto.insertar(nuevoProducto).subscribe({
      next: (response) => {
        console.log('Producto insertado:', response);
        alert('Producto ingresado exitosamente');
      },
      error: (error) => {
        console.error('Error al insertar el producto:', error);
      }
    });
  }

  actualizarProducto(id: number, nombre: string, descripcion: string, precio: number, stock: number) {
    const producto: Productos = {
      producto_id: id,
      nombre,
      descripcion,
      precio,
      stock
    };

    this.servicioProducto.actualizar(producto).subscribe({
      next: (response) => {
        console.log('Producto actualizado:', response);
        alert('Producto actualizado exitosamente');
      },
      error: (error) => {
        alert('Error al actualizar producto');
        console.error('Error al actualizar producto:', error);
      }
    });
  }

  verDescripcion(event: Event, producto: Productos, campo: 'descripcion' | 'precio') {
    const input = event.target as HTMLInputElement;
    // Actualiza el campo específico del producto
    if (campo === 'descripcion') {
      producto.descripcion = input.value;
    } else if (campo === 'precio') {
      producto.precio = Number(input.value); // Convierte el valor a número
    }
  }
}
