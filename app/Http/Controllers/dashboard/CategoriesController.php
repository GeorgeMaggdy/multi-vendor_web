<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use SebastianBergmann\Type\Exception;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $categories = Category::all();
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $parents = Category::all();
        $category = new Category();
        return view('dashboard.categories.create', compact('category', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {

        $request->validate(Category::rules());
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);

        $data = $request->except('image');

        $data['image'] = $this->uploadImg($request);
        /* checked whether there is a photo or not, if there, i take it and save it then i make a path for the pic which is the
        one called path , the path will be a folder called uploads inside the local which is the app folder , 
        at the end i assign the path of the pic in the field called image */


        $category = Category::create($data);

        return redirect()->route('dashboard.categories.index')->with('success', 'Created Successfully!');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resourc return redirect()->route('dashboard.categories.index')->with('success','Created Successfully!');

     */
    public function edit($id)
    {

        try {
            $category = Category::findorfail($id);
        } catch (Exception $e) {
            return redirect()->route('dashboard.categories.index')->with('info', 'Record not found');
        }

        $parents = Category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $id);
            })
            ->get();

        return view('dashboard.categories.edit', compact('category', 'parents'));



    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {


        $request->validate(Category::rules($id));
        $category = Category::findorfail($id);

        $old_img = $category->image;
        //the old img code is for checking if there's any pictures in the category or not


        $data = $request->except('image');

        $new_image = $this->uploadImg($request);
        if ($new_image) {
            $data['image'] = $new_image;
        }
        $category->update(
            $data
        );

        if ($old_img && isset($new_image)) {

            Storage::disk('public')->delete($old_img);
        }
        //If there a pic and i want to update it with another picture, i have to delete the old one and add the new one

        return redirect()->route('dashboard.categories.index')->with('updated', 'Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findorfail($id);
        $category->delete();
        if ($category->image) {

            Storage::disk('public')->delete($category->image);
        }
        return redirect()->route('dashboard.categories.index')->with('deleted', 'The category deleted successfully ');
    }

    protected function uploadImg(Request $request)
    {

        if (!$request->hasfile('image')) {

            return;
        }

        $file = $request->file('image');
        $path = $file->store('uploads', [

            'disk' => 'public'
        ]);

        return $path;

    }
}
