@if($errors->any())
    <div class="alert alert-danger">
        <h3>Error occured!</h3>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>

@endif


<div class="form-group">
    <x-form.input label="Product Name" role="input" name="name" :value="$product->name" class="form-control-lg" />
</div>

<div class="form-group">
    <label for="">Category</label>
    <select name="category_id" class="form-control form-select">
        <option value="">Primary Category </option>
        @foreach(App\Models\Category::all() as $category)
            <option value="{{$category->id}}" @selected(old('category_id', $product->category_id) == $category->id)>
                {{$category->name}}
            </option>
            <!-- The selected directive is used for showing the current value of the category in the field
                                                                                                                                                used the selected to check if the categpry id i recieved is equall to the same parent id in the field then i should select it and show it in the field-->
        @endforeach


    </select>


    <div class="form-group">
        <label for="">Description</label>
        <textarea name="description" class="form-control">{{@old('description', $product->description)}}</textarea>
    </div>

    <div class="form-group">
        <x-form.label id="image">Image</x-form.label>
        <x-form.input type="file" name="image" :value="$product->image" />


        @error('image')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror


        @if($product->image)
            <td><img src="{{asset('storage/' . $product->image)}}" alt="" height="60" width="60"></td>
        @endif

    </div>
    <div class="form-group">
        <x-form.input label="Price" name="price" :value="$product->price" />
    </div>

    <div class="form-group">
        <x-form.input label="Compare Price" name="compare_price" :value="$product->compare_price" />
    </div>


    <div class="form-group">
        <x-form.input label="Tags" name="tags" :value="$tags" />
    </div>

    <div class="form-group">
        <label for="">Status</label>
        <div>
            <x-form.radio name="status" :checked="$product->status" :options="['active' => 'Active', 'draft' => 'Draft', 'archieved' => 'Archieved']" />
        </div>
    </div>


    <div class="form-group">
        <button type="submit" class="btn btn-primary">Save </button>
    </div>

</div>

@push('styles')

    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />

@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <script>
        var inputElem = document.querySelector('[name=tags]') // the 'input' element which will be transformed into a Tagify component
        var tagify = new Tagify(inputElem);
    </script>
@endpush