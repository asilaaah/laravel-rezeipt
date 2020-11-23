@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb d-flex d-flex justify-content-between">
            <div class="pull-left">
                <h3>List of Products</h3>
            </div>
        </div>
    </div>

    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mt-3 d-flex justify-content-between align-items-end">
            <div>
                <div class="pull-right mb-2">
                    <input type="file" name="file" class="form-control-file" required>
                </div>
                <button class="btn btn-success">Import Excel File</button>
                <a class="btn btn-warning" href="{{ route('export') }}">Export Excel File</a>
            </div>
            <div>
                <a class="btn btn-info" href="/p/create">Add Products</a>
                <a class="btn btn-info" href="/category/index">Add Category</a>
            </div>
        </div>
    </form>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered table-hover mt-4">
        <thead>
        <tr class="text-center">
            <th>@sortablelink('id','No')</th>
            <th>@sortablelink('category_id','Category')</th>
            <th>@sortablelink('name','Name')</th>
            <th>@sortablelink('description','Description')</th>
            <th>@sortablelink('price','Price')</th>
            <th>@sortablelink('quantity','Quantity')</th>
            <th width="250px">Action</th>
        </tr>
    </thead>

        @foreach ($products as $product)
        <tr class="text-center">
            <td><a class="text-dark" href="/p/{{ $product->id }}">{{ $product->id }}</a></td>
            <td><a class="text-dark" href="/p/{{ $product->id }}">{{ $product->category->name ?? NULL }}</a></td>
            <td><a class="text-dark"href="/p/{{ $product->id }}">{{ $product->name }}</a></td>
            <td><a class="text-dark" href="/p/{{ $product->id }}">{{ $product->description }}</a></td>
            <td><a class="text-dark" href="/p/{{ $product->id }}">RM {{ number_format($product->price, 2, '.', ',') }}</a></td>
            <td><a class="text-dark" href="/p/{{ $product->id }}">{{ $product->quantity }}</a></td>
            <td>
                <form action="/p/{{ $product->id }}" method="POST">

                    <a class="btn btn-primary" href="/p/{{ $product->id }}/edit">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    <div class="row pagination mb-3">
        <div class="col-12 d-flex justify-content-center">
        {!! $products->appends(\Request::except('page'))->render() !!}
        </div>
    </div>

    <div class="form-group row d-flex justify-content-center">
        <div class="col-md-6 offset-md-5">
            <a href='/manager/{{ $user->id }}' class="btn btn-primary text-center" role="button">Back</a>
        </div>
    </div>

</div>

@endsection
