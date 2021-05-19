@extends('admin.admin_master')

@section('admin_content')
<div class="col-lg-10">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Edit Contact Details</h2>
        </div>
        <div class="card-body">
            <form action="{{ url('/dashboard/contact/update/'.$contact->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" value="{{ $contact->address }}">
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" class="form-control" name="city" value="{{ $contact->city }}">
                </div>
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" name="country" value="{{ $contact->country }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" value="{{ $contact->email }}">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="phone" class="form-control" name="phone" value="{{ $contact->phone }}">
                </div>
                <div class="form-footer pt-4 pt-5 mt-4">
                    <button type="submit" class="btn btn-primary btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

