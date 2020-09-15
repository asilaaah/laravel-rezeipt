
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="h4 pb-2">{{ auth()->user()->name }}</div>
    <div class="row pb-3"><a class="btn btn-success" href="/p/index">Manage Inventory</a></div>
    <div class="row"><a class="btn btn-success" href="/c/index">Manage Cashier</a></div>
</div>
@endsection