@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            @if($product->image)
            <img src="{{ asset('product_images/'.$product->image) }}" class="img-fluid rounded" alt="{{ $product->title }}">
            @else
            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                <span class="text-muted">No image available</span>
            </div>
            @endif
        </div>
        <div class="col-md-6">
            <h1>{{ $product->title }}</h1>
            <h3 class="text-primary">${{ number_format($product->price, 2) }}</h3>
            <p class="text-muted">Available Quantity: {{ $product->quantity }}</p>
            
            <div class="mb-4">
                <h4>Description</h4>
                <p>{{ $product->description }}</p>
            </div>

            @if($product->quantity > 0)
            <form action="{{ route('products.purchase', $product) }}" method="POST">
                @csrf
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-auto">
                        <label for="quantity" class="col-form-label">Quantity:</label>
                    </div>
                    <div class="col-auto">
                        <input type="number" id="quantity" name="quantity" 
                               class="form-control" min="1" max="{{ $product->quantity }}" 
                               value="1" required>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Buy Now</button>
                    </div>
                </div>
            </form>
            @else
            <div class="alert alert-warning">This product is currently out of stock.</div>
            @endif
        </div>
    </div>
</div>
@endsection