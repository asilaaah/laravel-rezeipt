@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb d-flex d-flex justify-content-between">
                <h2>{{auth()->user()->name}} 's dashboard</h2>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif 

        <nav class="row">
            <ul>
                @foreach ($categories as $category)
                <li><a href="{{ route('cashier.index', ['category' => $category->name]) }}">{{ $category->name }}</a></li>
                @endforeach
            </ul>
        </nav>

        <div class="row pl-5">
            @forelse($products as $product)
            <div class="col-4 pb-4">
                <img src="/storage/{{ $product->image }}" class="w-100">
                    <div>{{ $product->name }}</div>
                    <div>{{ $product->description }}</div>
                    <div><strong>Price: </strong> RM {{ number_format($product->price, 2, '.', ',') }}</div>
                    <p class="btn-holder"><a href="#" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> </p>         
            </div>
            @empty
            <div>No items found</div>
            @endforelse
        </div>
    </div>
</div>
@endsection