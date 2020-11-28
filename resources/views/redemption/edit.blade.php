@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="/redemption/{{ $redemption->id }}" enctype="multipart/form-data" method="post">
            @csrf
            @method('PATCH')

            <div class="row">
                <div class="col-8 offset-2">

                    <div class="row">
                        <h2 class="mt-3">Edit Reward Information</h2>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label">Name</label>

                        <input id="name"
                               type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               name="name"
                               value="{{ old('name') ?? $redemption->name}}"
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
                               value="{{ old('description') ?? $redemption->description}}"
                               autocomplete="description"
                               autofocus>

                        @error('description')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="points" class="col-md-4 col-form-label">Points</label>

                        <input id="points"
                               type="number"
                               class="form-control @error('points') is-invalid @enderror"
                               name="points"
                               value="{{ old('points') ?? $redemption->points }}"
                               required autocomplete="points"
                               autofocus>

                        @error('points')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="discountAmount" class="col-md-4 col-form-label">Discount Amount</label>

                        <input id="discountAmount"
                               type="number"
                               class="form-control @error('discountAmount') is-invalid @enderror"
                               name="discountAmount"
                               value="{{ old('discountAmount') ?? $redemption->discountAmount}}"
                               required autocomplete="discountAmount"
                               autofocus>

                        @error('discountAmount')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="discountUnit" class="col-md-4 col-form-label">Discount Unit</label>

                        <input id="discountUnit"
                               type="number"
                               class="form-control @error('discountUnit') is-invalid @enderror"
                               name="discountUnit"
                               value="{{ old('discountUnit') ?? $redemption->discountUnit }}"
                               required autocomplete="discountUnit"
                               autofocus>

                        @error('discountUnit')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="expirationDate" class="col-md-4 col-form-label">Expiration Date</label>

                        <input id="expirationDate"
                               type="date"
                               class="form-control @error('expirationDate') is-invalid @enderror"
                               name="expirationDate"
                               value="{{ old('expirationDate') ?? $redemption->expirationDate }}"
                               required autocomplete="expirationDate"
                               autofocus>

                        @error('expirationDate')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="row pt-4 d-flex justify-content-between">
                        <a href="/redemption/index" class="btn btn btn-secondary btn-100" role="button">Cancel</a>
                        <button class="btn btn-primary">Save</button>

                    </div>

                </div>
            </div>

        </form>
    </div>
@endsection
