@extends('admin.admin_master')

@section('admin_content')
<div class="col-lg-10">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Add About Section Content</h2>
        </div>
        <div class="card-body">
            <form action="{{ url('/dashboard/home-about/update/'.$about->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" value="{{ $about->title }}">
                </div>
                <div class="form-group">
                    <label for="description">Short Description</label>
                    <textarea class="form-control" name="shortDescription" rows="3" value="{{ $about->short_description }}"></textarea>
                </div>
                <div class="form-group">
                    <label for="description">Long Description</label>
                    <textarea class="form-control" name="longDescription" rows="3" value="{{ $about->long_description }}"></textarea>
                </div>
                <div class="form-footer pt-4 pt-5 mt-4">
                    <button type="submit" class="btn btn-primary btn-default">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

