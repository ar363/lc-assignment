# E-Commerce Cart - Laravel Assignment

A beautiful, fully functional mini e-commerce cart system built with Laravel 12, featuring session-based cart management, modern UI with Tailwind CSS, and responsive design.

## 🎯 Assignment Overview

This project implements a complete shopping cart system with the following features:

- **Product Display**: 3 hardcoded premium tech products with beautiful UI
- **Cart Management**: Add, update quantities, remove items, clear cart
- **Session Storage**: All cart data stored in PHP sessions
- **Responsive Design**: Mobile-first design with Tailwind CSS
- **Indian Currency**: All prices in Rupees (₹)
- **Modern UI**: Beautiful gradients, animations, and hover effects

## 🚀 How to Run This Project Locally

### Prerequisites

- **PHP**: 8.2 or higher
- **Composer**: Latest version
- **Node.js**: 18+ (for Vite)
- **NPM/Yarn**: For frontend dependencies

### Installation Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd lc-assignment
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Build frontend assets**
   ```bash
   npm run dev
   # OR for production
   npm run build
   ```

6. **Start the development server**
   ```bash
   php artisan serve
   ```

7. **Access the application**
   - Open your browser and visit: `http://localhost:8000`

## 📁 Key Files & Structure

### Controllers
- **`app/Http/Controllers/ShoppingController.php`** - Main controller handling all cart operations
  - `index()` - Display products and cart summary
  - `addToCart()` - Add items to cart
  - `viewCart()` - Full cart page
  - `updateQuantity()` - Increase/decrease item quantities
  - `removeFromCart()` - Remove specific items
  - `clearCart()` - Clear entire cart
  - `checkout()` - Process checkout and clear cart

### Routes
- **`routes/web.php`** - All application routes following RESTful principles
  - `GET /` - Home page with products
  - `POST /cart/add` - Add to cart
  - `GET /cart` - View cart
  - `POST /cart/update` - Update quantities
  - `POST /cart/remove` - Remove items
  - `POST /cart/clear` - Clear cart
  - `POST /checkout` - Checkout process

### Views (Blade Templates)
- **`resources/views/layout/app.blade.php`** - Main layout with Tailwind CSS
- **`resources/views/home.blade.php`** - Product listing and cart summary
- **`resources/views/cart.blade.php`** - Full cart management page

### Styling
- **`resources/css/app.css`** - Custom CSS with Tailwind imports
- **Tailwind CSS** - Utility-first CSS framework via CDN
- **Custom Fonts** - Inter & Poppins from Google Fonts
