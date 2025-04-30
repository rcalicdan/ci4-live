@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Posts List</h4>
                    <a href="{{ site_url('posts/create') }}" class="btn btn-primary">Add New Post</a>
                </div>
                <div class="card-body">
                    @session('success')
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endsession

                    @session('error')
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endsession
                    

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($posts))
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>
                                            @if ($post['status'] == 'published')
                                                <span class="badge bg-success">Published</span>
                                            @else
                                                <span class="badge bg-secondary">Draft</span>
                                            @endif
                                        </td>
                                        <td>{{ date('Y-m-d', strtotime($post['created_at'])) }}</td>
                                        <td>
                                            <a href="{{ site_url('posts/edit/' . $post->id) }}"
                                                class="btn btn-sm btn-info">Edit</a>
                                            <a href="{{ site_url('posts/delete/' . $post->id) }}"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">No posts found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="mt-2">{!! $posts->links() !!}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
