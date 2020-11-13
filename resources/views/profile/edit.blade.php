
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <form class="card user-profile" method="POST" action="/profile/{{ $user->id }}" enctype="multipart/form-data">

                    @csrf
                    @method('PATCH')

                    <div class="card-header">
                        <h4 class="float-left mb-0 mt-2">Edit Profile</h4>
                        <div class="btn-group float-right">
                        <a href="/profile/{{ $user->id }}" class="btn btn-secondary btn-100">Cancel</a>
                        </div>
                    </div>


                    <div class="card-body border-bottom">
                        <!-- Image -->
                            <div class="file-field text-center">
                            <div class="mb-4">
                                <img src="{{ $user->profile->profileImage() }}"
                                class="img-thumbnail w-25">
                            </div>
                            <div class="d-flex justify-content-center">
                                <input type="file" class="form-control-file text-center" id="profile_photo" name="profile_photo">

                                @error('profile_photo')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            </div>
                    </div>

                    <div class="card-header">
                        <h5 class="float-left mb-0 mt-1 w-100 text-center">
                            <span class="text-info">{{ $user->email }}</span> <small class="text-muted font-italic">(Private)</small>
                        </h5>
                    </div>

                    <div class="card-body">
                        <div class="form-group row pt-3">
                            <label for="name" class="col-sm-4 col-form-label text-sm-right">
                                Name <small class="text-danger font-italic">(Required)</small>
                            </label>
                            <div class="col-sm-8">
                                <input id="name"
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="phone_number"
                                value="{{ old('name') ?? $user->name }}"
                                autocomplete="name"
                                required
                                autofocus>

                            @error('phone_number')
                            <strong>{{ $message }}</strong>
                            @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-header border-top">
                        <h5 class="float-left mb-0 mt-1">Contact</h5>
                    </div>

                    <div class="card-body">
                        <div class="form-group row pt-3">
                            <label class="col-sm-4 col-form-label text-sm-right">Email
                            <small class="text-danger font-italic">(Required)</small></label>
                            <div class="col-sm-8">
                            <input id="email"
                                type="text"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email"
                                value="{{ old('email') ?? $user->email }}"
                                autocomplete="email"
                                required
                                autofocus>

                            @error('email')
                            <strong>{{ $message }}</strong>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group row pt-3">
                            <label class="col-sm-4 col-form-label text-sm-right">Phone Number</label>
                            <div class="col-sm-8">
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
                        </div>

                    </div>

                    <div class="card-header border-top">
                        <h5 class="float-left mb-0 mt-1">Details</h5>
                    </div>

                    <div class="card-body">
                        <div class="form-group row pt-3">
                            <label class="col-sm-4 col-form-label text-sm-right">Address</label>
                            <div class="col-sm-8">
                                <textarea id="address"
                                class="form-control @error('address') is-invalid @enderror"
                                name="address"
                                autocomplete="address"
                                autofocus>{{ old('address') ?? $user->profile->address}}
                        </textarea>

                        @error('address')
                        <strong>{{ $message }}</strong>
                        @enderror
                        </div>
                        </div>

                        <div class="form-group row pt-3">
                            <label class="col-sm-4 col-form-label text-sm-right">Birthday</label>
                            <div class="col-sm-8">
                                <input id="birthday"
                                type="date"
                                class="form-control @error('birthday') is-invalid @enderror"
                                name="birthday"
                                value="{{ old('birthday') ?? $user->profile->birthday }}">

                            @error('birthday')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                        </div>
                    </div>

                    <div class="card-footer text-center">
                            <input type="submit" class="btn btn-success btn-100" value="Save Profile">
                    </div>

            </form>
        </div>
    </div>

</div>

@endsection
