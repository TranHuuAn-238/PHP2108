@extends('admin.layout-admin')

@php
    $showHeading = true;
    $buttonReport = false;
@endphp

@section('title', 'Roles')
@section('namePageHeading', 'Roles')

@section('content')
<div class="row">
    <div class="col">
        <a href="{{ route('admin.add.role') }}" class="btn btn-primary">Add role</a>
    </div>
</div>
@endsection