@extends('admin.layout-admin')

@php
    $showHeading = true;
    $buttonReport = false;
@endphp

@section('title', 'Permissions')
@section('namePageHeading', 'Permissions')

@section('content')
<div class="row">
    <div class="col">
        @if ($errors->any())
            <div class="alert alert-danger my-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('addPermissionFail'))
            <div class="alert alert-danger">{{ session('addPermissionFail') }}</div>
        @endif
        @if(session('addPermissionSuccess'))
            <div class="alert alert-success">{{ session('addPermissionSuccess') }}</div>
        @endif

        {{-- add permission --}}
        <form action="{{ route('admin.add.permission') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Description</label>
                <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
            </div>
            <button class="btn btn-primary" type="submit" name="addPermission">Add</button>
        </form>

        {{-- list permission --}}
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th class="text-center" colspan="2" width="10%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permission as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>
                                <a href="#" class="btn btn-info">Edit</a>
                            </td>
                            <td>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $permission->links() }}
    </div>
</div>
@endsection