@extends('layouts.dashboard')
@section('title',"$categories->name")

@section('breadcrum')
             @parent
             <li class="breadcrumb-item active">Categories Page</li>
             <li class="breadcrumb-item active">{{$categories->name}}</li>


              @endsection

@section('content')

<table class="table">
    <thead>
            <th>Name</th>
            <th>Status</th>
            <th>Store-Name</th>
            <th>Created_at</th>
            <th colspan="2"></th>


            </tr>
    </thead>
    <tbody>

    @php
    $products=  $categories->Products()->with('Store')->paginate(5);
    @endphp
    
        @if($categories->count())
            @foreach($products as $product)
                <tr>
                    <td>{{$product->name}}</td>
                    <td>{{$product->status}}</td>
                    <td>{{$product->Store->name}}</td>
                    <td>{{$product->created_at}}</td>
                  
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="9">no data to be shown.</td>
            </tr>
        @endif
    </tbody>

</table>
{{$products->links()}}

@endsection('content')
