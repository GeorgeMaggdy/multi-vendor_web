<?php

namespace App\Models;

use App\Models\Store;
use App\Models\Category;
use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'category_id',
        'store_id',
        'price',
        'compare_price',
        'status',
    ];

    static function booted()
    {

        static::addGlobalScope('store', new StoreScope());

    }

    public function Category()
    {

        return $this->belongsTo(Category::class);

    }

    public function Store()
    {

        return $this->belongsTo(Store::class);
    }

    public function Tags()
    {

        return $this->belongsToMany(
            Tag::class,
            'product_tag',
            'product_id',
            'tag_id',
            'id',
            'id'
        );
    }
}
