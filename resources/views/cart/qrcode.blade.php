
@extends('layouts.app')

@section('assets')
    <link rel="stylesheet" href="css/asset.css">
@endsection

@section('content')
<div class="container">
    <div class="text-center mt-3">
        <h2>Scan to receive receipt</h2>
        {{--<div class="imagecenter">
                <img alt="qrcode" src="\png\qrcode.PNG">
        </div>--}}
        <div class="visible-print text-center">
            {!! QrCode::size(200)->generate("google.com"); !!}
            {{--<p>Scan me to return to the original page.</p>--}}
            {{--<img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(200)->generate('Make me into an QrCode!')) }} ">--}}
        </div>

        <p class="btn-holder pr-1">
            <a href="/product-list" class="btn btn-primary text-center mt-3" role="button">Back</a>
            <a href="/receipt/{{ $id }}" class="btn btn-primary text-center mt-3" role="button">PDF</a>
        </p>
    </div>


</div>
@endsection
