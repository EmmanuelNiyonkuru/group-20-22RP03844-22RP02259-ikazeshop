<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Order Receipt #{{ $order->order_number }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium">Thank you for your order!</h3>
                        <p class="text-gray-600">Order #{{ $order->order_number }} was placed on {{ $order->created_at->format('F j, Y') }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div>
                            <h4 class="font-medium text-gray-900 mb-2">Billing Information</h4>
                            <address class="not-italic">
                                {{ $order->first_name }} {{ $order->last_name }}<br>
                                {{ $order->address }}<br>
                                {{ $order->city }}, {{ $order->state }} {{ $order->zip_code }}<br>
                                {{ $order->country }}<br>
                                {{ $order->email }}<br>
                                {{ $order->phone }}
                            </address>
                        </div>

                        <div>
                            <h4 class="font-medium text-gray-900 mb-2">Order Details</h4>
                            <p><span class="text-gray-600">Payment Method:</span> {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
                            <p><span class="text-gray-600">Order Status:</span> <span class="capitalize">{{ $order->status }}</span></p>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-6">
                        <h4 class="font-medium text-gray-900 mb-4">Order Items</h4>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($order->items as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $item->product_name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($item->price, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->quantity }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($item->price * $item->quantity, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="bg-gray-50">
                                    <tr>
                                        <th colspan="3" class="px-6 py-3 text-right text-sm font-medium text-gray-500">Subtotal</th>
                                        <td class="px-6 py-3 text-sm text-gray-500">${{ number_format($order->total_amount, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="px-6 py-3 text-right text-sm font-medium text-gray-500">Tax</th>
                                        <td class="px-6 py-3 text-sm text-gray-500">$0.00</td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="px-6 py-3 text-right text-sm font-medium text-gray-500">Shipping</th>
                                        <td class="px-6 py-3 text-sm text-gray-500">$0.00</td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="px-6 py-3 text-right text-sm font-medium text-gray-900">Total</th>
                                        <td class="px-6 py-3 text-sm font-medium text-gray-900">${{ number_format($order->total_amount, 2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <a href="{{ route('products.index') }}" class="btn btn-primary">
                            Continue Shopping
                        </a>
                        <button onclick="window.print()" class="ml-4 btn btn-secondary">
                            Print Receipt
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>