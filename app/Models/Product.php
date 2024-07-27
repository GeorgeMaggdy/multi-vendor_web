<?php

namespace App\Models;

use App\Models\Store;
use App\Models\Category;
use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Str;

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
    public function scopeActive(Builder $builder)
    {

        $builder->where('status', '=', 'active');

    }

    /*accessors 
    Naming:get....Attribute()
    accessors are used for a specific manner ->for example i want all the products picture have the same url picture */

    public function getImageUrlAttribute()
    {

        if (!$this->image) {
            return "https://wbco.sa/storage/images/documents/_res/wrh/def_product.png";
        }
        if (Str::startsWith($this->image, ['https://', 'http://'])) {

            return $this->image;
        }
        return asset('storage/' . $this->image);
    }

    public function getDiscountProductAttribute()
    {
        if (!$this->compare_price) {
            return 0;
        }
        return round(100 - (100 * $this->price / $this->compare_price),1);
    }

}
