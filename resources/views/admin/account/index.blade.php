@extends('admin.layout-admin')

@php
    $showHeading = false;
    $buttonReport = false;
@endphp

@section('title', 'Account')
@section('namePageHeading', 'Account')

@section('content')
<div class="row">
    <div class="col">
        <a href="{{ route('admin.add.account') }}" class="btn btn-primary my-3">Add account</a>
    </div>
</div>
@endsection