@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>List of Categories</h1>
        </div>

        <table class="table mt-4" style="width:75%; margin-left:auto; margin-right:auto;" >
            <tr>
                <th>No</th>
                <th>Category</th>
                <th>Action</th>
            </tr>

            @foreach ($categories as $category)
                <tr>
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
        </table>
    </div>
@endsection
