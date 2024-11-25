<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filters -->
            <div class="mb-6">
                <form action="{{ route('products.index') }}" method="GET" class="flex flex-wrap gap-4">
                    <select name="category" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    <select name="brand" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">All Brands</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Filter
                    </button>
                </form>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="relative">
                            @if($product->image)
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" 
                                    class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-500">No image available</span>
                                </div>
                            @endif
                            @if($product->discount > 0)
                                <div class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded text-sm">
                                    {{ $product->discount }}% OFF
                                </div>
                            @endif
                        </div>

                        <div class="p-6 space-y-4">
                            <h3 class="text-xl font-semibold">
                                <a href="{{ route('products.detail', $product->id) }}" class="text-gray-900 hover:text-indigo-600">
                                    {{ $product->name }}
                                </a>
                            </h3>

                            <div class="flex items-center space-x-2">
                                <span class="text-lg font-semibold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                @if($product->discount > 0)
                                    <span class="text-sm text-red-600 line-through">
                                        Rp {{ number_format($product->price * (1 + $product->discount/100), 0, ',', '.') }}
                                    </span>
                                @endif
                            </div>

                            <div class="text-sm text-gray-600">
                                <span class="font-semibold">Category:</span> {{ $product->category->name }}
                            </div>

                            @auth
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="w-full mt-4 bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition-colors">
                                        Add to Cart
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="block w-full mt-4 text-center bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 transition-colors">
                                    Login to Add to Cart
                                </a>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
