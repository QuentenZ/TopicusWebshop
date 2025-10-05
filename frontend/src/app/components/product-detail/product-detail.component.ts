import { CommonModule } from '@angular/common';
import { Component, OnInit, inject, ChangeDetectorRef } from '@angular/core';
import { ActivatedRoute, RouterModule } from '@angular/router';
import { Product } from '../../models/product.model';
import { ProductService } from '../../services/product.service';
import { CartService } from '../../services/cart.service';

@Component({
  selector: 'app-product-detail',
  standalone: true,
  imports: [CommonModule, RouterModule],
  templateUrl: './product-detail.component.html',
  styleUrls: ['./product-detail.component.scss']
})
export class ProductDetailComponent implements OnInit {
  private route = inject(ActivatedRoute);
  private productService = inject(ProductService);
  private cartService = inject(CartService);
  private cdr = inject(ChangeDetectorRef);

  product: Product | null = null;
  loading: boolean = true;
  error: string | null = null;
  addingToCart: boolean = false;
  quantity: number = 1;

  ngOnInit(): void {
    this.route.params.subscribe(params => {
      const productId = parseInt(params['id']);
      if (!isNaN(productId)) {
        this.loadProduct(productId);
      } else {
        this.error = 'Invalid product ID';
        this.loading = false;
      }
    });
  }

  loadProduct(id: number): void {
    this.loading = true;
    this.error = null;

    this.productService.getProduct(id).subscribe({
      next: (response) => {
        if (response.status === 'success') {
          this.product = response.data;
        } else {
          this.error = 'Failed to load product';
        }
        this.loading = false;
        this.cdr.detectChanges();
      },
      error: (err) => {
        console.error('Error loading product', err);
        this.error = 'Error loading product';
        this.loading = false;
        this.cdr.detectChanges();
      }
    });
  }

  increaseQuantity(): void {
    if (this.product && this.quantity < this.product.stock) {
      this.quantity++;
    }
  }

  decreaseQuantity(): void {
    if (this.quantity > 1) {
      this.quantity--;
    }
  }

  addToCart(): void {
    if (!this.product) {
      return;
    }

    this.addingToCart = true;
    this.cartService.addToCart(this.product.id, this.quantity).subscribe({
      //TODO add to cart functionality
    });
  }
}
