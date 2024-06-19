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
    <label for="">Category Name</label>
    <x-form.input type="text" name="name" :value="$category->name" />
</div>

<div class="form-group">
    <label for="">Category Parent</label>
    <select name="parent_id" class="form-control">
        <option value="">Primary Category </option>
        @foreach($parents as $parent)
            <option value="{{$parent->id}}" @selected(old('parent_id', $category->parent_id) == $parent->id)>{{$parent->name}}
            </option>
            <!-- The selected directive is used for showing the current value of the category in the field
                                                                    used the selected to check if the categpry id i recieved is equall to the same parent id in the field then i should select it and show it in the field-->
        @endforeach


    </select>


    <div class="form-group">
        <label for="">Description</label>
        <textarea name="description" class="form-control">{{@old('description', $category->description)}}</textarea>
    </div>

    <div class="form-group">
        <x-form.label id="image">Image</x-form.label>
        <x-form.input type="file" name="image" :value="$category->image" />


        @error('image')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror


        @if($category->image)
            <td><img src="{{asset('storage/' . $category->image)}}" alt="" height="60" width="60"></td>
        @endif

    </div>


    <div class="form-group">
        <label for="">Status</label>
        <div>
            <div class="custom-control custom-radio">
                <input type="radio" value="active" name="status" class="custom-control-input" @checked(old('status', $category->status) == 'active')>
                <label class="custom-control-label">Active</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" value="inactive" name="status" class="custom-control-input" @checked(old('status', $category->status) == 'inactive')>
                <label class="custom-control-label">inactive</label>
                @error('status')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
        </div>
    </div>


    <div class="form-group">
        <button type="submit" class="btn btn-primary">Save </button>
    </div>

</div>