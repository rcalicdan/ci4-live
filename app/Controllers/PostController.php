<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Post;
use Rcalicdan\Ci4Larabridge\Validation\RequestValidator;

class PostController extends BaseController
{
    public function index()
    {
        $posts = Post::paginate(10);

        return blade_view('posts.index', compact('posts'));
    }

    public function create()
    {
        return blade_view('posts.create');
    }

    public function store()
    {
        $input = RequestValidator::validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:10',
            'status' => 'required|in:draft,published'
        ]);

        Post::create($input->validated());

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function edit($id)
    {
        $post = Post::find($id);

        return blade_view('posts.edit', compact('post'));
    }

    public function update($id)
    {
        $input = RequestValidator::validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:10',
            'status' => 'required|in:draft,published'
        ]);

        $post = Post::find($id);
        $post->update($input->validated());
        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
