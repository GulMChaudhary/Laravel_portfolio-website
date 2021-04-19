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
                <div class="col-md-9">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Brand Name</th>
                                <th scope="col">Brand Image</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Last Updated</th>
                                <th scope="col" colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr>
                                    <th scope="row">{{ $brands->firstItem() + $loop->index }}</th>
                                    <td>{{ $brand->brand_name }}</td>
                                    <td><img src="{{ asset($brand->brand_image) }}" style="height: 40px; width: 70px;"></td>
                                    <td>{{ $brand->created_at->diffForHumans() }}</td>
                                    <td>
                                        @if ($brand->updated_at == null)
                                            <span class="text-danger">Not updated</span>
                                        @else
                                            {{ $brand->updated_at->diffForHumans() }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('dashboard/brands/edit/' . $brand->id) }}"
                                            class="btn btn-warning btn-sm">Update</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('dashboard/brands/delete/' . $brand->id) }}"
                                            class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $brands->links() }}
                </div>

                <div class="col-md-3">
                    <div class="card-header">
                        <div class="card-body">
                            <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="brand">
                                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add New Brand</h2>
                                    </label>
                                    <input type="text" class="form-control" name="brand_name" id="brand_name"
                                        aria-describedby="brand" placeholder="Brand Name">
                                    @error('brand_name')
                                        <span class="text-danger">{{ $message }} </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="file" class="form-control" name="brand_image" id="brand_image"
                                        aria-describedby="brand" placeholder="Brand Image">
                                    @error('brand_image')
                                        <span class="text-danger">{{ $message }} </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">Add Brand</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</x-app-layout>
