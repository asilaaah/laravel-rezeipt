@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb d-flex d-flex justify-content-between">
            <div class="pull-left">
                <h2>{{auth()->user()->name}} 's dashboard</h2>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="row pt-5">
        @foreach($products as $product)
            <div class="col-4 pb-4">
                    <img src= "/storage/{{ $product->image }}" class="w-100">
                    <div>{{ $product->name }}</div>
                    <div>RM {{ number_format($product->price, 2, '.', ',') }}</div>
            </div>
        @endforeach
    </div>
   
</div>   
@endsection
