import { Product } from './product.model';

export interface CartItem {
  id: number;
  session_id: string;
  product_id: number;
  quantity: number;
  created_at?: string;
  updated_at?: string;
  product?: Product;
}
