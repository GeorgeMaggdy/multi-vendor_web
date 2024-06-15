@extends('layouts.dashboard')
@section('title','Categories')

@section('breadcrum')
             @parent
             <li class="breadcrumb-item active">Categories Page</li>
              @endsection

@section('content')

<form action="{{route('dashboard.categories.store')}}"  method="post" enctype="multipart/form-data"> 
    @csrf
    @include('dashboard.categories._form')
</form>

@endsection('content')
