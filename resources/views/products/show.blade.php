@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between align-item-center px-2">
                <h3 class="float-left">{{ $product->name }}</h3>
                <div>
                <a href="/p/{{ $product->id }}/edit" class="btn btn-primary btn-100 float-right">Edit</a>
                </div>
                </div>
            </div>

        <div class="card-body text-center">
            <img src="{{ $product->productImage() }}" class="w-25 mb-3">
            <h5>Description: {{ $product->description }}</h5>
            <h5>Price: RM {{ number_format($product->price, 2, '.', ',') }}</h5>
            <h5>Quantity: {{ $product->quantity }}</h5>
            <h5>Minimum Quantity: {{ $product->minimum_quantity }}</h5>
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
