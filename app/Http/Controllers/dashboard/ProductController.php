<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Tag;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = Product::with(['Store', 'Category'])->paginate();

        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $tags = implode(',', $product->Tags()->pluck('name')->toArray());
        return view('dashboard.products.edit', compact('product', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
        $request->validate([

            'name' => ['required', 'max:255', 'string'],
            'description' => ['string', 'min:10'],
            'image' => ['image', 'mimes:png,jpg,bmp', 'max:100000024', 'dimensions:min_width=100,min_height=100'],
            'price' => ['required', 'numeric'],
            'compare_price' => ['required', 'numeric'],
            'status' => ['required', 'in:draft,archieved,active'],
            'tags'=>['required','JSON']


        ]);
        $product->update($request->except('tags'));
        $tags = json_decode($request->post('tags')) ?? [];
        $saved_tags = Tag::all();
        $tag_ids = [];
        foreach ($tags as $item) {
            $slug = str::slug($item->value);
            $tag = $saved_tags->where('slug', $slug)->first();
            if (!$tag) {
                $tag = Tag::create([
                    'name' => $item->value,
                    'slug' => $slug
                ]);
            }

            $tag_ids[] = $tag->id;

        }
        $product->Tags()->sync($tag_ids);
        return redirect()->route('dashboard.products.index')->with('success', 'updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
