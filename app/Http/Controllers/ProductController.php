<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('home');
    }

    //Create product
    public function create()
    {
        return view('product');
    }

    //toggle favorite
    public function addToFav($id)
    {
        $product = Product::findOrfail($id);
        $product->favorite = !$product->favorite;
        $product->update();
        return back()->with('success', 'Product added to favorites successfully!');
    }

        //Store product
    public function store(Request $request)
    {
        //validate
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required',
            'discount' => '',
            'favorite' => 'boolean'
        ]);
        //store product
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'discount' => $request->discount,
            'favorite' => $request->favorite
        ]);
    
        //return response
        return back()->with('success', 'Product created successfully.');
    }

}
