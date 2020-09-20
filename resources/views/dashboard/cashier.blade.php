@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-between d-flex pb-5">
        <div><h2>{{auth()->user()->name}} 's dashboard</h2></div>
        <div class="pr-5"><h2><a href="{{ route('product.cart') }}">
                    Cart
                    <span class="badge badge-pill badge-primary">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span>
                </a></h2></div>
    </div>
    <div class="row pt-3">

        <div class="col-2">
            <div class="col-lg-12 margin-tb">

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                    <p>{{ $message }}</p>
                @endif
            </div>

            <nav>
                <ul class="list-group">
                    @foreach ($categories as $category)
                    <li class="list-group-item"><a href="{{ route('cart.users.index', ['category' => $category->name]) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </nav>

        </div>

        <div class="col-10 pl-5">

            <div class="row">
                @forelse($products as $product)
                    <div class="col-3 pb-4">
                        <img src="/storage/{{ $product->image }}" class="w-100">
                        <div style="text-align: center;"><strong>{{ $product->name }}</strong></div>
                        <div style="text-align: center;">{{ $product->description }}</div>
                        <div style="text-align: center;"><strong>Price: </strong> RM {{ number_format($product->price, 2, '.', ',') }}</div>
                        <p class="btn-holder"><a href="{{ route('product.addToCart', ['id' => $product->id]) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> </p>
                    </div>
                @empty
                    <div>No items found</div>
                @endforelse
            </div>

        </div>
    </div>
</div>
@endsection
