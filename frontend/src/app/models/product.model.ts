export interface Product {
  id: number;
  name: string;
  description: string | null;
  price: number;
  stock: number;
  image_path: string | null;
  created_at?: string;
  updated_at?: string;
}
