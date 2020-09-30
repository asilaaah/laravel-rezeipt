@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/profile/{{$user->id}}/edit" enctype="multipart/form-data" method="get">

        <div class="row">
            <div class="col-8 offset-2">

                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <div class="row">
                    <h1>My Profile</h1>
                </div>

                <div class="row"> Name : {{ $user->name ?? ''}}</div>

                <div class="row"> Email Address : {{ $user->email ?? ''}}</div>

                <div class="row"> Address : {{ $user->profile->address ?? ''}}</div>

                <div class="row">Phone Number : {{$user->profile->phone_number ?? ''}}</div>

                <div class="row">Birthday : {{$user->profile->birthday ?? ''}}</div>

                <div class="row pt-4">
                    <button class="btn btn-primary">Edit Profile</button>

                </div>

            </div>
        </div>

    </form>
</div>
@endsection
