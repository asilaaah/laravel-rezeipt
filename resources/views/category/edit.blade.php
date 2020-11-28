@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/category/{{ $category->id }}" enctype="multipart/form-data" method="post">
        @csrf
        @method('PATCH')

        <div class="row">
            <div class="col-8 offset-2">

                <div class="row">
                    <h2 class="mt-3">Update Category Name</h2>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label">Name</label>

                    <input id="name"
                           type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           name="name"
                           value="{{ old('name') ?? $category->name}}"
                           required autocomplete="name"
                           autofocus>

                    @error('name')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <div class="row pt-4 d-flex justify-content-between">
                    <a href="/category/index" class="btn btn btn-secondary btn-100" role="button">Cancel</a>
                    <button class="btn btn-primary">Update Category</button>

                </div>

            </div>
        </div>

    </form>
</div>
@endsection
