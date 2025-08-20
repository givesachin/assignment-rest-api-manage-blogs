<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // List all posts
    public function index(Request $request)
    {
        $blogId = $request->get('blog_id');
        $query = Post::query();
        $perPage = 10;

        if($request->has('perPage')) {
            $perPage = $request->get('perPage');
        }

        if ($blogId) {
            $query->where('blog_id', $blogId);
        }

        $posts = $query->paginate($perPage);
        return PostResource::collection($posts);
    }

    // Store a new post
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'blog_id' => 'required|exists:blogs,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
}

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
