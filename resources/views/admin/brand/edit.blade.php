<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Brands') }}
        </h2>
    </x-slot>

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
                        <div class="card-body"></div>
                        <form action="{{ url('dashboard/brands/update/' . $brands->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="old_image" value="{{ $brands->brand_image }}">
                            <div class="form-group">
                                <label for="brand_name">
                                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Upate Brand</h2>
                                </label>
                                <input type="text" class="form-control" name="brand_name" id="brand_name"
                                    aria-describedby="brand_name" value="{{ $brands->brand_name }}">
                                @error('brand_name')
                                    <span class="text-danger">{{ $message }} </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <img src="{{ asset($brands->brand_image) }}" style="height: 100px; width: 100px;">
                            </div>
                            <div class="form-group">
                                <label for="brand_image">
                                    <strong>Update Brand Image</strong>
                                </label>
                                <input type="file" class="form-control" name="brand_image" id="brand_image"
                                    aria-describedby="brand_image" value="{{ $brands->brand_image }}">
                            </div>
                            <button type="submit" class="btn btn-warning btn-sm">Update Brand</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
