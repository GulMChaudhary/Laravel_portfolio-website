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
                <div class="col-md-9">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Icon</th>
                                <th scope="col">Description</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Last Updated</th>
                                <th scope="col" colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                                <tr>
                                    <th scope="row">{{ $services->firstItem() + $loop->index }}</th>
                                    <td>{{ $service->title }}</td>
                                    <td>{{ $service->description }}</td>
                                    <td><img src="{{ asset($service->icon) }}" style="height: 40px; width: 70px;"></td>
                                    <td>{{ $service->created_at->diffForHumans() }}</td>
                                    <td>
                                        @if ($service->updated_at == null)
                                            <span class="text-danger">Not updated</span>
                                        @else
                                            {{ $service->updated_at->diffForHumans() }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('dashboard/services/edit/' . $service->id) }}"
                                            class="btn btn-warning btn-sm">Update</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('dashboard/services/delete/' . $service->id) }}"
                                            class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $services->links() }}
                </div>

                <div class="col-md-3">
                    <div class="card">
                    <div class="card-header"><h4 class="text-dark"> Add New Service</h4></div>
                        <div class="card-body">
                            <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" name="title" id="title"
                                        placeholder="Service Title">
                                    @error('service_title')
                                        <span class="text-danger">{{ $message }} </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="description" id="description"
                                       placeholder="Service Description">
                                    @error('service_description')
                                        <span class="text-danger">{{ $message }} </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="file" class="form-control" name="icon" id="icon"
                                       placeholder="Service Imag">
                                    @error('service_icon')
                                        <span class="text-danger">{{ $message }} </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-outline-primary">Add Service</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
