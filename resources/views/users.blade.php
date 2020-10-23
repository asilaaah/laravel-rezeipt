@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="card">
                    <div class="card-header">Users List to Approve</div>

                    <div class="card-body">

                        @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif

                        <table class="table">
                            <tr class="text-center">
                                <th>User name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Registered at</th>
                                <th></th>
                            </tr>
                            @forelse ($users as $user)
                                <tr class="text-center">
                                    <td>{{ $user->name }}</td>
                                    <td>   @if ($user->isManager())
                                        Manager
                                     @else
                                        Cashier
                                     @endif</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td><a href="{{ route('admin.users.approve', $user->id) }}"
                                           class="btn btn-primary btn-sm">Approve</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center"><h5>No users found</td></h5>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
                <div class="text-center">
                <a href="/admin"
                    class="btn btn-primary mt-3">Back</a>
                </div>

            </div>

        </div>

    </div>
@endsection
