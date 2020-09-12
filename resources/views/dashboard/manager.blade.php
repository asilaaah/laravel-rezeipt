
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 border-right">
            <a href="/i">Manage Inventory</a>
        </div>

        <div class="col-9">
            <div class="h4">{{ auth()->user()->name }}</div>
        </div>
    </div>

</div>
@endsection