<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
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
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Category Name</td>
                                <td><button class="btn btn-warning btn-sm">Update</button> <button class="btn btn-danger btn-sm">Delete</button></td>
                              </tr>
                            <tr><td colspan="4"><strong>Total Categories: XX</strong></td></tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-4">
                    <div class="card-header">
                        <form action="{{ route('store.category') }}" method="POST">
                        @csrf
                            <div class="form-group">
                              <label for="category"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Add New Category</h2></label>
                              <input type="text" class="form-control" name="category_name" id="category_name" aria-describedby="category" placeholder="Category Label">
                                @error('category_name')
                                    <span class="text-danger">{{ $message }} </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Add Category</button>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>

