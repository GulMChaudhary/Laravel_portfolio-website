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
                        <a href="{{ route('home.about_create') }}" class="btn btn-outline-primary">Add Content</a>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" width = "15%">Title</th>
                                <th scope="col" width = "25%">Short Description</th>
                                <th scope="col" width = "20%">Long Description</th>
                                <th scope="col" width = "15%">Created At</th>
                                <th scope="col" width = "15%">Last Updated</th>
                                <th scope="col" colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($about as $about)
                                <tr>
                                    <td>{{ $about->title }}</td>
                                    <td>{{ $about->short_description }}</td>
                                    <td>{{ $about->long_description }}</td>
                                    <td>{{ $about->created_at->diffForHumans() }}</td>
                                    <td>
                                        @if ($about->updated_at == null)
                                            <span class="text-danger">Not updated</span>
                                        @else
                                            {{ $about->updated_at->diffForHumans() }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('dashboard/home-about/edit/' . $about->id) }}"
                                            class="btn btn-warning btn-sm">Update</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('dashboard/home-about/delete/' . $about->id) }}"
                                            class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
