@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <h2>{{ $product->name }}</h2>
            </div>

        <div class="card-body">
            <img src="{{ $product->productImage() }}" class="w-25">
            <div>Description: {{ $product->description }}</div>
            <div>Price: RM {{ number_format($product->price, 2, '.', ',') }}</div>
            <div>Quantity: {{ $product->quantity }}</div>
        </div>
        </div>
        </div>
        </div>
    </div>
</div>
<div class="text-center">
    <a href="/p/index"
        class="btn btn-primary mt-3">Back</a>
    </div>
</div>

@endsection
