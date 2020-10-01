

@extends('layouts.app')

@section('assets')
    <link rel="stylesheet" href="css/asset.css">
@endsection

@section('content')
<div class="container">


    <div class="d-flex justify-content-center" style="padding-top:10%">
        <div class="imagecenter">
            <a href="/product-list">
                <img alt="cart" src="\png\cartlogo.jpg">
            </a>
        </div>

        <div>
            <a class="imagecenter" href="/profile">
                <img alt="profile" src="\png\profilelogo.jpg">
            </a>
        </div>

    </div>


</div>
@endsection
