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
}
