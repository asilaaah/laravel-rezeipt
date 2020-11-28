@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <div class="">{{ $category->name }}</h2>
            </div>

        <div class="card-body">
    @forelse ($category->products as $product)
        <div class="row px-3 text-center">
        <div>{{ $product->name }}</div>
    </div>
    @empty
        <div colspan="6" class="text-center"><h5>No products under this category found</div></h5>
@endforelse
        </div>
        </div>
    </div>
</div>
<div class="text-center">
    <a href="/category/index"
        class="btn btn-primary mt-3">Back</a>
    </div>
</div>

@endsection
