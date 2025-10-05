import { HttpClient } from '@angular/common/http';
import { Injectable, inject } from '@angular/core';
import { Observable } from 'rxjs';
import { Product } from '../models/product.model';

@Injectable({
  providedIn: 'root'
})
export class ProductService {
  private http = inject(HttpClient);

  getProducts(page: number = 1): Observable<any> {
    return this.http.get(`/api/products?page=${page}`);
  }

  getProduct(id: number): Observable<any> {
    return this.http.get<any>(`/api/products/${id}`);
  }
}
