<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    // List all posts
    public function index()
    {
        $posts = Post::paginate(10);
        return PostResource::collection($posts);
    }

    // Store a new post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::create($request->only('title', 'content'));

        return new PostResource($post);
    }

    // Show a single post
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    // Update a post
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
        ]);

        $post->update($request->only('title', 'content'));

        return new PostResource($post);
    }

    // Delete a post
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(null, 204);
    }
}
