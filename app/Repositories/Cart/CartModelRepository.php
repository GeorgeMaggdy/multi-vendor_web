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

        return Cart::with('Product')->WHERE('cookie_id', '=', $this->getCookie())
            ->get();


    }

    public function delete($id)
    {

        Cart::WHERE('id', $id)
            ->WHERE('cookie_id', '=', $this->getCookie())
            ->delete();

    }

    public function add(Product $product, $quantity = 1)
    {
        $item = Cart::WHERE('cookie_id', '=', $this->getCookie())
            ->WHERE('product_id', '=', $product->id)->first();
        if (!$item) {
           return Cart::create([

                'cookie_id' => $this->getCookie(),
                'product_id' => $product->id,
                'user_id' => Auth::id(),
                'quantity' => $quantity,
            ]);
        }
        return $item->increment('quantity', $quantity);


    }

    public function update($id, $quantity)
    {
        Cart::WHERE('cookie_id', '=', $this->getCookie())
            ->
            WHERE('id', '=', $id)
            ->update([
                'quantity' => $quantity,
            ]);


    }

    public function empty()
    {

        Cart::WHERE('cookie_id', '=', $this->getCookie())
            ->delete();


    }

    public function total(): float
    {

        return (float) Cart::WHERE('cookie_id', '=', $this->getCookie()) //added the float thing at first as casting cuz this value at first will return null so the null isn't a value there will be exception that's why i made casting for converting this null into a value       
            ->JOIN('products', 'products.id', '=', 'carts.id')
            ->SELECTRAW('SUM(products.price*carts.quantity )as total')
            ->value('total');
    }



    public function getCookie()
    {

        $get_cookie = Cookie::get('cart_id');
        if (!$get_cookie) {

            $get_cookie = Str::uuid();
            Cookie::queue('cart_id', $get_cookie, 30 * 24 * 60);
        }
        return $get_cookie;
    }

}