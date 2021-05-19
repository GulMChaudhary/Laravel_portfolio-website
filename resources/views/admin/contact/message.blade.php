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

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" width = "20%">From</th>
                                <th scope="col" width = "15%">Email</th>
                                <th scope="col" width = "25%">Subject</th>
                                <th scope="col" width = "30%">Message</th>
                                <th scope="col" width = "15%">Received At</th>
                                <th scope="col" colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($messages as $message)
                                <tr>
                                    <td>{{ $message->name }}</td>
                                    <td>{{ $message->email }}</td>
                                    <td>{{ $message->subject }}</td>
                                    <td>{{ $message->message }}</td>
                                    <td>{{ $message->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ url('dashboard/messages/delete/' . $message->id) }}"
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
