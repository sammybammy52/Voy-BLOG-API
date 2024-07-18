<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LikeController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'viewer_id' => 'required|exists:viewers,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $check = Like::where([
            'post_id' => $post->id,
            'viewer_id' => $validator->validated()['viewer_id'],
        ])->first();

        if ($check) {
            return response()->json([
                'status' => false,
                'error' => 'already liked'
            ], 400);
        }

        $like = Like::create([
            'post_id' => $post->id,
            'viewer_id' => $validator->validated()['viewer_id'],
        ]);

        return response()->json([
            'status' => true,
            'data' => $like
        ], 201);
    }
}
