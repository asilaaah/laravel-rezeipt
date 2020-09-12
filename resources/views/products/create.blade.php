@extends('layouts.app')

@section('content')
<div class="container">
    <form action="#" enctype="multipart/form-data" method="post">
        @csrf
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <h1>Add New Products</h1>
                </div>

                <div class="form-group row">
                    <label for="category" class="col-md-4 col-form-label">Category</label>

                    <input id="category"
                           type="text"
                           class="form-control @error('category') is-invalid @enderror"
                           name="category"
                           value="{{ old('category') }}"
                           required autocomplete="category"
                           autofocus>

                    @error('category')
                            <strong>{{ $message }}</strong>
                    @enderror
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

                <div class="row">
                    <label for="image" class="col-md-4 col-form-label">Post Image</label>

                    <input type="file" class="form-control-file" id="image" name="image">

                    @error('image')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="row pt-4">
                    <button class="btn btn-primary">Add New Products</button>

                </div>

            </div>
        </div>

    </form>
</div>
@endsection

