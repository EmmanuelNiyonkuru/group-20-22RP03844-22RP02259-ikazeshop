<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $products = Product::with('category')
            ->where('quantity', '>', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(12);
    
        $categories = Category::has('products')->get();
    
        return view('dashboard', [
            'products' => $products,
            'categories' => $categories,
            'currentCategory' => null
        ]);
    }
    
    public function byCategory(Category $category)
    {
        $products = $category->products()
            ->where('quantity', '>', 0)
            ->paginate(12);
            
        $categories = Category::has('products')->get();
    
        return view('dashboard', [
            'products' => $products,
            'categories' => $categories,
            'currentCategory' => $category
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
