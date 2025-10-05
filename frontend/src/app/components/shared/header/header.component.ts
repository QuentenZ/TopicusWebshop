import { CommonModule } from '@angular/common';
import { Component, HostListener } from '@angular/core';
import { RouterModule } from '@angular/router';
import { CartComponent } from '../../cart/cart.component';
import { FaIconComponent } from '@fortawesome/angular-fontawesome';
import { faCartShopping } from '@fortawesome/free-solid-svg-icons';

@Component({
  selector: 'app-header',
  standalone: true,
  imports: [CommonModule, RouterModule, CartComponent, FaIconComponent],
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss']
})
export class HeaderComponent {
  //TODO: Unfinished code for cart
  cartIcon = faCartShopping;
  isCartOpen = false;

  toggleCart(): void {
    this.isCartOpen = !this.isCartOpen;
  }

  @HostListener('document:click', ['$event'])
  closeCartOnClickOutside(event: MouseEvent): void {
    const cartToggle = document.querySelector('.cart-toggle');
    const cartDropdown = document.querySelector('.cart-dropdown');

    if (!cartToggle || !cartDropdown) {
      return;
    }

    // Close cart when clicking outside of the cart or toggle button
    if (
      this.isCartOpen &&
      !cartToggle.contains(event.target as Node) &&
      !cartDropdown.contains(event.target as Node)
    ) {
      this.isCartOpen = false;
    }
  }
}
