import { CommonModule } from '@angular/common';
import { Component, OnInit, inject } from '@angular/core';
import { RouterModule } from '@angular/router';
import { CartItem } from '../../models/cart-item.model';
import { CartService } from '../../services/cart.service';

@Component({
  selector: 'app-cart',
  standalone: true,
  imports: [CommonModule, RouterModule],
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.scss']
})
export class CartComponent implements OnInit {
  //TODO: Force reload after actions
  //TODO: Write all code for cart
  private cartService = inject(CartService);

  cartItems = this.cartService.cartItems;
  loading: boolean = true;

  ngOnInit(): void {
    this.loadCartItems();
  }

  loadCartItems(): void {
    this.loading = true;
    this.cartService.getCartItems().subscribe({
      next: () => {
        this.loading = false;
      },
      error: (err) => {
        console.error('Error loading cart items', err);
        this.loading = false;
      }
    });
  }

}
