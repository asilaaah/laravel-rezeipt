@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 margin-tb">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
            </div>
            @endif
        </div>
        <div class="col-md-10">
            <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="font-weight-bold">List of Cashiers </div>
                </div>

            <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr class="text-center">
                    <th scope="col">@sortablelink('id','ID')</th>
                    <th scope="col">@sortablelink('name','Full Name')</th>
                    <th scope="col">@sortablelink('email','Email')</th>
                    <th class="text-primary" scope="col">Action</th>
                </tr>
                </thead>
                <tbody>

                @forelse ($cashier as $data)
                    <tr class="text-center">
                        <td><a class="text-dark" href="/profile/{{ $data->id }}">{{ $data->id }}</a></td>
                        <td><a class="text-dark" href="/profile/{{ $data->id }}">{{ $data->name }}</a></td>
                        <td><a class="text-dark" href="/profile/{{ $data->id }}">{{ $data->email }}</a></td>
                        <td class="d-flex justify-content-center">
                            <form action="/c/{{ $data->id }}" method="POST">

                                <a class="btn btn-primary" href="/c/{{ $data->id }}/edit">Edit</a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
                            </form>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center"><h5>No cashier information found</td></h5>
                                </tr>
                    @endforelse



                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>

    <div class="row pagination">
        <div class="col-12 d-flex justify-content-center mb-3">
        {!! $cashier->appends(\Request::except('page'))->render() !!}
        </div>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-md-6 offset-md-5">
            <a href='/manager/{{ $user->id }}' class="btn btn-primary text-center" role="button">Back</a>
        </div>
    </div>
</div>
@endsection
