@extends('layouts.master')
@section('title','Company List')
@section('content')
    <table class="table table-bordered" id="companies-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Logo</th>
                <th>Website</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>

<div class="modal fade" id="modal-company">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Default Modal</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <form id="companyForm" method="PATCH">
            <div class="modal-body">
                <input type="hidden" id="hidden_id">
                <span id="form_result"></span>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Company Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter company name">
                    </div>
                    <div class="form-group">
                        <label for="name">Company Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter company email">
                    </div>
                    <div class="form-group">
                        <label for="logo">Logo</label>
                        <input type="file" class="form-control file-form" name="file" id="file" accept="image/x-png,image/gif,image/jpeg">
                    </div>
                    <div class="form-group">
                        <label for="name">Company Website</label>
                        <input type="text" class="form-control" id="website" name="website" placeholder="Enter website">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </form>        
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
@stop

@push('scripts')
<script>


$(document).ready(function(){
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    $('#companies-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('companyJson') }}",
        columns: [
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'c_logo', name: 'c_logo'},
            {data: 'website', name: 'website'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    $(document).on('click', '#edit-company', function() { 
        var id = $(this).attr('data-id');
        $('#form_result').html('');
        $.ajax({
            url: "company/" + id + "/edit",
            dataType: "json",
            success: function(data){
                $('#hidden_id').val(data.result.id);
                $('#name').val(data.result.name);
                $('#email').val(data.result.email);
               // $('#logo').val(data.result.logo);
                $('#website').val(data.result.website);

                $('#modal-company').modal('show');
            }
        });
       
    });

    $('#companyForm').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
            url: "company/" + $("#hidden_id").val(),
            method: 'PATCH',
            data: $(this).serialize(),
            dataType: "JSON",
            success: function(data){
                var files = $('#file')[0].files;
                var fd = new FormData();
                if(files.length > 0){
                    fd.append('file',files[0])
                }
                $.ajax({
                    url:"company/" + $("#hidden_id").val() + "/upload",
                    method:"POST",
                    data: fd,
                    contentType:false,
                    processData:false,
                    dataType:"json",
                    success: function(response){

                    }
                });
                var html = '';
                    if (data.errors) {
                        html = '<div class="alert alert-danger">';
                        for (var count = 0; count < data.errors.length; count++) {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    if (data.success) {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('#companyForm')[0].reset();
                        $('#companies-table').DataTable().ajax.reload();
                    }
                    $('#form_result').html(html);
            }
        });
    });
});
</script>
@endpush