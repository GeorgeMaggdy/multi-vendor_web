<?php

namespace App\Http\Controllers\front;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {

        // return view('front.products.index');
    }

    public function show(Product $product)
    {
        if ($product->status != 'active') {

            return abort(404);
        }

        return view('front.products.show', compact('product'));

    }
}
