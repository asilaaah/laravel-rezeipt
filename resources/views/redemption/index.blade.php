@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="font-weight-bold">Redemption Information</div>
                        <a class="btn btn-success" href="/redemption/create">Add Redemption Reward</a>
                    </div>
                <div class="card-body">

                <table class="table">
                    <thead>
                    <tr class="text-center">
                        <th scope="col">@sortablelink('name','Name')</th>
                        <th scope="col">@sortablelink('description','Description')</th>
                        <th scope="col">@sortablelink('points','Points')</th>
                        <th scope="col">@sortablelink('discountAmount','Discount Amount')</th>
                        <th scope="col">@sortablelink('expirationDate','Expiration Date')</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse ($redemptions as $redemption)
                        <tr class="text-center">
                            <td>{{ $redemption->name }}</td>
                            <td>{{ $redemption->description }}</td>
                            <td>{{ $redemption->points }}</td>
                            <td>{{ $redemption->discountAmount }}</td>
                            <td>{{ $redemption->expirationDate }}</td>
                            <td class="d-flex justify-content-center">
                                <form action="/redemption/{{ $redemption->id }}" method="POST">

                                    <a class="btn btn-primary" href="/redemption/{{ $redemption->id }}/edit">Edit</a>

                                    @csrf
                                </form>

                                @empty
                                <tr>
                                    <td colspan="6" class="text-center"><h5>No redemption information found</td></h5>
                                </tr>
                    @endforelse

                    </tbody>
                </table>
                </div>
            </div>
            </div>

        </div>
        <div class="text-center">
            <a href="/admin/{{ $user->id }}"
                class="btn btn-primary mt-3">Back</a>
            </div>
    </div>
@endsection