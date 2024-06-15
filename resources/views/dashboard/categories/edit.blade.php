@extends('layouts.dashboard')
@section('title','Categories')

@section('breadcrum')
             @parent
             <li class="breadcrumb-item active">Categories Page</li>
             <li class="breadcrumb-item active">Edit Category</li>

              @endsection

@section('content')

<form action="{{route('dashboard.categories.update',$category->id)}}"  method="post" enctype="multipart/form-data"> 
    @csrf
    @method('PUT')
    @include('dashboard.categories._form')
</form>

@endsection('content')
