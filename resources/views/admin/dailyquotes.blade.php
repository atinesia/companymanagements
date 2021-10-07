@extends('layouts.master')
@section('title','Company List')
@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <a href="{{route('company.create')}}" class="btn btn-primary"><i class="fas fa-add"></i> Add New</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered" id="quotes-table">
            <thead>
                <tr>
                    <th>Quote</th>
                    <th>A</th>
                    <th>H</th>
                </tr>
            </thead>
        </table>
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
    $('#quotes-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('getQuote') }}",
        columns: [
            {data: 'q', name: 'q'},
            {data: 'a', name: 'a'},
            {data: 'h', name: 'h'},
        ]
    });
});
</script>
@endpush
