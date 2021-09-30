@extends('layouts.master')
@section('title','New Company Data')
@section('content')
<div class="card card-primary">
    <div class="card-header"></div>
    <form method="POST" action="{{route('company.store')}}" enctype= multipart/form-data>
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Company Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter company name">
                @error('name')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Company Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter company name">
            </div>
            <div class="form-group">
                <label for="exampleInputFile">Logo</label>
                <input type="file" class="form-control" name="logo">
            </div>
            <div class="form-group">
                <label for="name">Company Website</label>
                <input type="text" class="form-control" name="website" placeholder="Enter website" >
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
    </form>
</div>
@stop