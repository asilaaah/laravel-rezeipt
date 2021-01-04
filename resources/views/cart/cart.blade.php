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
                            <th>Action</th>
                        </tr>
                        </thead>
                        @foreach($products as $id => $product)
                            <tr class="text-center">
                                <td>{{$id}}</td>
                                <td scope="row">{{ $product['item']['name'] }}</td>
                                <td>{{ $product['qty'] }}</td>
                                <td>{{ number_format( $product['item']['price'] , 2, '.', ',') }}</td>
                                <td>{{ number_format( $product['price'] , 2, '.', ',') }}</td>
                                <td class="d-flex justify-content-center">
                                    <form method="POST" action="{{ route('cart.remove', ['id' => $product['item']['id']]) }}" class="form-inline">
                                        @csrf
                                        <input name="qty" id="qty" type="number" value="1" min="1" data-bind="value:qty" class="form-control mr-sm-2 text-center" />
                                        <button type="submit" class="btn btn-danger">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    <div class="form-group row d-flex justify-content-between align-items-center">
                    <h3><strong>Total Price : RM {{ number_format( $totalPrice , 2, '.', ',') }} </strong></h3>
                                <a href="{{ route('cart.qrcode') }}" class="btn btn-primary text-center" role="button">Generate QR Code</a>
                    </div>

                    @if(!session()->has('redemptionCode'))
                    <form action="{{ route('coupon.validate') }}" method="POST" enctype="multipart/form-data" class="form-inline">
                        @csrf
                        <div class="form-group row">
                            <label for="redemptionCode" class="col-form-label mr-2"><h4><strong>Voucher Code :</strong></h4></label>

                            <input id="redemptionCode"
                                    type="text"
                                    class="form-control mb-2 mr-sm-2 @error('redemptionCode') is-invalid @enderror"
                                    name="redemptionCode"
                                    value="{{  Session::get('redemptionCode') }}"
                                    required>
                            <button type="submit" class="btn btn-primary mb-2">Redeem</button>


                        </div>
                    </form>
                    @endif

                        @error('redemptionCode')
                        <strong>{{ $message }}</strong>
                        @enderror


                    @if(session()->has('redemptionCode'))
                    <div class="form-group row d-flex justify-content-start align-items-center ">
                        <h4 class="mt-2"><strong>Discount Applied : {{ Session::get('redemptionCode') }}</strong></h4>
                        <h4 class ="mt-2 ml-2">(-{{  Session::get('rewardDetails')["discountAmount"] ?? null }}%)</h4>

                    <form action="{{ route('coupon.destroy') }}" method="POST" class="form-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary ml-2">Remove</button>

                    </form>
                    </div>
                    @endif


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
