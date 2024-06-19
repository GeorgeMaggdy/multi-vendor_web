@extends('layouts.dashboard')
@section('title', 'Categories')

@section('breadcrum')
@parent
<li class="breadcrumb-item active">Categories Page</li>
@endsection

@section('content')

<x-alert />
<!-- alert is a component for alrets code -->
<div class="mb-5">

    <a href="{{route('dashboard.categories.create')}}" class="btn btn-sm btn-outline-primary">Create Category</a>
</div>

<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Parent</th>
            <th>Created_at</th>
            <th colspan="2"></th>


        </tr>
    </thead>
    <tbody>
        @if($categories->count())
            @foreach($categories as $category)
                <tr>
                    <td><img src="{{asset('storage/' . $category->image)}}" alt="" height="60" width="60"></td>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->description}}</td>
                    <td>{{$category->parent_id}}</td>
                    <td>{{$category->created_at}}</td>
                    <td>
                        <a href="{{route('dashboard.categories.edit', $category->id)}}"
                            class="btn btn-sm btn-outline-primary">Edit</a>
                    </td>
                    <td>
                        <form action="{{route('dashboard.categories.destroy', $category->id)}}" method="post">
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

@endsection('content')