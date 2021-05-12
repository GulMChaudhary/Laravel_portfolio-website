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

                <div class="col-md-10">
                    <div class="d-flex flex-row-reverse mb-2">
                        <a href="{{ route('create.slider') }}" class="btn btn-outline-primary">Add Slider Image</a>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" width = "5%">#</th>
                                <th scope="col" width = "15%">Slider Name</th>
                                <th scope="col" width = "25%">Slider Description</th>
                                <th scope="col" width = "20%">Slider Image</th>
                                <th scope="col" width = "15%">Created At</th>
                                <th scope="col" width = "15%">Last Updated</th>
                                <th scope="col" colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $slider)
                                <tr>
                                    <th scope="row">{{ $sliders->firstItem() + $loop->index }}</th>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->description }}</td>
                                    <td><img src="{{ asset($slider->slider_image) }}" style="height: 40px; width: 70px;"></td>
                                    <td>{{ $slider->created_at->diffForHumans() }}</td>
                                    <td>
                                        @if ($slider->updated_at == null)
                                            <span class="text-danger">Not updated</span>
                                        @else
                                            {{ $slider->updated_at->diffForHumans() }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('dashboard/sliders/edit/' . $slider->id) }}"
                                            class="btn btn-warning btn-sm">Update</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('dashboard/sliders/delete/' . $slider->id) }}"
                                            class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $sliders->links() }}
                </div>
            </div>
        </div>
@endsection
