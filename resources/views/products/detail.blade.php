<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Product Image -->
                        <div class="flex justify-center items-start">
                            @if($product->image)
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" 
                                    class="w-full max-w-md rounded-lg shadow-md object-cover">
                            @else
                                <div class="w-full max-w-md h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <span class="text-gray-500">No image available</span>
                                </div>
                            @endif
                        </div>

                        <!-- Product Details -->
                        <div class="space-y-6">
                            <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
                            
                            <div class="flex items-center space-x-4">
                                <span class="text-2xl font-semibold text-gray-900">${{ number_format($product->price, 2) }}</span>
                                @if($product->discount > 0)
                                    <span class="text-sm text-red-600 line-through">${{ number_format($product->price * (1 + $product->discount/100), 2) }}</span>
                                    <span class="px-2 py-1 text-sm text-white bg-red-500 rounded">{{ $product->discount }}% OFF</span>
                                @endif
                            </div>

                            <div class="prose max-w-none">
                                <p>{{ $product->description }}</p>
                            </div>

                            <div class="border-t pt-4">
                                <div class="flex items-center space-x-4 text-sm text-gray-600">
                                    <div>
                                        <span class="font-semibold">Category:</span> 
                                        {{ $product->category->name }}
                                    </div>
                                    <div>
                                        <span class="font-semibold">Brand:</span> 
                                        {{ $product->brand->name }}
                                    </div>
                                    <div>
                                        <span class="font-semibold">SKU:</span> 
                                        {{ $product->sku }}
                                    </div>
                                </div>
                            </div>

                            @auth
                                <form action="{{ route('cart.add') }}" method="POST" class="mt-6 space-y-4">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="flex items-center space-x-4">
                                        <label for="quantity" class="text-gray-700">Quantity:</label>
                                        <input type="number" name="quantity" id="quantity" value="1" min="1" 
                                            class="w-20 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    </div>
                                    <button type="submit" class="w-full bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700 transition-colors">
                                        Add to Cart
                                    </button>
                                </form>
                            @else
                                <div class="mt-6">
                                    <a href="{{ route('login') }}" class="block text-center bg-gray-200 text-gray-700 px-6 py-3 rounded-md hover:bg-gray-300 transition-colors">
                                        Login to Add to Cart
                                    </a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
