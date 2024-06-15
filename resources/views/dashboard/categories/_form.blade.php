<div class="form-group">
    <label for="">Category Name</label>
    <input type="text"  name="name" class="form-control" value="{{$category->name}}">
</div>

<div class="form-group">
    <label for="">Category Parent</label>
    <select  name="parent_id" class="form-control">
        <option value="">Primary Category </option>
        @foreach($parents as $parent)
        <option value="{{$parent->id}}" @selected($category->parent_id==$parent->id)>{{$parent->name}}</option>
        <!-- The selected directive is used for showing the current value of the category in the field
    used the selected to check if the categpry id i recieved is equall to the same parent id in the field then i should select it and show it in the field-->
        @endforeach
        

</select>


<div class="form-group">
    <label for="">Description</label>
    <textarea  name="description" class="form-control">{{$category->description}}</textarea>
</div>

<div class="form-group">
    <label for="">Image</label>
    <input type="file"  name="image" class="form-control">

    @if($category->image)
    <td><img src="{{asset('storage/'.$category->image)}}" alt="" height="60" width="60" ></td>
    @endif
    
</div>


<div class="form-group">
    <label for="">Status</label>
    <div>
    <div class="custom-control custom-radio">
  <input type="radio" value="active" name="status" class="custom-control-input" @checked($category->status=='active')>
  <label class="custom-control-label">Active</label>
</div>
<div class="custom-control custom-radio">
  <input type="radio" value="inactive" name="status" class="custom-control-input" @checked($category->status=='inactive')>
  <label class="custom-control-label">inactive</label>
</div>
</div>
</div>


<div class="form-group">
    <button type="submit"  class="btn btn-primary">Save </button>
</div>

</div>