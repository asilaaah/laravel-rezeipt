@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="/store/{{ $store->id }}" enctype="multipart/form-data" method="post">
            @csrf
            @method('PATCH')

            <div class="row">
                <div class="col-8 offset-2">

                    <div class="row">
                        <h1>Edit Store</h1>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label">Name</label>

                        <input id="name"
                               type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               name="name"
                               value="{{ old('name') ?? $store->name }}"
                               required autocomplete="name"
                               autofocus>

                        @error('name')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-form-label">Address</label>

                        <input id="address"
                               type="text"
                               class="form-control @error('address') is-invalid @enderror"
                               name="address"
                               value="{{ old('address') ?? $store->address }}"
                               required autocomplete="address"
                               autofocus>

                        @error('address')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="phone_num" class="col-md-4 col-form-label">Phone Number</label>

                        <input id="phone_num"
                               type="text"
                               class="form-control @error('phone_num') is-invalid @enderror"
                               name="phone_num"
                               value="{{ old('phone_num') ?? $store->phone_num }}"
                               required autocomplete="phone_num"
                               autofocus>

                        @error('phone_num')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="row pt-4 d-flex justify-content-between">
                        <a href="/store/index" class="btn btn btn-secondary btn-100" role="button">Cancel</a>
                        <button class="btn btn-primary">Edit Store</button>

                    </div>

                </div>
            </div>

        </form>
    </div>
@endsection
