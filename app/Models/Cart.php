<?php

namespace App\Models;

use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class Cart extends Model
{
    use HasFactory;
    protected $icrementing = false;

    protected $fillable = [

        'options',
        'quantity',
        'cookie_id',
        'product_id',
        'user_id'
    ];


    public static function booted()
    {
        static::observe(CartObserver::class);
        static::addGlobalScope('cookie_id', function (Builder $builder) {

            $builder->where('cookie_id', '=', self::getCookie());
        }); //global scope so i don't have to implement the condition on every method,the condtion is implemented all over the controllers,repos.
    }
    public function Product()
    {

        return $this->belongsTo(Product::class);
    }
    public function User()
    {
        return $this->belongsTo(User::class)->withDefault(
            [
                'name' => 'anonymous',
            ]
        );
    }

    public static function getCookie() //added the function inside the model so i can get access on it over the observers and the controllers.
    {

        $get_cookie = Cookie::get('cart_id');
        if (!$get_cookie) {

            $get_cookie = Str::uuid();
            Cookie::queue('cart_id', $get_cookie, 30 * 24 * 60);
        }
        return $get_cookie;
    }
    
}
