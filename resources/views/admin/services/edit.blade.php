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
                <div class="col-md-8">
                    <div class="card-header">
                        <div class="card-body">
                        <form action="{{ url('dashboard/services/update/' . $services->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="old_image" value="{{ $services->icon }}">
                            <div class="form-group">
                                <label for="title">
                                    <h4 class="font-semibold text-xl text-gray-800 leading-tight">Upate Title</h4>
                                </label>
                                <input type="text" class="form-control" name="title" id="title"
                                    value="{{ $services->title }}">
                                @error('brand_name')
                                    <span class="text-danger">{{ $message }} </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">
                                    <h4 class="font-semibold text-xl text-gray-800 leading-tight">Upate Description</h4>
                                </label>
                                <input type="text" class="form-control" name="title" id="title"
                                    value="{{ $services->description }}">
                                @error('brand_name')
                                    <span class="text-danger">{{ $message }} </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <img src="{{ asset($services->icon) }}" style="height: 100px; width: 100px;">
                            </div>
                            <div class="form-group">
                                <label for="icon">
                                    <strong>Update icon Image</strong>
                                </label>
                                <input type="file" class="form-control" name="brand_image" id="brand_image"
                                    aria-describedby="brand_image" value="{{ $services->icon }}">
                            </div>
                            <button type="submit" class="btn btn-warning btn-sm">Update Service</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
