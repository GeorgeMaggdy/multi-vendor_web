@extends('layouts.dashboard')
@section('title','Products')

@section('breadcrum')
             @parent
             <li class="breadcrumb-item active">Products Page</li>
             <li class="breadcrumb-item active">Edit Product</li>

              @endsection

@section('content')

<form action="{{route('dashboard.products.update',$product->id)}}"  method="post" enctype="multipart/form-data"> 
    @csrf
    @method('PUT')
    @include('dashboard.products._form')
</form>

@endsection('content')
