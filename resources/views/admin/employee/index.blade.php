@extends('layouts.master')
@section('title','Company List')
@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <a href="{{route('employee.create')}}" class="btn btn-primary"><i class="fas fa-add"></i> Add New</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Employee List</h3>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('employee.index') }}">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Date From:</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" class="form-control" name="date1" id="filter_date1" value="{{ request()->date1 }}">
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>To:</label>
                                <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                    <input type="text" class="form-control" name="date2" id="filter_date2" value="{{ request()->date2 }}">
                                    <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Criteria</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="search" value="{{ request()->search }}" class="form-control" placeholder="Search (first name, last name, email, company)" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                      <button type="submit" class="btn btn-outline-primary" type="button">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <table class="table table-striped">
                    <thead>
                        <th>Index</th>
                        <th>Fullname</th>
                        <th>Comapany</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Created_At</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                           <tr>
                               <td>{{ $loop->index + 1 }}</td>
                               <td>{{ $employee->full_name }}</td>
                               <td>{{ $employee->company->name }}</td>
                               <td>{{ $employee->email }}</td>
                               <td>{{ $employee->phone }}</td>
                               <td>{{ $employee->created_at }}</td>
                               <td>
                                    <a href="#" id="edit-employee" data-id="{{$employee->id}}"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="text-danger" id="delete-employee" data-id="{{$employee->id}}"><i class="fa fa-trash"></i></a>
                               </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dialog for company detail -->
<div class="modal fade" id="modal-company-detail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Company Detail</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="form-group mx-auto text-center">
                        <img src="#" class="" id="c_logo" border="0" width="100" class="img-rounded" align="center"/>
                    </div>
                    <div class="form-group">
                        <label for="name" >Company Name</label>
                        <input type="text" class="form-control" id="c_name" disabled/>
                    </div>
                    <div class="form-group">
                        <label for="name">Company Email</label>
                        <input type="text" class="form-control" id="c_email" disabled/>
                    </div>
                    <div class="form-group">
                        <label for="website">Website</label>
                        <input type="text" class="form-control" id="c_website" disabled/>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>

<!-- Dialog for edit employee -->
<div class="modal fade" id="modal-employee-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Employee</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="PATCH"  id="form-edit-employee">
                @csrf
                <div class="card-body">
                    <input type="hidden" id="hidden_id">
                    <span id="form_result"></span>
                    <div class="form-group">
                        <label for="name">First Name</label>
                        <input type="text" class="form-control" id="firts_name" name="firts_name" placeholder="Enter first name">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id='last_name' name="last_name" placeholder="Enter last name">
                    </div>
                    <div class="form-group">
                        <label for="name">Company</label>
                        <select class="form-control" id="company_id" name="company_id">
                            <option value="">--Choose Company--</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address" >
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="number" class="form-control" id="phone" name="phone" placeholder="Enter phone number" >
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
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

    function ConfirmDeleteDialog(message,id) {
    $('<div></div>').appendTo('body').html('<div><h6>' + message + '?</h6></div>')
        .dialog({
            modal: true,
            title: 'Delete data',
            zIndex: 10000,
            autoOpen: true,
            width: 'auto',
            resizable: false,
            buttons: {
                Yes: function() {
                    $.ajax({
                        method:"DELETE",
                        url: "employee/" + id,
                        dataType: "json",
                        success: function(data){
                            $('#employees-table').DataTable().ajax.reload();

                        }
                    });
                    $(this).dialog("close");
                },
                No: function() {
                    $(this).dialog("close");
                }
            },
            close: function(event, ui) {
                $(this).remove();
            }
        });
    };
    // $('#employees-table').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     ajax: "{{ route('employeeJson') }}",
    //     columns: [
    //         { data: 'DT_RowIndex', name: 'DT_RowIndex' },
    //         {data: 'full_name', name: 'full_name'},
    //         {data: 'company', name: 'company'},
    //         {data: 'email', name: 'email'},
    //         {data: 'phone', name: 'phone'},
    //         {data: 'action', name: 'action', orderable: false, searchable: false}
    //     ]
    // });

    $(document).on('click', '#show-company-detail', function() {
        var id = $(this).attr('data-id');
        $('#form_result').html('');
        $.ajax({
            url: "employee/" + id,
            dataType: "json",
            success: function(data){
                $('#c_name').val(data.result.name);
                $('#c_email').val(data.result.email);
                $("#c_logo").attr("src",window.location.protocol + '/storage/' + data.result.logo);
                $('#c_website').val(data.result.website);

                $('#modal-company-detail').modal('show');
            }
        });

    });

    $(document).on('click', '#edit-employee', function() {
        var id = $(this).attr('data-id');
        $('#form_result').html('');
        $.ajax({
            url: "employee/" + id + '/edit',
            dataType: "json",
            success: function(data){
                $('#hidden_id').val(data.result.id);
                $('#firts_name').val(data.result.firts_name);
                $('#last_name').val(data.result.last_name);
                $("#company_id").val(data.result.company_id);
                $('#email').val(data.result.email);
                $('#phone').val(data.result.phone);

                $('#modal-employee-edit').modal('show');
            }
        });

    });

    $(document).on('click', '#delete-employee', function() {
        var id = $(this).attr('data-id');
        $('#form_result').html('');
        ConfirmDeleteDialog('Are you sure',id);
    });

    $('#form-edit-employee').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
            url: "employee/" + $("#hidden_id").val(),
            method: 'PATCH',
            data: $(this).serialize(),
            dataType: "json",
            success: function(data){
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
                        $('#form-edit-employee')[0].reset();
                        $('#employees-table').DataTable().ajax.reload();
                    }
                    $('#form_result').html(html);
                    $('#modal-employee-edit').modal('hide');
            }
        });
    });
});
</script>
@endpush
