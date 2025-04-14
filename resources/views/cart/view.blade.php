<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    @if(count($cart) > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($item['image'])
                                                    <img src="{{ asset('product_images/'.$item['image']) }}" 
                                                         class="img-thumbnail me-3" 
                                                         style="width: 80px; height: 80px; object-fit: cover;" 
                                                         alt="{{ $item['title'] }}">
                                                @endif
                                                <div>
                                                    <h6 class="mb-0">{{ $item['title'] }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>${{ number_format($item['price'], 2) }}</td>
                                        <td>
                                            <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="d-flex">
                                                @csrf
                                                <input type="number" 
                                                       name="quantity" 
                                                       value="{{ $item['quantity'] }}" 
                                                       min="1" 
                                                       class="form-control form-control-sm" 
                                                       style="width: 70px;">
                                                <button type="submit" class="btn btn-sm btn-primary ms-2">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                        <td>
                                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold">Total:</td>
                                        <td colspan="2" class="fw-bold">${{ number_format($total, 2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left"></i> Continue Shopping
                            </a>
                            <a href="{{ route('checkout') }}" class="btn btn-primary">
                                Proceed to Checkout <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    @else
                        <div class="alert alert-info">
                            Your cart is empty. <a href="{{ route('products.index') }}">Browse products</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>