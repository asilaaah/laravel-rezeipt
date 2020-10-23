@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
            <div class="card-header">List of Cashiers</div>

            <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr class="text-center">
                    <th scope="col">ID</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>

                @forelse ($cashier as $data)
                    <tr class="text-center">
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->email }}</td>
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
            {{ $cashier->render() }}
        </div>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-md-6 offset-md-5">
            <p class="btn-holder">
                <a href="/manager" class="btn btn-primary text-center" role="button">Back</a>
            </p>
        </div>
    </div>
</div>
@endsection
