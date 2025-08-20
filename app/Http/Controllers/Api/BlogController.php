<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use App\Http\Resources\BlogResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Blog::query();
        $perPage = 10;

        if($request->has('perPage')) {
            $perPage = $request->get('perPage');
        }

        $blogs = $query->paginate($perPage);
        return BlogResource::collection($blogs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'   => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $blog = Blog::create($request->only('name', 'description'));

        return new BlogResource($blog);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return new BlogResource($blog);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {        
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'required|string',
        ]);

        $blog->update($request->only('name', 'description'));

        return new BlogResource($blog->load('posts'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return response()->json(null, 204);
    }
}
