@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-10 margin-tb mb-3">
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                        <div class="pull-right mb-2">
                            <input type="file" name="file" class="form-control-file" required>
                        </div>
                        <div class="pull-left">
                        <button class="btn btn-success">Import Excel File</button>
                        <a class="btn btn-warning" href="{{ route('export') }}">Export Excel File</a>
                    </div>
            </form>
        </div>

        <div class="col-md-10 margin-tb">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
            </div>
            @endif
        </div>

        <div class="col-md-10 margin-tb">
            @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
            </div>
            @endif
        </div>

        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                <div class="font-weight-bold">List of Products</div>
                <div>
                    <a class="btn btn-info" href="/p/create">Add Products</a>
                    <a class="btn btn-info" href="/category/index">Add Category</a>
                </div>
            </div>

            <div class="card-body">

    <table class="table table-hover">
        <thead>
        <tr class="text-center">
            <th>@sortablelink('id','No')</th>
            <th>@sortablelink('category_id','Category')</th>
            <th>@sortablelink('name','Name')</th>
            <th>@sortablelink('description','Description')</th>
            <th>@sortablelink('price','Price')</th>
            <th>@sortablelink('quantity','Quantity')</th>
            <th class="text-primary">Action</th>
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
</div>
            </div>

    <div class="text-center">
        <a href="/manager/{{ $user->id }}"
            class="btn btn-primary mt-3">Back</a>
        </div>

        </div>
</div>
    </div>
</div>

@endsection
