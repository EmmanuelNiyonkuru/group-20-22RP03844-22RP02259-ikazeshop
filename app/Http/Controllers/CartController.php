<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request, Product $product)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to add items to cart');
        }

        // Validate quantity
        $request->validate([
            'quantity' => 'nullable|integer|min:1|max:' . $product->quantity
        ]);

        $quantity = $request->input('quantity', 1);

        // Get current cart from session or create new one
        $cart = session()->get('cart', []);

        // Check if product already in cart
        if (isset($cart[$product->id])) {
            $newQuantity = $cart[$product->id]['quantity'] + $quantity;
            
            // Ensure we don't exceed available quantity
            if ($newQuantity > $product->quantity) {
                return back()->with('error', 'You cannot add more than available stock');
            }
            
            $cart[$product->id]['quantity'] = $newQuantity;
        } else {
            $cart[$product->id] = [
                "id" => $product->id,
                "title" => $product->title,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        // Update cart in session
        session()->put('cart', $cart);

        return back()->with('success', 'Product added to cart successfully');
    }

    public function viewCart()
    {
    $cart = session()->get('cart', []);
    $total = 0;
    foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
     }
     return view('cart.view', compact('cart', 'total'));
    }

    public function removeFromCart(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Product removed from cart');
    }

    public function updateCart(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->quantity
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Cart updated successfully');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty');
        }
        
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('cart.checkout', compact('cart', 'total'));
    }

    public function processCheckout(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty');
        }
    
        // Validate input
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'payment_method' => 'required|in:credit_card,paypal',
        ]);
    
        // Calculate total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
    
        // Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'total_amount' => $total,
            'status' => 'completed',
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'zip_code' => $validated['zip_code'],
            'country' => $validated['country'],
            'payment_method' => $validated['payment_method'],
        ]);
    
        // Create order items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'product_name' => $item['title'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }
    
        // Clear cart
        session()->forget('cart');
    
        // Redirect to receipt
        return redirect()->route('order.receipt', $order->id);
    }
    public function showReceipt(Order $order)
{
    // Verify the order belongs to the authenticated user
    if ($order->user_id !== auth()->id()) {
        abort(403);
    }

    return view('cart.receipt', compact('order'));
}
}