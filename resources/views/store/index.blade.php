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
                        <div>Store Information</div>
                        <a class="btn btn-success" href="/store/create"> Add Store</a>
                    </div>
                <div class="card-body">

                <table class="table">
                    <thead>
                    <tr class="text-center">
                        <th scope="col">@sortablelink('name','Store Name')</th>
                        <th scope="col">@sortablelink('address','Address')</th>
                        <th scope="col">@sortablelink('phone_num','Phone Number')</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse ($stores as $store)
                        <tr class="text-center">
                            <td>{{ $store->name }}</td>
                            <td>{{ $store->address }}</td>
                            <td>{{ $store->phone_num }}</td>
                            <td class="d-flex justify-content-center">
                                <form action="/store/{{ $store->id }}" method="POST">

                                    <a class="btn btn-primary" href="/store/{{ $store->id }}/edit">Edit</a>

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
                                </form>

                                @empty
                                <tr>
                                    <td colspan="6" class="text-center"><h5>No store information found</td></h5>
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
