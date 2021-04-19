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
                    <div class="card-header">
                    <div class="card-body"></div>
                        <form action="{{ url('categories/update/'.$categories->id) }}" method="POST">
                        @csrf
                            <div class="form-group">
                            <label for="category"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Upate Category</h2></label>
                            <input type="text" class="form-control" name="category_name" id="category_name" aria-describedby="category" value="{{ $categories->category_name }}">
                                @error('category_name')
                                    <span class="text-danger">{{ $message }} </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-warning btn-sm">Update Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

