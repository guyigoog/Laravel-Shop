<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    
    //cart list
    public function cartList()
    {
        $cart = \Cart::getContent();
        //dd($cart);
        //return view('cart', compact('cart'));
        return response()->json(['cart' => $cart]);
    }

    //add to cart
    public function addToCart(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'associatedModel' => 'Product',
            'attributes' => [
                'discount' => $request->discount,
            ]
            ]);
        session()->flash('success', 'Product added to cart successfully!');
        return back();
    }

    //update cart
    public function updateCart(Request $request)
    {
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        session()->flash('success', 'Item Cart is Updated Successfully !');

        return back();
    }

    //remove from cart
    public function removeCart($id)
    {
        \Cart::remove($id);
        session()->flash('success', 'Item Cart Remove Successfully !');

        return back();
    }

    //clear cart
    public function clearAllCart()
    {
        \Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return back();
    }
}
