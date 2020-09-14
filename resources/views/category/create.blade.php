@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/category" enctype="multipart/form-data" method="post">
        @csrf
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <h1>Add New Category</h1>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label">Category</label>

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

                <div class="row pt-4">
                    <button class="btn btn-primary">Add New Category</button>

                </div>
        </div>
        </div>
    </form>
</div>
@endsection
    