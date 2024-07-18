<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index(Blog $blog)
    {
        return response()->json([
            'status' => true,
            'data' => $blog->posts
        ], 200);
    }

    public function store(Request $request, Blog $blog)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $post = $blog->posts()->create($validator->validated());

        return response()->json([
            'status' => true,
            'data' => $post
        ], 201);
    }

    public function show(Post $post)
    {
        $post = $post->load(['likes', 'comments']);
        return response()->json([
            'status' => true,
            'data' => $post
        ], 200);
    }

    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $post->update($validator->validated());

        return response()->json([
            'status' => true,
            'data' => $post
        ], 200);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'status' => true,
            'data' => null
        ], 204);
    }
}

