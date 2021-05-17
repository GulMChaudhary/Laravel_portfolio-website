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
                                <th scope="col">Skill Name</th>
                                <th scope="col">Skill Image</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Last Updated</th>
                                <th scope="col" colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($skills as $skill)
                                <tr>
                                    <th scope="row">{{ $skills->firstItem() + $loop->index }}</th>
                                    <td>{{ $skill->skill_image }}</td>
                                    <td><img src="{{ asset($skill->skill_image) }}" style="height: 40px; width: 70px;"></td>
                                    <td>{{ $skill->created_at->diffForHumans() }}</td>
                                    <td>
                                        @if ($skill->updated_at == null)
                                            <span class="text-danger">Not updated</span>
                                        @else
                                            {{ $skill->updated_at->diffForHumans() }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('dashboard/skills/edit/' . $skill->id) }}"
                                            class="btn btn-warning btn-sm">Update</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('dashboard/skills/delete/' . $skill->id) }}"
                                            class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $skills->links() }}
                </div>


            </div>
        </div>
@endsection
