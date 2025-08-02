@extends("layout.app")

@section("title", "Mini E-Commerce Store")

@section("body")
<div class="min-h-screen">
    <!-- Navigation Header -->
    <nav class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <h1 class="text-2xl font-display font-bold bg-gradient-to-r from-green-700 to-teal-600 bg-clip-text text-transparent">
                            ShopCart
                        </h1>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('cart.view') }}" class="relative inline-flex items-center px-6 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white text-sm font-medium rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-2">
                            <path d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                        </svg>
                        Cart ({{ count($cart) }})
                        @if(count($cart) > 0)
                            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                {{ count($cart) }}
                            </span>
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Hero Section -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-display font-bold text-gray-900 mb-4">
                Discover Amazing Products
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Explore our curated collection of premium tech accessories at unbeatable prices
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

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @foreach($products as $product)
                <div class="group relative bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <!-- Product Image Placeholder -->
                    <div class="h-48 bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center">
                        <div class="text-6xl">
                            @if($product['id'] == 1) 🎧
                            @elseif($product['id'] == 2) ⌚
                            @else 🔊
                            @endif
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="p-6">
                        <h3 class="text-xl font-display font-semibold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors duration-200">
                            {{ $product['name'] }}
                        </h3>
                        <p class="text-gray-600 mb-4 text-sm">
                            @if($product['id'] == 1) High-quality wireless audio experience
                            @elseif($product['id'] == 2) Track your fitness and stay connected
                            @else Powerful sound in a compact design
                            @endif
                        </p>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-3xl font-bold bg-gradient-to-r from-green-600 to-green-700 bg-clip-text text-transparent">
                                ₹{{ number_format($product['price'], 0) }}
                            </span>
                            <div class="flex text-yellow-400">
                                @for($i = 0; $i < 5; $i++)
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endfor
                            </div>
                        </div>

                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 px-6 rounded-lg font-medium hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 inline mr-2">
                                    <path d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                                </svg>
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Cart Summary (if not empty) -->
        @if(!empty($cart))
            <div class="max-w-2xl mx-auto">
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                    <div class="flex items-center mb-6">
                        <div class="bg-blue-100 rounded-full p-2 mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-display font-bold text-gray-900">Cart Summary</h3>
                    </div>

                    <div class="space-y-4 mb-6">
                        @foreach($cart as $item)
                            <div class="flex justify-between items-center py-3 border-b border-gray-100 last:border-b-0">
                                <div class="flex items-center">
                                    <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                                        x{{ $item['quantity'] }}
                                    </span>
                                    <span class="font-medium text-gray-900">{{ $item['name'] }}</span>
                                </div>
                                <span class="font-bold text-gray-900">₹{{ number_format($item['price'] * $item['quantity'], 0) }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-display font-bold text-gray-900">Total:</span>
                            <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                ₹{{ number_format(array_sum(array_map(function($item) {
                                    return $item['price'] * $item['quantity'];
                                }, $cart)), 0) }}
                            </span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('cart.view') }}" class="flex-1 sm:basis-1/2 inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-medium rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            View Cart
                        </a>
                        <form action="{{ route('checkout') }}" method="POST" class="flex-1 sm:basis-1/2">
                            @csrf
                            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white font-medium rounded-lg hover:from-green-700 hover:to-green-800 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                                <svg class="w-5 h-5 mr-2 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                                Quick Checkout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
