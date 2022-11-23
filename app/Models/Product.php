<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public static function getFavorites()
    {
        return Product::where('favorite', true)->get();
    }

    //is favorite
    public static function isFavorite($id)
    {
        $product = Product::findOrfail($id);
        return $product->favorite;
    }

    //is discount
    public static function isDiscount($id)
    {
        $product = Product::findOrfail($id);
        return $product->discount;
    }

}
