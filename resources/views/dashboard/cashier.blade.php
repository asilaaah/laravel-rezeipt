@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-between d-flex pb-3">
        <div><h2>{{auth()->user()->name}} 's dashboard</h2></div>
        <div class="pr-5"><h2><a href="{{ route('cart.cart') }}">
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
                        <form method="POST" action="{{ route('cart.addToCart', ['id' => $product->id]) }}" enctype="multipart/form-data">
                            @csrf
                        <img src="/storage/{{ $product->image }}" class="w-100">
                        <div class="text-center"><strong>{{ $product->name }}</strong></div>
                        <div class="text-center">{{ $product->description }}</div>
                        <div class="text-center"><strong>Price: </strong> RM {{ number_format($product->price, 2, '.', ',') }}</div>
                        <div align="center" class="pb-2">
                        <select name="qty" id="qty" class="mr-2">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
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
