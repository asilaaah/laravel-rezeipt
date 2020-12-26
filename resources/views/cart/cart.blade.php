@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">

                   <div class="card-header d-flex align-items-center justify-content-between">
                       <h4>Your cart</h4>
                    <a href="/product-list" class="btn btn-primary" role="button">Back</a>
            </div>
        <div class="card-body mx-2">
                @if(Session::has('cart'))
                    <table class="table table-hover">
                        <thead>
                        <tr class="text-center">
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
                            <tr class="text-center">
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

                    <div class="form-group row d-flex justify-content-between align-items-center">
                    <h3><strong>Total Price : RM {{ number_format( $totalPrice , 2, '.', ',') }} </strong></h3>
                                <a href="{{ route('cart.qrcode') }}" class="btn btn-primary text-center" role="button">Generate QR Code</a>
                    </div>

                    <form action="{{ route('cart.validate') }}" method="POST" enctype="multipart/form-data" class="form-inline">
                        @csrf
                        <div class="form-group row">
                            <label for="redemptionCode" class="col-form-label mr-2"><h4><strong>Voucher Code :</strong></h4></label>

                            <input id="redemptionCode"
                                    type="text"
                                    class="form-control mb-2 mr-sm-2 @error('redemptionCode') is-invalid @enderror"
                                    name="redemptionCode"
                                    value="{{  Session::get('redemptionCode') }}"
                                    required>
                            <button type="submit" class="btn btn-primary ml-2">Redeem</button>

                        </div>
                    </form>


                    <div class="form-group row">

                        @error('redemptionCode')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>


                    <form action="{{ route('cart.payment') }}" method="POST" enctype="multipart/form-data" class="form-inline">
                        @csrf
                        <div class="form-group row">
                            <label for="paidAmount" class="col-form-label mr-3"><h4><strong>Paid Amount :</strong></h4></label>

                            <input id="paidAmount"
                                    type="number"
                                    class="form-control mb-2 mr-sm-2"
                                    name="paidAmount"
                                    min="1" value=""
                                    autofocus required>
                            <button type="submit" class="btn btn-primary mb-2">Calculate Change</button>
                        </div>
                    </form>

                    <div class="form-group row">
                        <h4><strong>Change : RM {{ number_format( session()->get('change') , 2, '.', ',') }} </strong></h4>
                    </div>

                @else
                    <h5>No items in cart</h5>
                @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
