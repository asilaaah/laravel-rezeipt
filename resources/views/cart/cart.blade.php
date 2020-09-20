@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">

                <h2>Your cart</h2>

                @if(Session::has('cart'))
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price (RM)</th>
                            <th>Subtotal (RM)</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td scope="row">{{ $product['item']['name'] }}</td>
                                <td>
                                    {{ $product['qty'] }}
                                </td>
                                <td>
                                    {{ number_format( $product['item']['price'] , 2, '.', ',') }}
                                </td>
                                <td>
                                    {{ number_format( $product['price'] , 2, '.', ',') }}
                                </td>
                                <td>
                                    <button class="btn btn-danger">Remove</button>
                                    <button class="btn btn-danger">Remove All</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <h3><strong>Total Price : RM {{ number_format( $totalPrice , 2, '.', ',') }} </strong></h3>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4 d-flex">
                            <p class="btn-holder pr-1">
                                <a href="/cashier" class="btn btn-primary text-center" role="button">Back</a>
                            </p>
                            <p class="btn-holder pl-1">
                                <a href="#" class="btn btn-primary text-center" role="button">Generate QR Code</a>
                            </p>
                        </div>
                    </div>

                @else
                    <h3>No Items Cart.</h3>
                @endif
                </div>
            </div>
        </div>
    </div>

@endsection
