@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 margin-tb">
                @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
                </div>
                @endif

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
                    <h2>List of Categories</h2>
                        <a class="btn btn-success" href="/category/create">Add New Category</a>
                </div>
                
                <div class="card-body">
        <table class="table table-hover">
            <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($categories as $category)
                <tr class="text-center">
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <form action="/category/{{ $category->id }}" method="POST">

                            @csrf
                            @method('DELETE')

                            <button type="submit" onclick="return confirm('Are you sure? All of the products under this category will be deleted as well.')" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
                </div>
    </div>
        </div>
    </div>
    <div class="text-center">
        <a href="/p/index"
            class="btn btn-primary mt-3">Back</a>
        </div>
@endsection
