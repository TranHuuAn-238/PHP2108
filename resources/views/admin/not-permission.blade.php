@extends('admin.layout-admin')

@php
    $showHeading = false;
    $buttonReport = false;
@endphp

@section('title', 'Not permission')
@section('namePageHeading', 'Permission')

@section('content')
<div class="row">
    <div class="col">
        <h2>Bro ko có quyền thao tác!</h2>
    </div>
</div>
@endsection