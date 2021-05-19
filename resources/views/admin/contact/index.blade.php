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
                        <a href="{{ route('contact.create') }}" class="btn btn-outline-primary">Add Contact</a>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" width = "15%">Address</th>
                                <th scope="col" width = "15%">City</th>
                                <th scope="col" width = "15%">Country</th>
                                <th scope="col" width = "15%">Email</th>
                                <th scope="col" width = "15%">Phone</th>
                                <th scope="col" width = "15%">Created At</th>
                                <th scope="col" width = "15%">Last Updated</th>
                                <th scope="col" colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->address }}</td>
                                    <td>{{ $contact->city }}</td>
                                    <td>{{ $contact->country }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->phone }}</td>
                                    <td>{{ $contact->created_at->diffForHumans() }}</td>
                                    <td>
                                        @if ($contact->updated_at == null)
                                            <span class="text-danger">Not updated</span>
                                        @else
                                            {{ $contact->updated_at->diffForHumans() }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('dashboard/contact/edit/' . $contact->id) }}"
                                            class="btn btn-warning btn-sm">Update</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('dashboard/contact/delete/' . $contact->id) }}"
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
