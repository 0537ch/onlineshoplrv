<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Order Summary -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4">Order Summary</h3>
                            <div class="space-y-4">
                                @php
                                    $total = 0;
                                @endphp
                                @foreach($cartItems as $productId => $item)
                                    @php
                                        $product = App\Models\Product::find($item['product_id']);
                                        $subtotal = $item['price'] * $item['quantity'];
                                        $total += $subtotal;
                                    @endphp
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <h4 class="font-medium">{{ $product->name }}</h4>
                                            <p class="text-sm text-gray-600">{{ $item['quantity'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                        </div>
                                        <p class="font-medium">Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                                    </div>
                                @endforeach
                                <div class="border-t pt-4 mt-4">
                                    <div class="flex justify-between items-center font-semibold">
                                        <p>Total</p>
                                        <p>Rp {{ number_format($total, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Information Form -->
                        <div class="bg-white p-6">
                            <h3 class="text-lg font-semibold mb-4">Shipping Information</h3>
                            <form method="POST" action="{{ route('checkout.store') }}" class="space-y-4">
                                @csrf

                                <div>
                                    <x-input-label for="shipping_address" :value="__('Address')" />
                                    <x-text-input id="shipping_address" class="block mt-1 w-full" type="text" name="shipping_address" :value="old('shipping_address')" required autofocus />
                                    <x-input-error :messages="$errors->get('shipping_address')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="shipping_city" :value="__('City')" />
                                    <x-text-input id="shipping_city" class="block mt-1 w-full" type="text" name="shipping_city" :value="old('shipping_city')" required />
                                    <x-input-error :messages="$errors->get('shipping_city')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="shipping_postal_code" :value="__('Postal Code')" />
                                    <x-text-input id="shipping_postal_code" class="block mt-1 w-full" type="text" name="shipping_postal_code" :value="old('shipping_postal_code')" required />
                                    <x-input-error :messages="$errors->get('shipping_postal_code')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="shipping_phone" :value="__('Phone Number')" />
                                    <x-text-input id="shipping_phone" class="block mt-1 w-full" type="text" name="shipping_phone" :value="old('shipping_phone')" required />
                                    <x-input-error :messages="$errors->get('shipping_phone')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="notes" :value="__('Order Notes (Optional)')" />
                                    <textarea id="notes" name="notes" rows="3" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('notes') }}</textarea>
                                    <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                                </div>

                                <div class="flex items-center justify-end mt-6">
                                    <x-primary-button>
                                        {{ __('Place Order') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
