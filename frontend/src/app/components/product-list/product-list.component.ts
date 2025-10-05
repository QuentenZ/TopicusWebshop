import { CommonModule } from '@angular/common';
import { Component, OnInit, OnDestroy, inject, ChangeDetectorRef } from '@angular/core';
import { Router, NavigationEnd, RouterModule } from '@angular/router';
import { Product } from '../../models/product.model';
import { ProductService } from '../../services/product.service';
import { Subscription, filter } from 'rxjs';

@Component({
  selector: 'app-product-list',
  standalone: true,
  imports: [CommonModule, RouterModule],
  templateUrl: './product-list.component.html',
  styleUrls: ['./product-list.component.scss']
})
export class ProductListComponent implements OnInit, OnDestroy {
  private productService = inject(ProductService);
  private router = inject(Router);
  private cdr = inject(ChangeDetectorRef);
  private routerSubscription: Subscription | null = null;

  products: Product[] = [];
  currentPage: number = 1;
  lastPage: number = 1;
  totalProducts: number = 0;
  loading: boolean = true;

  ngOnInit(): void {
    this.loadProducts();

    // Subscribe to router events so we can reload products when navigating back to this page
    this.routerSubscription = this.router.events
      .pipe(filter(event => event instanceof NavigationEnd))
      .subscribe((event: any) => {
        if (event.url === '/products') {
          this.loadProducts(this.currentPage);
          this.cdr.detectChanges();
        }
      });
  }

  ngOnDestroy(): void {
    if (this.routerSubscription) {
      this.routerSubscription.unsubscribe();
    }
  }

  loadProducts(page: number = 1): void {
    this.loading = true;
    this.productService.getProducts(page).subscribe({
      next: (response) => {
        if (response.status === 'success') {
          this.products = response.data.data;
          this.currentPage = response.data.current_page;
          this.lastPage = response.data.last_page;
          this.totalProducts = response.data.total;
        } else {
          console.error('Error loading products');
        }
        this.loading = false;
        this.cdr.detectChanges();
      },
      error: (err) => {
        console.error('Error loading products', err);
        this.loading = false;
        this.cdr.detectChanges();
      }
    });
  }

  goToPage(page: number): void {
    if (page < 1 || page > this.lastPage) {
      return;
    }
    this.loadProducts(page);
    this.cdr.detectChanges();
  }
}
