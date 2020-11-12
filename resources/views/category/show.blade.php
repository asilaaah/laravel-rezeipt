@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <h2>{{ $category->name }}</h2>
            </div>

        <div class="card-body">
<div class="px-3">
    @foreach ($category->products as $product)
    <div class="row">
        <div>{{ $product->name }}</div>
    </div>
    @endforeach
        </div>
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
