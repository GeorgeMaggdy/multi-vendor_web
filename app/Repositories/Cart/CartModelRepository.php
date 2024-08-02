<?php
namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;



class CartModelRepository implements CartRepository
{

    public function get(): Collection
    {

        return Cart::with('Product')
            ->get();


    }

    public function delete($id)
    {

        Cart::WHERE('id', $id)
            ->delete();

    }

    public function add(Product $product, $quantity = 1)
    {
        $item = Cart::WHERE('product_id', '=', $product->id)->first();
        if (!$item) {
            return Cart::create([
                'product_id' => $product->id,
                'user_id' => Auth::id(),
                'quantity' => $quantity,
            ]);
        }
        return $item->increment('quantity', $quantity);


    }

    public function update($id, $quantity)
    {
        Cart::WHERE('id', '=', $id)
            ->update([
                'quantity' => $quantity,
            ]);


    }

    public function empty()
    {

        Cart::query()->delete();


    }

    public function total(): float
    {

        return $this->get()->SUM(function ($item) {

            return $item->quantity * $item->product->price;

        });
    }





}