<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    // Hardcoded products data
    private function getProducts()
    {
        return [
            1 => ['id' => 1, 'name' => 'Wireless Headphones', 'price' => 6499.00],
            2 => ['id' => 2, 'name' => 'Smart Watch', 'price' => 15999.00],
            3 => ['id' => 3, 'name' => 'Bluetooth Speaker', 'price' => 3999.00],
        ];
    }

    public function index()
    {
        $products = $this->getProducts();
        $cart = session()->get('cart', []);

        return view('home', compact('products', 'cart'));
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $products = $this->getProducts();

        if (!isset($products[$productId])) {
            return redirect()->back()->with('error', 'Product not found!');
        }

        $product = $products[$productId];
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', $product['name'] . ' added to cart!');
    }

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart', compact('cart', 'total'));
    }

    public function updateQuantity(Request $request)
    {
        $productId = $request->input('product_id');
        $action = $request->input('action'); // 'increase' or 'decrease'

        $cart = session()->get('cart', []);

        if (!isset($cart[$productId])) {
            return redirect()->back()->with('error', 'Product not found in cart!');
        }

        if ($action === 'increase') {
            $cart[$productId]['quantity']++;
        } elseif ($action === 'decrease') {
            $cart[$productId]['quantity']--;

            if ($cart[$productId]['quantity'] <= 0) {
                unset($cart[$productId]);
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Product removed from cart!');
            }
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Cart updated!');
    }

    public function removeFromCart(Request $request)
    {
        $productId = $request->input('product_id');
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $productName = $cart[$productId]['name'];
            unset($cart[$productId]);
            session()->put('cart', $cart);

            return redirect()->back()->with('success', $productName . ' removed from cart!');
        }

        return redirect()->back()->with('error', 'Product not found in cart!');
    }

    public function clearCart()
    {
        session()->forget('cart');

        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Your cart is empty!');
        }

        // Clear cart after checkout
        session()->forget('cart');

        return redirect()->route('home')->with('success', 'Thank you for your purchase! Your order has been placed successfully.');
    }
}
