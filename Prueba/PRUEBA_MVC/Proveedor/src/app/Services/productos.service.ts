import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Productos } from '../Interfaces/productos';

@Injectable({
  providedIn: 'root',
})
export class ProductosService {
  apiurl =
    'http://localhost/Prueba/PRUEBA_MVC/controllers/productos.controller.php?op=';

  constructor(private http: HttpClient) {}

  // Obtener todos los productos
  todos(): Observable<Productos[]> {
    return this.http.get<Productos[]>(this.apiurl + 'todos');
  }

  // Obtener un producto por ID
  uno(id: number): Observable<Productos> {
    const url = `${this.apiurl}uno&producto_id=${id}`;
    console.log("URL construida:", url);
    return this.http.get<Productos>(url);
  }

  // Insertar un nuevo producto
  insertar(producto: Productos): Observable<any> {
    const formData = new FormData();
    formData.append('nombre', producto.nombre);
    formData.append('descripcion', producto.descripcion);
    formData.append('precio', producto.precio.toString());
    formData.append('stock', producto.stock.toString());
    return this.http.post<any>(this.apiurl + 'insertar', formData);
  }

  // Actualizar un producto existente
  actualizar(producto: Productos): Observable<any> {
    const formData = new FormData();
    formData.append('producto_id', producto.producto_id.toString());
    formData.append('nombre', producto.nombre);
    formData.append('descripcion', producto.descripcion);
    formData.append('precio', producto.precio.toString());
    formData.append('stock', producto.stock.toString());
    return this.http.post<any>(this.apiurl + 'actualizar', formData);
  }

  // Eliminar un producto por ID
  eliminar(idProducto: number): Observable<any> {
    const formData = new FormData();
    formData.append('producto_id', idProducto.toString());
    return this.http.post<any>(this.apiurl + 'eliminar', formData);
  }
}
