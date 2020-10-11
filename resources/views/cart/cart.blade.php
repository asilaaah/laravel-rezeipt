@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">

                <div class="row d-flex justify-content-between">

                <h2>Your cart</h2>

                <p class="btn-holder pr-1">
                    <a href="/product-list" class="btn btn-primary text-center" role="button">Back</a>
                </p>

                </div>

                @if(Session::has('cart'))
                    <table class="table mt-4 table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price (RM)</th>
                            <th>Subtotal (RM)</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $id => $product)
                            <tr>
                                <td>{{$id}}</td>
                                <td scope="row">{{ $product['item']['name'] }}</td>
                                <td>{{ $product['qty'] }}</td>
                                <td>{{ number_format( $product['item']['price'] , 2, '.', ',') }}</td>
                                <td>{{ number_format( $product['price'] , 2, '.', ',') }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">Action<span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{ route('cart.reduceByOne', ['id' => $product['item']['id']]) }}">Reduce by 1</a></li>
                                                <li><a href="{{ route('cart.remove', ['id' => $product['item']['id']]) }}">Reduce All</a></li>
                                            </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="form-group row mb-0 d-flex justify-content-between">
                    <h3><strong>Total Price : RM {{ number_format( $totalPrice , 2, '.', ',') }} </strong></h3>
                            <p class="btn-holder pl-1">
                                <a href="{{ route('cart.qrcode') }}" class="btn btn-primary text-center" role="button">Generate QR Code</a>
                            </p>
                    </div>

                        <form action="{{ route('cart.payment') }}" method="POST" enctype="multipart/form-data" class="form-inline">
                            @csrf
                            <div class="form-group row">
                                <label for="paidAmount" class="col-form-label mr-2"><h3>Paid Amount : </h3></label>

                                <input id="paidAmount"
                                       type="text"
                                       class="form-control mb-2 mr-sm-2"
                                       name="paidAmount"
                                       value=""
                                       autofocus>
                                <button type="submit" class="btn btn-primary mb-2">Calculate Change</button>
                            </div>
                        </form>

                    <div class="form-group row mb-0">
                        <h3><strong>Change : RM {{ number_format( session()->get('change') , 2, '.', ',') }} </strong></h3>
                    </div>



                @else
                    <h3>No items in cart.</h3>
                @endif
                </div>
            </div>
        </div>
    </div>

@endsection
