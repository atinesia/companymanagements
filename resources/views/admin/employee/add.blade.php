@extends('layouts.master')
@section('title','New Employee Data')
@section('content')
<div class="card card-primary">
    <div class="card-header"></div>
    <form method="POST" action="{{route('employee.store')}}" enctype= multipart/form-data>
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">First Name</label>
                <input type="text" class="form-control" name="firts_name" placeholder="Enter first name">
                @error('firts_name')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" name="last_name" placeholder="Enter last name">
                @error('last_name')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Company</label>
                <select class="form-control" name="company_id">
                    <option value="">--Choose Company--</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter email address" >
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="number" class="form-control" name="phone" placeholder="Enter phone number" >
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
    </form>
</div>
@stop