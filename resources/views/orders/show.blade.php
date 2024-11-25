<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold">Detail Pesanan #{{ $order->order_number }}</h2>
                        <a href="{{ route('orders.index') }}" class="text-indigo-600 hover:text-indigo-900">
                            &larr; Kembali ke Daftar Pesanan
                        </a>
                    </div>

                    <!-- Status Pesanan -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium mb-2">Status Pesanan</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center justify-between">
                                <div class="flex-1 text-center">
                                    <div class="@if($order->status !== 'cancelled') text-indigo-600 @else text-gray-400 @endif">
                                        <svg class="mx-auto h-8 w-8" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-sm font-medium">Pesanan Dibuat</span>
                                    </div>
                                </div>
                                <div class="flex-1 text-center">
                                    <div class="@if(in_array($order->status, ['processing', 'shipped', 'delivered'])) text-indigo-600 @else text-gray-400 @endif">
                                        <svg class="mx-auto h-8 w-8" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z"/>
                                        </svg>
                                        <span class="text-sm font-medium">Diproses</span>
                                    </div>
                                </div>
                                <div class="flex-1 text-center">
                                    <div class="@if(in_array($order->status, ['shipped', 'delivered'])) text-indigo-600 @else text-gray-400 @endif">
                                        <svg class="mx-auto h-8 w-8" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                            <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7h4a1 1 0 011 1v6h-2.05a2.5 2.5 0 01-4.9 0H10a1 1 0 01-1-1V7a1 1 0 011-1h4z"/>
                                        </svg>
                                        <span class="text-sm font-medium">Dikirim</span>
                                    </div>
                                </div>
                                <div class="flex-1 text-center">
                                    <div class="@if($order->status === 'delivered') text-indigo-600 @else text-gray-400 @endif">
                                        <svg class="mx-auto h-8 w-8" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-sm font-medium">Diterima</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Pengiriman -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <h3 class="text-lg font-medium mb-2">Informasi Pengiriman</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-sm text-gray-600">{{ $order->shipping_address }}</p>
                                <p class="text-sm text-gray-600">{{ $order->shipping_city }}</p>
                                <p class="text-sm text-gray-600">{{ $order->shipping_postal_code }}</p>
                                <p class="text-sm text-gray-600">Telepon: {{ $order->shipping_phone }}</p>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium mb-2">Ringkasan Pesanan</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-sm text-gray-600">Tanggal Pesanan: {{ $order->created_at->format('d M Y H:i') }}</p>
                                <p class="text-sm text-gray-600">Status: {{ \App\Models\Order::getStatuses()[$order->status] }}</p>
                                <p class="text-sm text-gray-600">Total: Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Produk -->
                    <div>
                        <h3 class="text-lg font-medium mb-2">Detail Produk</h3>
                        <div class="bg-gray-50 rounded-lg overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        @if($item->product->image)
                                                            <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}">
                                                        @endif
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $item->product->name }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                Rp {{ number_format($item->price, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $item->quantity }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
