import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Proveedor } from '../Interfaces/proveedor';
import { map } from 'rxjs/operators';


@Injectable({
  providedIn: 'root',
})
export class ProveedorService {
  apiurl =
    'http://localhost/Prueba/PRUEBA_MVC/controllers/proveedores.controller.php?op=';

  constructor(private lector: HttpClient) {}  

  todos(): Observable<Proveedor[]> {
    return this.lector.get<Proveedor[]>(this.apiurl + 'todos');
  }

  eliminar(idProveedor: number): Observable<any> {
    const formData = new FormData();
    formData.append('proveedor_id', idProveedor.toString());
    return this.lector.post<any>(this.apiurl + 'eliminar', formData);
  }

  actualizar(proveedor: Proveedor): Observable<any> {
    const formData = new FormData();
    formData.append('proveedor_id', proveedor.proveedor_id.toString());
    formData.append('nombre', proveedor.nombre);
    formData.append('direccion', proveedor.direccion);
    formData.append('telefono', proveedor.telefono);
    formData.append('email', proveedor.email);
    return this.lector.post<any>(this.apiurl + 'actualizar', formData);
  }


  buscarPorNombre(nombre: string): Observable<Proveedor> {
    const url = `${this.apiurl}buscarPorNombre&nombre=${encodeURIComponent(nombre)}`;
    console.log("URL construida:", url);
    return this.lector.get<Proveedor[]>(url).pipe(
      map(proveedores => proveedores[0]) // un proveedor
    );
  }

  
  insertar(proveedor: Proveedor): Observable<any> {
    const formData = new FormData();
    formData.append('nombre', proveedor.nombre);
    formData.append('direccion', proveedor.direccion);
    formData.append('telefono', proveedor.telefono);
    formData.append('email', proveedor.email);
    return this.lector.post<any>(this.apiurl + 'insertar', formData);
  }
  
}
