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
                <form id="checkoutForm" action="{{ route('checkout.process') }}" method="POST">
                @csrf
                        
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="mb-3">Billing Information</h4>
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="firstName" class="form-label">First name</label>
                                        <input type="text" class="form-control" id="firstName" name="first_name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="lastName" class="form-label">Last name</label>
                                        <input type="text" class="form-control" id="lastName" name="last_name" required>
                                    </div>
                                    
                                    <div class="col-12">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    
                                    <div class="col-12">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" required>
                                    </div>
                                    
                                    <div class="col-md-5">
                                        <label for="country" class="form-label">Country</label>
                                        <select class="form-select" id="country" name="country" required>
                                            <option value="">Choose...</option>
                                            <option>United States</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label for="state" class="form-label">State</label>
                                        <select class="form-select" id="state" name="state" required>
                                            <option value="">Choose...</option>
                                            <option>California</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <label for="zip" class="form-label">Zip</label>
                                        <input type="text" class="form-control" id="zip" name="zip" required>
                                    </div>
                                </div>
                                
                                <hr class="my-4">
                                
                                <h4 class="mb-3">Payment</h4>
                                
                                <div class="my-3">
                                    <div class="form-check">
                                        <input id="credit" name="payment_method" type="radio" class="form-check-input" checked required value="credit_card">
                                        <label class="form-check-label" for="credit">Credit card</label>
                                    </div>
                                    <div class="form-check">
                                        <input id="paypal" name="payment_method" type="radio" class="form-check-input" required value="paypal">
                                        <label class="form-check-label" for="paypal">PayPal</label>
                                    </div>
                                </div>
                                
                                <div class="row gy-3">
                                    <div class="col-md-12">
                                        <label for="cc-name" class="form-label">Name on card</label>
                                        <input type="text" class="form-control" id="cc-name" required>
                                        <small class="text-muted">Full name as displayed on card</small>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <label for="cc-number" class="form-label">Credit card number</label>
                                        <input type="text" class="form-control" id="cc-number" required>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="cc-expiration" class="form-label">Expiration</label>
                                        <input type="text" class="form-control" id="cc-expiration" required>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="cc-cvv" class="form-label">CVV</label>
                                        <input type="text" class="form-control" id="cc-cvv" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Order Summary</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-3">
                                            <span>Subtotal ({{ array_sum(array_column($cart, 'quantity')) }} items)</span>
                                            <span>${{ number_format($total, 2) }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-3">
                                            <span>Shipping</span>
                                            <span class="text-success">Free</span>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between fw-bold fs-5">
                                            <span>Total</span>
                                            <span>${{ number_format($total, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary w-100 mt-3 py-2">
                                    Complete Order <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 