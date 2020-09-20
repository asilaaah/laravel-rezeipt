@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb d-flex d-flex justify-content-between">
            <div class="pull-left">
                <h2>List of Products</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="/p/create"> Add new products</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" class="form-control mt-3">
        <div class="mt-3 d-flex justify-content-end">
        <button class="btn btn-success">Import Excel File</button>
        <a class="btn btn-warning" href="{{ route('export') }}">Export Excel File</a>
        </div>
    </form>

    <table class="table table-bordered mt-4">
        <tr>
            <th>No</th>
            <th>Category</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>
            <th width="250px">Action</th>
        </tr>

        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->category->name ?? NULL }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->description }}</td>
            <td>RM {{ number_format($product->price, 2, '.', ',') }}</td>
            <td>{{ $product->quantity }}</td>
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
    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-5">
            <p class="btn-holder">
                <a href="/manager" class="btn btn-primary text-center" role="button">Back</a>
            </p>
        </div>
    </div>
</div>
@endsection
