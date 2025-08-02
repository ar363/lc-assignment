@extends("layout.app")

@section("title", "Shopping Cart - ShopCart")

@section("body")
<div class="min-h-screen">
    <!-- Navigation Header -->
    <nav class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="flex-shrink-0">
                        <h1 class="text-2xl font-display font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                            🛒 ShopCart
                        </h1>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Title -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-display font-bold text-gray-900 mb-4">
                Shopping Cart
            </h2>
            <p class="text-xl text-gray-600">
                Review your items and proceed to checkout
            </p>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="mb-8 max-w-2xl mx-auto">
                <div class="bg-gradient-to-r from-green-400 to-green-500 text-white px-6 py-4 rounded-lg shadow-lg">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-8 max-w-2xl mx-auto">
                <div class="bg-gradient-to-r from-red-400 to-red-500 text-white px-6 py-4 rounded-lg shadow-lg">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        {{ session('error') }}
                    </div>
                </div>
            </div>
        @endif

        @if(empty($cart))
            <!-- Empty Cart -->
            <div class="max-w-md mx-auto">
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                    <div class="text-8xl mb-6">🛒</div>
                    <h3 class="text-2xl font-display font-bold text-gray-900 mb-4">Your cart is empty</h3>
                    <p class="text-gray-600 mb-8">Discover amazing products in our store!</p>
                    <a href="{{ route('home') }}" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-medium rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                        Start Shopping
                    </a>
                </div>
            </div>
        @else
            <!-- Cart Items -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="p-8">
                    <div class="space-y-6">
                        @foreach($cart as $productId => $item)
                            <div class="border-b border-gray-100 pb-6 last:border-b-0 last:pb-0">
                                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                                    <!-- Product Info -->
                                    <div class="flex items-center space-x-4 mb-4 lg:mb-0 flex-1">
                                        <!-- Product Icon -->
                                        <div class="w-16 h-16 bg-gradient-to-br from-blue-50 to-indigo-100 rounded-xl flex items-center justify-center text-2xl">
                                            @if($productId == 1) 🎧
                                            @elseif($productId == 2) ⌚
                                            @else 🔊
                                            @endif
                                        </div>

                                        <!-- Product Details -->
                                        <div class="flex-1">
                                            <h3 class="text-xl font-display font-semibold text-gray-900 mb-1">{{ $item['name'] }}</h3>
                                            <p class="text-gray-600 mb-1">Unit Price: ₹{{ number_format($item['price'], 0) }}</p>
                                            <p class="text-lg font-bold text-blue-600">Subtotal: ₹{{ number_format($item['price'] * $item['quantity'], 0) }}</p>
                                        </div>
                                    </div>

                                    <!-- Quantity Controls -->
                                    <div class="flex items-center justify-between lg:justify-end space-x-6">
                                        <div class="flex items-center space-x-3 bg-gray-50 rounded-lg p-2">
                                            <form action="{{ route('cart.update') }}" method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $productId }}">
                                                <input type="hidden" name="action" value="decrease">
                                                <button type="submit" class="w-8 h-8 bg-white text-gray-600 rounded-lg hover:bg-gray-100 hover:text-red-600 transition-all duration-200 flex items-center justify-center shadow-sm">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                    </svg>
                                                </button>
                                            </form>

                                            <span class="text-xl font-bold text-gray-900 min-w-[3rem] text-center">{{ $item['quantity'] }}</span>

                                            <form action="{{ route('cart.update') }}" method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $productId }}">
                                                <input type="hidden" name="action" value="increase">
                                                <button type="submit" class="w-8 h-8 bg-white text-gray-600 rounded-lg hover:bg-gray-100 hover:text-green-600 transition-all duration-200 flex items-center justify-center shadow-sm">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>

                                        <!-- Remove Button -->
                                        <form action="{{ route('cart.remove') }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $productId }}">
                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 hover:text-red-700 transition-all duration-200">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Remove
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Cart Total -->
                    <div class="mt-8 pt-8 border-t border-gray-200">
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 mb-8">
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-display font-bold text-gray-900">Grand Total:</span>
                                <span class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                    ₹{{ number_format($total, 0) }}
                                </span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                            <form action="{{ route('cart.clear') }}" method="POST" class="flex-1">
                                @csrf
                                <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-4 bg-gradient-to-r from-red-500 to-red-600 text-white font-medium rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-200 shadow-lg hover:shadow-xl"
                                        onclick="return confirm('Are you sure you want to clear your cart?')">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Clear Cart
                                </button>
                            </form>

                            <form action="{{ route('checkout') }}" method="POST" class="flex-1">
                                @csrf
                                <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-4 bg-gradient-to-r from-green-500 to-green-600 text-white font-medium rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                    Proceed to Checkout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
