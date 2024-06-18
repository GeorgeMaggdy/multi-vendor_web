<?php

namespace App\Models;

use App\Rules\filter;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [

        'description',
        'slug',
        'name',
        'image',
        'status',
        'parent_id'
    ];

    public static function rules($id = 0)
    {


        return [
            'name' =>
                [
                    'required',
                    'max:200',
                    'min:3',
                    Rule::unique('categories', 'name')->ignore($id),
                    // function ($attribute, $value, $fails) {
                    //     if (strtolower($value) == 'laravel') {

                    //         $fails('this name is forbidden');
                    //     }

                    // }
                    new filter(),
                ],
            'parent_id' => ['nullable', 'int', 'exists:categories,id'],
            'image' => ['image', 'mimes:png,jpg,bmp', 'max:100000024', 'dimensions:min_width=100,min_height=100'],
            'status' => 'required',
            'in:inactive,active',

        ];
    }
}
