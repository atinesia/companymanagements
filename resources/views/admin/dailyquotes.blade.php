@extends('layouts.master')
@section('title','Company List')
@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <a href="#" class="btn btn-primary" id="load_quote"><i class="fas fa-add"></i> Refresh</a>
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
    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });
    $('#load_quote').click(function(){
        $('#quotes-table').DataTable().ajax.reload();
    });

    $('#quotes-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            "headers": {
                'accept' : 'application/json',
                'Authorization': 'Bearer 4|kYiLgRXUKzPDfVqJxTwYgL9aLmj5SyPs6Xmqr7dB'
            },
            "url" : "{{ route('getQuote') }}",
        },
        columns: [
            {data: 'q', name: 'q'},
            {data: 'a', name: 'a'},
            {data: 'h', name: 'h'},
        ]
    });
});
</script>
@endpush
