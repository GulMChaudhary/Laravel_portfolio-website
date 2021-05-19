@extends('admin.admin_master')

@section('admin_content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <div class="card card-default">
                            <div class="card-header card-header-border-bottom">
                               <h2>Change Password</h2>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('password.update') }}" method="post">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-12 col-md-3 text-right">
                                            <label for="">Current Password</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="password" id="current_password" name="current_password" class="form-control" placeholder="Current Password">
                                        </div>
                                        @error('current_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12 col-md-3 text-right">
                                            <label for="">New Password</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="password" id="password" name="password" class="form-control" placeholder="New Password">
                                        </div>
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12 col-md-3 text-right">
                                            <label for="">Confirm Password</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="New Password">
                                        </div>
                                        @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-footer pt-5 border-top">
                                        <button type="submit" class="btn btn-primary btn-default">Change Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
