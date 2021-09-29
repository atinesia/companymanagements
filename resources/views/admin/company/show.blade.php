@extends('layouts.master')
@section('title','Edit Company Data')
@section('content')
<div class="card card-primary">
    <div class="card-header"></div>
    <form method="GET" action="{{route('company.update',['company'=>$company->id])}}">
        <div class="card-body">
            <div class="form-group">
                <label for="name">Company Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter company name" value="{{ $company->name }}">
            </div>
            <div class="form-group">
                <label for="name">Company Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter company name" value="{{ $company->email }}">
            </div>
            <div class="form-group">
                <label for="exampleInputFile">Logo</label>
                <input type="file" class="form-control" name="logo">
            </div>
            <div class="form-group">
                <label for="name">Company Website</label>
                <input type="text" class="form-control" name="website" placeholder="Enter website" value="{{ $company->website }}">
            </div>
        </div>
    </form>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</div>
@stop