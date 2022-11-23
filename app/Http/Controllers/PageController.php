<?php

namespace App\Http\Controllers;

use Cart;
use App\Models\Product;

class PageController extends Controller
{
    //home page
    public function home()
    {
        $products = Product::all();
        $favs = Product::getFavorites();
        $cart = \Cart::getContent();
        return view('home', ['products' => $products, 'favs' => $favs, 'cart' => $cart]);
    }
    //Home Page json feed
    public function jsonhome()
    {
        $products = Product::all();
        $favs = Product::getFavorites();
        $cart = \Cart::getContent();
        return response()->json(['products' => $products, 'favs' => $favs, 'cart' => $cart]);
    }


    //favorite page
    public function favorites()
    {
        $products = Product::getFavorites();
        $cart = \Cart::getContent();
        return view('favorites', ['products' => $products, 'cart' => $cart]);
    }
    //favorite page json feed
    public function jsonfav()
    {
        $products = Product::getFavorites();
        $cart = \Cart::getContent();
        return response()->json(['productsjs' => $products, 'cart' => $cart]);
    }
}
