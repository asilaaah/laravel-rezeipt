@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-lg-12 margin-tb">
        @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ session('error') }} Only {{ session('quantity') }} remaining</strong>
        </div>
        @endif
    </div>

    <div class="justify-content-between d-flex pb-3">
        <div><h2>{{auth()->user()->name}} 's dashboard</h2></div>
        <div class="pr-5">
            <h3><a href="{{ route('cart.cart') }}">Cart
            <span class="badge badge-pill badge-primary">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span>
            </a></h3>
        </div>
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
                    <li class="list-group-item"><a href="{{ route('cart.product-list', ['category' => $category->name]) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </nav>

                    <p class="btn-holder mt-3">
                        <a href="/cashier/{{ $user->id }}" class="btn btn-primary text-center" role="button">Back</a>
                    </p>

        </div>

        <div class="col-10 pl-5">

            <div class="row">
                @forelse($products as $product)
                    <div class="col-3 pb-4">
                        <form method="POST" action="{{ route('cart.addToCart', ['id' => $product->id]) }}" enctype="multipart/form-data">
                            @csrf
                        <img src="{{ $product->productImage() }}" class="w-100">
                        <div class="text-center"><strong>{{ $product->name }}</strong></div>
                        <div class="text-center">{{ $product->description }}</div>
                        <div class="text-center"><strong>Price: </strong> RM {{ number_format($product->price, 2, '.', ',') }}</div>
                        <div align="center" class="pb-2">
                        <input name="qty" id="qty" type="number" min="1" data-bind="value:qty" class="col-md-7" />
                        </div>
                        <button class="btn btn-warning btn-block text-center">Add to cart</button>
                        </form>
                    </div>
                @empty
                    <div>No items found</div>
                @endforelse
            </div>

        </div>
    </div>
</div>
@endsection
