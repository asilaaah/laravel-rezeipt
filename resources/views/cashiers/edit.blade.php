@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/c/{{ $user->id }}" enctype="multipart/form-data" method="post">
        @csrf
        @method('PATCH')

        <div class="row">
            <div class="col-8 offset-2">

                <div class="row">
                    <h2 class="mt-3">Update Cashier Information</h2>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label">Name</label>

                    <input id="name"
                           type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           name="name"
                           value="{{ old('name') ?? $user->name}}"
                           required autocomplete="name"
                           autofocus>

                    @error('name')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label">Email</label>

                    <input id="email"
                           type="text"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email"
                           value="{{ old('email') ?? $user->email }}"
                           required autocomplete="description"
                           autofocus>

                    @error('email')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <div class="row pt-4 d-flex justify-content-between">
                    <a href="/c/index" class="btn btn btn-secondary btn-100" role="button">Cancel</a>
                    <button class="btn btn-primary">Update Cashier</button>

                </div>

            </div>
        </div>

    </form>
</div>
@endsection
