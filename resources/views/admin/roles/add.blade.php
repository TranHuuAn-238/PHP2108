@extends('admin.layout-admin')

@php
    $showHeading = false;
    $buttonReport = false;
@endphp

@section('title', 'Add Role')
@section('namePageHeading', 'Add Role')

@section('content')
<div class="row">
    <div class="col">
        <a href="{{ route('admin.roles') }}" class="btn btn-primary mb-3">List role</a>
        <div class="alert alert-danger my-3" style="display:none;">
        </div>
        <form>

            {{-- form create role --}}
            <div class="form-group">
                <label for="">Name</label>
                <input id="nameRole" type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Description</label>
                <textarea id="descriptionRole" name="description" class="form-control" id="" cols="30" rows="10"></textarea>
            </div>

            {{-- list permissions here --}}
            <hr>
            @foreach ($permission as $item)
            <div class="row">
                <div class="col">
                    <p>
                        <input class="permission" type="checkbox" id="permit_{{ $item->id }}" value="{{ $item->id }}">
                        <span>{{ $item->name }}</span>
                    </p>
                </div>
            </div>
            @endforeach            
            <hr>

            <button class="btn btn-primary add-role" type="button">Add</button>
            <input type="hidden" id="strIdPermission" value="">
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(function(){
            function addListIdPermission() {
                let strId = ""; // khi vào hàm thì khởi gán rỗng 
                $('.permission').each(function() {
                    if($(this).is(':checked')) {
                        // ô text box đã chọn
                        strId += strId === "" ? $(this).val().trim() : ","+$(this).val().trim();
                    }
                }); // duyệt từng thẻ input có class permission
                $('#strIdPermission').val(strId); // gán value vào
                let ids = $('#strIdPermission').val().trim(); // lấy lại value vừa gán ra
                return ids;
            }
            
            $('.add-role').click(function() {
                let self = $(this);
                let strIdPermission = addListIdPermission();
                // consolog(strIdPermission);
                let nameRole = $('#nameRole').val().trim();
                let descriptionRole = $('#descriptionRole').val().trim();
                $.ajax({
                    url: "{{ route('admin.handle.add.role') }}",
                    type: "post",
                    data: {nameRole, descriptionRole, strIdPermission},
                    beforeSend: function(){
                        self.text('Loading...');
                    },
                    success: function(response) {
                        self.text('Add');
                        if(response.hasOwnProperty('errors')) {
                            // có lỗi trả về, duyệt lỗi ra
                            $('.alert-danger').empty();
                            $('.alert-danger').show();
                            $.each(response.errors, function(key, value){
                                $('.alert-danger').append('<p class="mb-0">'+value+'</p>');
                            });
                        } else if(response.hasOwnProperty('fails')) {
                            $('.alert-danger').empty();
                            $('.alert-danger').show();
                            $('.alert-danger').append('<p class="mb-0">'+response['fails']+'</p>');
                        } else {
                            alert(response['success']);
                        }
                    }
                });
            });
        });
    </script>
@endpush