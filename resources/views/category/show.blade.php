@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <div class="font-weight-bold">{{ $category->name }}</div>
            </div>

        <div class="card-body">
    @forelse ($category->products as $product)
        <div class="text-center px-3">
        <h5>{{ $product->name }}</h5>
    </div>
    @empty
        <div colspan="6" class="text-center"><h5>No products under this category found</h5></div>
@endforelse
        </div>
    </div>
<div class="text-center">
    <a href="/category/index"
        class="btn btn-primary mt-3">Back</a>
    </div>
</div>
</div>
</div>

@endsection
