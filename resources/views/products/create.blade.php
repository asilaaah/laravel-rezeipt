@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/p" enctype="multipart/form-data" method="post">
        @csrf
        <div class="row">
            <div class="col-8 offset-2">

                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

                <div class="row d-flex align-items-center justify-content-between">
                    <h2 class="my-3">Add New Products</h2>
                </div>

             <div class="form-group row">
                 <label for="category_id">Category</label>
                 <select class="form-control" name="category_id">
                     @foreach ($categories as $category)
                        <option value={{ $category->id }}>{{ $category->name}}</option>
                     @endforeach
                 </select>
            </div>

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label">Name</label>

                    <input id="name"
                           type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           name="name"
                           value="{{ old('name') }}"
                           required autocomplete="name"
                           autofocus>

                    @error('name')
                            <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label">Description</label>

                    <input id="description"
                           type="text"
                           class="form-control @error('description') is-invalid @enderror"
                           name="description"
                           value="{{ old('description') }}"
                           required autocomplete="description"
                           autofocus>

                    @error('description')
                            <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="price" class="col-md-4 col-form-label">Price</label>

                    <input id="price"
                           type="text"
                           class="form-control @error('price') is-invalid @enderror"
                           name="price"
                           value="{{ old('price') }}"
                           required autocomplete="price"
                           autofocus>

                    @error('price')
                            <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="quantity" class="col-md-4 col-form-label">Quantity</label>

                    <input id="quantity"
                           type="text"
                           class="form-control @error('quantity') is-invalid @enderror"
                           name="quantity"
                           value="{{ old('quantity') }}"
                           required autocomplete="quantity"
                           autofocus>

                    @error('quantity')
                            <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="minimum_quantity" class="col-md-4 col-form-label">Minimum Quantity</label>

                    <input id="minimum_quantity"
                           type="text"
                           class="form-control @error('minimum_quantity') is-invalid @enderror"
                           name="minimum_quantity"
                           value="{{ old('minimum_quantity') }}"
                           required autocomplete="quantity"
                           autofocus>

                    @error('minimum_quantity')
                            <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <div class="row">
                    <label for="image" class="col-md-4 col-form-label">Post Image</label>

                    <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image">

                    @error('image')
                    <span class="invalid-feedback" role="alert">
                            <strong>The photo must be an image</strong>
                        </span>
                    @enderror

                </div>

                <div class="row pt-4 d-flex justify-content-between">
                    <a href="/p/index" class="btn btn btn-secondary btn-100" role="button">Cancel</a>
                    <button class="btn btn-primary">Add New Products</button>
                </div>

            </div>
        </div>

    </form>
</div>
@endsection

