

@extends('layouts.app')

@section('assets')
    <link rel="stylesheet" href="css/asset.css">
@endsection

@section('content')
<div class="container">


    <div class="d-flex justify-content-center" style="padding-top:10%">
        <div class="imagecenter">
            <a href="/users">
                <img alt="approve" src="\png\approvelogo.jpg">
            </a>
        </div>
        <div>
            <a class="imagecenter" href="/store/index">
                <img alt="store" src="\png\storelogo.jpg">
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
