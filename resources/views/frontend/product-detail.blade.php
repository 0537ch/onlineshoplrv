<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body class="bg-gray-100">

    <div class="container mx-auto py-10">
        <a href="{{ route('products.index') }}" class="text-blue-500 mb-5 inline-block">&larr; Kembali</a>

        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex flex-col md:flex-row gap-6">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="h-64 w-64 object-cover rounded-md">
                <div>
                    <h1 class="text-3xl font-bold">{{ $product->name }}</h1>
                    <p class="text-gray-600 mt-4">{{ $product->description }}</p>
                    <p class="text-blue-500 font-semibold text-2xl mt-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="text-gray-700 mt-2">Stok: {{ $product->stock }}</p>
                    <a href="#" class="mt-6 bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Tambah ke Keranjang</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
