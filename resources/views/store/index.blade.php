@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="d-flex justify-content-between mb-3">
                    <div class="pull-left">
                        <h2>Store Information</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-success" href="/store/create"> Add Store</a>
                    </div>
                </div>

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Store Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($stores as $store)
                        <tr>
                            <td>{{ $store->name }}</td>
                            <td>{{ $store->address }}</td>
                            <td>{{ $store->phone_num }}</td>
                            <td class="d-flex">
                                <form action="/store/{{ $store->id }}" method="POST">

                                    <a class="btn btn-primary" href="/store/{{ $store->id }}/edit">Edit</a>

                                    @csrf
                                </form>
                    @endforeach

                    </tbody>
                </table>
            </div>

        </div>
        <div class="form-group row">
            <div class="col-md-6 offset-md-5">
                <p class="btn-holder">
                    <a href="/admin" class="btn btn-primary text-center" role="button">Back</a>
                </p>
            </div>
        </div>
    </div>
@endsection
