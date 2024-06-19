@props ([

    'type' => 'text',
    'name',
    'value'
])

<!-- the props variable is only for checking the possible parameters im receiving and setting defaults for the variables -->


<input type="{{$type}}" name="{{$name}}" value="{{old($name, $value)}}" @class([
    'form-control',
    'is-invalid' => $errors->has($name)

]) {{$attributes}}>

<!-- the attributes variable is only for printing the unsent variables/attributes -->
@error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror