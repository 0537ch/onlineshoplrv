<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <body class="bg-gray-100">
    <div class="container mx-auto py-10">
        <h1 class="text-3xl font-bold text-center mb-10">Daftar Produk</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <div class="bg-white shadow rounded-lg p-4">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="h-40 w-full object-cover rounded-md">
                    <h2 class="mt-4 text-lg font-bold">{{ $product->name }}</h2>
                    <p class="text-gray-600 mt-2">{{ Str::limit($product->description, 50) }}</p>
                    <p class="text-blue-500 font-semibold mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <a href="{{ route('products.detail', $product->id) }}" class="block mt-4 text-center bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Lihat Detail</a>
                </div>
            @endforeach
        </div>
    </div>

</body>
</x-app-layout>
