@extends('layouts.dashboard')
@section('title', 'Products')

@section('breadcrum')
@parent
<li class="breadcrumb-item active">Products Page</li>
@endsection

@section('content')

<x-alert />
<!-- alert is a component for alrets code -->
<div class="mb-5">

    <a href="{{route('dashboard.products.create')}}" class="btn btn-sm btn-outline-primary">Create products</a>
    <!-- <a href="{{route('dashboard.categories.trash')}}" class="btn btn-sm btn-outline-primary">Trash</a> -->

</div>


<form action="{{URL::current()}}" methods="get" class="d-flex justfiy-content-between mb-4">
    <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')" />
    <select name="status" class="form-control mx-4">
        <option value="">All</option>
        <option value="active" @selected(request('status') == 'active')>Active</option>
        <option value="inactive" @selected(request('status') == 'inactive')>In-active</option>
    </select>
    <button class="btn btn-dark">Filter</button>
</form>
<table class="table">
    <thead>
        <>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Category_id</th>
            <th>Store_id</th>
            <th>Created_at</th>
            <th colspan="2"></th>


            </tr>
    </thead>
    <tbody>
        @if($products->count())
            @foreach($products as $product)
                <tr>
                    <td><img src="{{asset('storage/' . $product->image)}}" alt="" height="60" width="60"></td>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->category_id}}</td>
                    <td>{{$product->store_id}}</td>
                    <td>{{$product->created_at}}</td>
                    <td>
                        <a href="{{route('dashboard.products.edit', $product->id)}}"
                            class="btn btn-sm btn-outline-primary">Edit</a>
                    </td>
                    <td>
                        <form action="{{route('dashboard.categories.destroy', $product->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">no data to be shown.</td>
            </tr>
        @endif
    </tbody>

</table>
{{$products->WithQueryString()->links()}}

<!-- withquerystring function is only for making the filter stays whenver we swap to another page,,it saves the query parameters. -->

@endsection('content')