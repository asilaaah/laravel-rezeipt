@extends('layouts.app')

@section('content')
<div class="container">
<form action="/profile/{{ $user->id }}" enctype="multipart/form-data" method="post">
        @csrf
        @method('PATCH')

        <div class="row">
            <div class="col-8 offset-2">

                <div class="row">
                    <h1>Edit Profile</h1>
                </div>
                
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label">Email Address</label>

                    <input id="email"
                           type="text"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email"
                           value="{{ old('email') ?? $user->email }}"
                           autocomplete='email'
                           autofocus>

                    @error('email')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="address" class="col-md-4 col-form-label">Address</label>

                    <textarea id="address"
                           class="form-control @error('address') is-invalid @enderror"
                           name="address"
                           autocomplete="address"
                           autofocus>{{ old('address') ?? $user->profile->address }}
                    </textarea>

                    @error('address')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="phone_number" class="col-md-4 col-form-label">Phone Number</label>

                    <input id="phone_number"
                           type="text"
                           class="form-control @error('phone_number') is-invalid @enderror"
                           name="phone_number"
                           value="{{ old('phone_number') ?? $user->profile->phone_number }}"
                           autocomplete="phone_number"
                           autofocus>

                    @error('phone_number')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="birthday" class="col-md-4 col-form-label">Birthday</label>

                    <input id="birthday"
                           type="date"
                           class="form-control @error('birthday') is-invalid @enderror"
                           name="birthday"
                           value="{{ old('birthday') ?? $user->profile->birthday }}"
                           autocomplete="birthday"
                           autofocus>

                    @error('birthday')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>


                <div class="row">
                    <label for="profile_photo" class="col-md-4 col-form-label">Profile Image</label>

                    <input type="file" class="form-control-file" id="profile_photo" name="profile_photo">

                    @error('profile_photo')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="row pt-4">
                    <button class="btn btn-primary">Save Profile</button>

                </div>

            </div>
        </div>

    </form>
</div>
@endsection
