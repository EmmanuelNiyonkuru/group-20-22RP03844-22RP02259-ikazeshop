@include('home.header')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .list-group-item.active {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row">
            <!-- Categories Sidebar -->
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        Categories
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('products.index') }}" 
                           class="list-group-item list-group-item-action {{ !isset($currentCategory) ? 'active' : '' }}">
                            All Products
                        </a>
                        @forelse($categories as $category)
                        <a href="{{ route('products.category', $category) }}" 
                           class="list-group-item list-group-item-action {{ isset($currentCategory) && $currentCategory->id == $category->id ? 'active' : '' }}">
                            {{ $category->category_name }}
                        </a>
                        @empty
                        <div class="list-group-item">No categories found</div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Products Listing -->
            <div class="col-md-9">
                <h2 class="mb-4">
                    @isset($currentCategory)
                        {{ $currentCategory->category_name }}
                    @else
                        All Products
                    @endisset
                    <small class="text-muted">({{ $products->total() }} items)</small>
                </h2>

                @if($products->isEmpty())
                    <div class="alert alert-info">No products available.</div>
                @else
                    <div class="row">
                        @foreach($products as $product)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                @if($product->image)
                                    <img src="{{ asset('product_images/'.$product->image) }}" 
                                         class="card-img-top" 
                                         alt="{{ $product->title }}">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" 
                                         style="height: 200px;">
                                        <span class="text-muted">No image available</span>
                                    </div>
                                @endif
                                
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->title }}</h5>
                                    <p class="text-success fw-bold">${{ number_format($product->price, 2) }}</p>
                                    <p class="text-muted small">
                                        <i class="fas fa-box"></i> Available: {{ $product->quantity }}
                                    </p>
                                    <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                                </div>
                                
                                <!-- <div class="card-footer bg-white d-flex justify-content-between">
                                    <a href="{{ route('products.show', $product) }}" 
                                       class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    @auth
                                    <form action="" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-cart-plus"></i> Add
                                        </button>
                                    </form>
                                    @else
                                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-secondary">
                                        Login to Buy
                                    </a>
                                    @endauth
                                </div> -->
                                <div class="card-footer bg-white d-flex justify-content-between">
    <a href="" 
       class="btn btn-sm btn-primary">
        <i class="fas fa-eye"></i> View
    </a>
    @auth
    <form action="{{url('/login') }}" method="POST">
        @csrf
        <input type="hidden" name="quantity" value="1">
        <button type="submit" class="btn btn-sm btn-success">
            <i class="fas fa-cart-plus"></i> Add
        </button>
    </form>
    @else
    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-secondary">
        Login to Buy
    </a>
    @endauth
</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $products->onEachSide(1)->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>