

@extends('layouts.app')

@section('assets')
    <link rel="stylesheet" href="css/asset.css">
@endsection

@section('content')
<div class="container">


    <div class="d-flex justify-content-center" style="padding-top:10%">
        <div class="imagecenter">
            <a href="/c/index">
                <img alt="manageCashier" src="\png\cashierlogo.jpg">
            </a>
        </div>
        <div>
            <a class="imagecenter" href="/p/index">
                <img alt="manageInventory" src="\png\inventorylogo.jpg">
            </a>
        </div>

        <div>
            <a class="imagecenter" href="#">
                <img alt="profile" src="\png\profilelogo.jpg">
            </a>
        </div>
        

    </div>


</div>
@endsection
