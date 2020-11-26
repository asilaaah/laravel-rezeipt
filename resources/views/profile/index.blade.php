@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 margin-tb">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
            </div>
            @endif
        </div>

        <div class="col-md-9 margin-tb">
            @if ($message = Session::get('error'))
            <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
            </div>
            @endif
        </div>

        <div class="col-md-9">

            <!-- User Profile -->
            <div class="card user-profile">
                <div class="card-header">
                    <h3 class="float-left mb-0 mt-2">User Profile</h3>
                    @can('update', $user->profile)
                <a href="/change-password" class="btn btn-primary btn-100 float-right ml-2 ">Change Password</a>
                <a href="/profile/{{$user->id}}/edit" class="btn btn-primary btn-100 float-right">Edit</a>
                @endcan
                </div>

                <div class="card-body pb-0 pt-0">
                @if (session('status'))
                    <div class="alert alert-success mb-0 mt-3">
                        <strong>{{ session('status') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                </div>

                <div class="card-body border-bottom">
                    <!-- Image -->
                        <div class="text-center">
                            <img src="{{ $user->profile->profileImage()}}" class="img-thumbnail w-25">
                        </div>
                </div>

                <div class="card-header">
                    <h5 class="float-left mb-0 mt-1 w-100 text-center">
                        <span class="text-info">{{ $user->email }}</span> <small class="text-muted font-italic">(Private)</small>
                    </h5>
                </div>

                <div class="card-body">
                   <div class="row mb-2">
                        <div class="col-sm-6 text-sm-right">Name</div>
                        <div class="col-sm-6 field-bg">
                            <span>{{ $user->name }}</span>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-sm-6 text-sm-right">Store Name</div>
                        <div class="col-sm-6 field-bg">
                            <span>{{ $store->name }}</span>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-sm-6 text-sm-right">Role</div>
                        <div class="col-sm-6 field-bg">
                            <span>@if ($user->isManager())
                                Manager
                            @elseif($user->isAdmin())
                                Admin
                             @else
                                Cashier
                             @endif</span>
                        </div>
                    </div>
                </div>

                <div class="card-header border-top">
                    <h5 class="float-left mb-0 mt-1">Contact</h5>
                </div>

                <div class="card-body">
                    <div class="row  mb-2">
                        <div class="col-sm-6 text-sm-right">Email</div>
                        <div class="col-sm-6 field-bg">
                            {{ $user->email }}
                        </div>
                    </div>
                    <div class="row  mb-2">
                        <div class="col-sm-6 text-sm-right">Phone Number</div>
                        <div class="col-sm-6 field-bg">
                        {{ $user->profile->phone_number }}
                        </div>
                    </div>
                </div>

                <div class="card-header border-top">
                    <h5 class="float-left mb-0 mt-1">Details</h5>
                </div>

                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-6 text-sm-right">Address</div>
                        <div class="col-sm-6 field-bg">
                        {{ $user->profile->address }}
                        </div>
                    </div>

                    <div class="row  mb-2">
                        <div class="col-sm-6 text-sm-right">Birthday</div>
                        <div class="col-sm-6 field-bg">
                        {{ $user->profile->birthday }}
                        </div>
                    </div>
                </div>

                @cannot('update', $user->profile)
                <div class="card-header border-top">
                    <h5 class="float-left mb-0 mt-1">Additional Details</h5>
                    <a href="/profile/{{$user->id}}/add/edit" class="float-right font-weight-bold">Edit</a>
                </div>

                <div class="card-body">
                    <div class="row  mb-2">
                        <div class="col-sm-6 text-sm-right">Salary</div>
                        <div class="col-sm-6 field-bg">
                        {{ $user->profile->salary }}
                        </div>
                    </div>

                    <div class="row  mb-2">
                        <div class="col-sm-6 text-sm-right">Remarks</div>
                        <div class="col-sm-6 field-bg">
                        {{ $user->profile->remarks }}
                        </div>
                    </div>
                </div>
                @endcannot

                <div class="card-footer text-center">
                    <p class="btn-holder">
                        @if (Auth::user()->isManager())<a class="btn btn-primary text-center" role="button"href="{{ url('/manager/'.Auth::user()->id) }}">Back</a>

                        @elseif(Auth::user()->isAdmin())<a class="btn btn-primary text-center" role="button"href="{{ url('/admin/'.Auth::user()->id) }}">Back</a>

                        @else<a class="btn btn-primary text-center" role="button"href="{{ url('/cashier/'.Auth::user()->id) }}">Back</a>

                        @endif
                    </p>
            </div>

            </div>
        </div>
    </div>
</div>
@endsection
