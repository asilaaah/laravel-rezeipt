@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="d-flex justify-content-between mb-3">
            <h2>List of Cashiers</h2>
            </div>

            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($cashier as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->email }}</td>
                        <td class="d-flex">
                            <form action="/c/{{ $data->id }}" method="POST"> 
                    
                                <a class="btn btn-primary" href="/c/{{ $data->id }}/edit">Edit</a>
               
                                @csrf
                                @method('DELETE')
                  
                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
                            </form>
                    @endforeach



                </tbody>
            </table>
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
