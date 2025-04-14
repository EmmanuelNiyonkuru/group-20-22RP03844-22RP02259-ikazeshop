<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category') // Eager load category
            ->where('quantity', '>', 0)
            ->paginate(12);
    
        $categories = Category::has('products')
            ->withCount('products') // Optional: shows product count per category
            ->get();
    
        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
            'currentCategory' => null // Important for view logic
        ]);
    }
    
    public function productsByCategory(Category $category)
    {
        $products = $category->products()
                            ->where('quantity', '>', 0)
                            ->paginate(12);
        $categories = Category::has('products')->get();
        
        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
            'currentCategory' => $category
        ]);
    }
}