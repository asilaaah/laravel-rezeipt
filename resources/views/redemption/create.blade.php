@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="/redemption" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col-8 offset-2">

                    <div class="row">
                        <h1>Add Redemption Reward Information</h1>
                    </div>

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

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
                               value="{{ old('points') }}"
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
                               value="{{ old('discountAmount') }}"
                               required autocomplete="discountAmount"
                               autofocus>

                        @error('discountAmount')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="expirationDate" class="col-md-4 col-form-label">Expiration Date</label>

                        <input id="expirationDate"
                               type="date"
                               class="form-control @error('expirationDate') is-invalid @enderror"
                               name="expirationDate"
                               value="{{ old('expirationDate') }}"
                               required autocomplete="expirationDate"
                               autofocus>

                        @error('expirationDate')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>


                    <div class="row pt-4 d-flex justify-content-between">
                        <a href="/redemption/index" class="btn btn btn-secondary btn-100" role="button">Cancel</a>
                        <button class="btn btn-primary">Add Reward</button>

                    </div>

                </div>
            </div>

        </form>
    </div>
@endsection

