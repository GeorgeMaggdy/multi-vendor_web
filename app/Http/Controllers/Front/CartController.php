<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Cart\CartModelRepository;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CartRepository $cart)
    {



        return view('front.cart', [
            'cart' => $cart
        ]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CartRepository $cart)
    {

        $request->validate(

            [
                'product_id' => ['required', 'int', 'exists:products,id'],
                'quantity' => ['nullable', 'integer', 'min:1']
            ]
        );
        $product = Product::findorfail($request->post('product_id'));

        $cart->add($product, $request->post('quantity'));

        return redirect()->route('cart.index')->with('success', 'product added successfully!');
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
    public function update(Request $request, CartRepository $cart, $id)
    {

        $request->validate(

            [
                'quantity' => ['required', 'int', 'min:1']
            ]
        );
        $cart->update($id, $request->post('quantity'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartRepository $cart, $id)
    {

        $cart->delete($id);
    }
}
