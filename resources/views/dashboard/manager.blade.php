
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="h4">{{ auth()->user()->name }}</div>
    <a href="/p/index">Manage Inventory</a>
</div>
@endsection