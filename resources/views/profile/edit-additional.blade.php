@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/profile/{{ $user->id }}/add" enctype="multipart/form-data" method="post">
        @csrf
        @method('PATCH')

        <div class="row">
            <div class="col-8 offset-2">

                <div class="row">
                    <h2 class="mt-3">Update Cashier's Additional Details</h2>
                </div>

                <div class="form-group row">
                    <label for="salary" class="col-md-4 col-form-label">Salary</label>

                    <input id="salary"
                           type="text"
                           class="form-control @error('salary') is-invalid @enderror"
                           name="salary"
                           value="{{ old('salary') ?? $user->profile->salary}}" autocomplete="salary"
                           autofocus>

                    @error('salary')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="remarks" class="col-md-4 col-form-label">Remarks</label>

                    <input id="remarks"
                           type="text"
                           class="form-control @error('remarks') is-invalid @enderror"
                           name="remarks"
                           value="{{ old('remarks') ?? $user->profile->remarks}}"
                           autocomplete="remarks"
                           autofocus>

                    @error('remarks')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <div class="row pt-4 d-flex justify-content-between">
                    <a href="/profile/{{ $user->id }}" class="btn btn btn-secondary btn-100" role="button">Cancel</a>
                    <button class="btn btn-primary">Update Details</button>

                </div>

            </div>
        </div>

    </form>
</div>
@endsection
