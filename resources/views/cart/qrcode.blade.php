
@extends('layouts.app')

@section('assets')
    <link rel="stylesheet" href="css/asset.css">
@endsection

@section('content')
<div class="container">
    <div class="text-center mt-3">
        <h2>Scan to receive receipt</h2>
        <div class="imagecenter">
                <img alt="qrcode" src="\png\qrcode.PNG">
        </div>
        <p class="btn-holder pr-1">
            <a href="/cashier" class="btn btn-primary text-center mt-3" role="button">Back</a>
        </p>
    </div>


</div>
@endsection
