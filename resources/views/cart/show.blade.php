<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(count($cartItems) > 0)
                        <div class="space-y-4">
                            @foreach($cartItems as $productId => $item)
                                <div class="flex items-center justify-between border-b pb-4">
                                    <div class="flex items-center space-x-4">
                                        @if($item['product']->image)
                                            <img src="{{ Storage::url($item['product']->image) }}" alt="{{ $item['product']->name }}" class="w-16 h-16 object-cover rounded">
                                        @endif
                                        <div>
                                            <h3 class="font-semibold">{{ $item['product']->name }}</h3>
                                            <p class="text-gray-600">Harga: Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <form action="{{ route('cart.update') }}" method="POST" class="flex items-center">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $productId }}">
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" 
                                                class="w-16 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            <button type="submit" class="ml-2 text-sm text-indigo-600 hover:text-indigo-900">Update</button>
                                        </form>
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $productId }}">
                                            <button type="submit" class="text-sm text-red-600 hover:text-red-900">Remove</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach

                            <div class="mt-6 flex justify-between items-center">
                                <div class="text-xl font-semibold">
                                    Total: Rp {{ number_format($total, 0, ',', '.') }}
                                </div>
                                <div class="space-x-4">
                                    <form action="{{ route('cart.clear') }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                            Clear Cart
                                        </button>
                                    </form>
                                    <a href="{{ route('checkout.index') }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                                        Checkout
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500 text-lg">Your cart is empty</p>
                            <a href="{{ route('products.index') }}" class="mt-4 inline-block bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
                                Continue Shopping
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
