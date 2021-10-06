@extends('layouts.master')
@section('title','Company List')
@section('content')
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
                                    <input type="text" class="form-control" name="date1" id="filter_date1">
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
                                    <input type="text" class="form-control" name="date2" id="filter_date2">
                                    <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="search">Criteria</label>
                                <input type="text" class="form-control" name="search" value="{{ request('search')}}">
                            </div>
                        </div>
                        <div class="col-md-3 mt-4">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Search</button>
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
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                           <tr>
                               <td>#</td>
                               <td>{{ $employee->full_name }}</td>
                               <td>{{ $employee->company->name }}</td>
                               <td>{{ $employee->email }}</td>
                               <td>{{ $employee->phone }}</td>
                               <td>{{ $employee->created_at }}</td>
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
@stop
@push('scripts')
<script>
$(document).ready(function(){
    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    $('#reservationdate2').datetimepicker({
        format: 'L'
    });


});
</script>
@endpush
