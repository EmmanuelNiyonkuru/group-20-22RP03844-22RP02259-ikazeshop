<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class AdminController extends Controller
{
    // ... (keep your existing category methods)
    
 /// view category


    // Product Methods
    public function view_product(){
        $categories = Category::all();
        $products = Product::all(); 
        return view('admin.view_product', compact('products', 'categories'));
    }
    
    public function add_product()
    {
        $data=Category::all();
        return view('admin.add_product',compact('data'));
    }
    public function insert_product(Request $request){
        $product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        
        // Handle image upload
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $image->move('product_images', $imagename);
            $product->image = $imagename;
        }
        
        $product->save();
        flash()->success('Product added successfully!');
        return redirect()->back();
    }
    
    public function delete_product($id){
        $product = Product::find($id);
        // Delete associated image if exists
        if(file_exists(public_path('product_images/'.$product->image))){
            unlink(public_path('product_images/'.$product->image));
        }
        $product->delete();
        flash()->success('Product deleted successfully!');
        return redirect()->back();
    }
    
    public function edit_product($id){
        $product = Product::find($id);
        $categories = Category::all();
        return view('admin.edit_product', compact('product', 'categories'));
    }
    
    public function update_product(Request $request, $id){
        $product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        
        // Handle image update
        if($request->hasFile('image')){
            // Delete old image if exists
            if(file_exists(public_path('product_images/'.$product->image))){
                unlink(public_path('product_images/'.$product->image));
            }
            
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $image->move('product_images', $imagename);
            $product->image = $imagename;
        }
        
        $product->save();
        return redirect('/view_product')->with('success', 'Product updated successfully');
    }


    public function view_category(){
        $data=Category::all(); 
        return view('admin.view_category',compact('data'));
    }

    public function add_category(Request $request)
    {
        $category= new Category;
        $category->categoty_name=$request->category;
        $category->save();
        flash()->success('Category Added successful created successfully!');
        return redirect()->back();

    }

    public function delete_category($id){
        $data=Category::find($id);
        $data->delete();
        flash()->success('Category Deleted successful !');
        return redirect()->back();
    }
        public function edit_category($id){
        $data=Category::find($id);
        return view('admin.edit_category',compact('data'));
        }
            public function update_category(Request $request,$id){
                $data=Category::find($id);
                $data->categoty_name=$request->category;
                $data->save();
                return redirect('/view_category')->with('success','Category Updated successfull');
            }
    
}

