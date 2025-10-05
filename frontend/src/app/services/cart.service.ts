import { HttpClient } from '@angular/common/http';
import { Injectable, inject, signal } from '@angular/core';
import { Observable, tap } from 'rxjs';
import { CartItem } from '../models/cart-item.model';

@Injectable({
  providedIn: 'root'
})
export class CartService {
  private http = inject(HttpClient);

  // Use a signal for the cart items to easily update the UI when cart changes
  cartItems = signal<CartItem[]>([]);

  getCartItems(): Observable<any> {
    return this.http.get<any>("/api/cart").pipe(
      tap(response => {
        if (response.status === 'success') {
          this.cartItems.set(response.data);
        }
      })
    );
  }

  addToCart(productId: number, quantity: number = 1): Observable<any> {
    return this.http.post<any>("/api/cart", { product_id: productId, quantity }).pipe(
      tap(response => {
        if (response.status === 'success') {
          this.getCartItems().subscribe();
        }
      })
    );
  }

  //TODO write other cart service functions.
}
